<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\Travel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function randomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $result;
    }

    public function index()
    {
        return view('landing.pages.pemesanan.index');
    }

    public function checkout(TicketRequest $request)
    {
        try {
            $invoice = DB::transaction(function () use ($request) {
                $invoiceCode = 'INV-' . Self::randomString(8);
                $check = Invoice::where('invoice_code', $invoiceCode)->first();

                if ($check) {
                    throw new \Exception('Kode invoice sudah digunakan');
                }

                $travel = Travel::where('id', $request->travel_id)->first();

                $invoice = Invoice::create([
                    'invoice_code' => $invoiceCode,
                    'travel_id' => $travel->id,
                    'date' => $request->date,
                    'total_price' => $request->price
                ]);

                $tickets = [];

                foreach ($request->passengers as $index => $passenger) {
                    $tickets[] = Ticket::create([
                        'from' => $request->from,
                        'destination' => $request->destination,
                        'whatsapp' => $request->whatsapp,
                        'pickup' => $request->pickup,
                        'name' => $passenger['name'],
                        'gender' => $passenger['gender'],
                        'age' => $passenger['age'],
                        'passport' => $passenger['passport'],
                        'citizenship' => $passenger['citizenship'],
                        'seat_no' => $request->seat_no[$index] ?? null,
                        'travel_id' => $request->travel_id,
                    ]);
                }

                foreach ($tickets as $ticket) {
                    DetailInvoice::create([
                        'invoice_id' => $invoice->id,
                        'ticket_id' => $ticket->id,
                    ]);
                }

                return $invoice;
            });

            return to_route('landing.success', $invoice->invoice_code);
            // return redirect()->route('landing.success', $invoice->invoice_code);
            // dd('berhasil');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function success(string $code)
    {
        $invoice = Invoice::with('travel', 'tickets.ticket')->where('invoice_code', $code)->first();
        return view('landing.pages.pemesanan.success', compact('invoice'));
    }

    public function printInvoice(string $invoice)
    {
        // $invoice = substr($invoice, 4);
        $invoice = Invoice::with('travel', 'tickets.ticket')->where('invoice_code', $invoice)->first();
        $pdf = Pdf::loadView('pdf.guest-invoice', [
            'invoice' => $invoice,
            'travel' => $invoice->travel,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('guest-invoice.pdf');
    }
}
