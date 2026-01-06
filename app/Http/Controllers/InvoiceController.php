<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditInvoiceRequest;
use App\Http\Requests\InvoiceRequest;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            "invoices" => Invoice::with('travel')->whereDate('date', now())->orderBy('date', 'desc'),
        ];
        if ($request->has('date')) {
            $data['invoices'] = Invoice::with('travel')->whereDate('date', $request->date)->orderBy('date', 'desc');
        }

        if ($request->has('invoice_code')) {
            $data['invoices'] = $data['invoices']->where('invoice_code', 'like', '%' . $request->invoice_code . '%');
        }

        $data['invoices'] = $data['invoices']->paginate(10);
        return view('pages.invoice.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $invoice = Invoice::create($request->validated());
                $passengers = explode(',', $request->passengers);
                foreach ($passengers as $ticket) {
                    DetailInvoice::create([
                        'invoice_id' => $invoice->id,
                        'ticket_id' => $ticket,
                    ]);
                }
            });
            return redirect()->route('invoices.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagagal menambah!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::with(['travel', 'tickets'])->find($id);
        return view('pages.invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditInvoiceRequest $request, Invoice $invoice)
    {
        try {
            DB::transaction(function () use ($request, $invoice) {
                $invoice->update($request->validated());

                $newTicketIds = collect(explode(',', $request->passengers))
                    ->filter()
                    ->values();
                $existingTicketIds = $invoice->tickets()
                    ->pluck('ticket_id');
                $invoice->tickets()
                    ->whereNotIn('ticket_id', $newTicketIds)
                    ->delete();
                $toInsert = $newTicketIds->diff($existingTicketIds);
                foreach ($toInsert as $ticketId) {
                    $invoice->tickets()->create([
                        'ticket_id' => $ticketId,
                        'invoice_id' => $invoice->id,
                    ]);
                }
            });
            return redirect()->route('invoices.index');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal mengupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function print(string $invoice)
    {
        $invoice = Invoice::with('travel', 'tickets.ticket')->where('invoice_code', $invoice)->first();
        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'travel' => $invoice->travel,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('invoice.pdf');
    }
}
