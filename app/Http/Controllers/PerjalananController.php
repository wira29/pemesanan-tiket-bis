<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequest;
use App\Models\Ticket;
use App\Models\Travel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "travels" => Travel::with('tickets')->orderBy('date', 'desc')->paginate(10),
        ];
        return view('pages.perjalanan.index', $data);
    }

    public function getTravelsByDate(Request $request)
    {
        $date = $request->date;
        $travels = Travel::where('date', $request->date)->get();

        return response()->json([
            'travels' => $travels
        ]);
    }

    public function seats(Travel $travel)
    {
        $bookedSeats = $travel->tickets()
            ->pluck('seat_no')
            ->values();

        return response()->json([
            'booked_seats' => $bookedSeats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.perjalanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request)
    {
        Travel::create($request->validated());
        return redirect()->route('travels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        $tickets = Ticket::where('travel_id', $travel->id)->orderBy('seat_no', 'asc')->get();
        return view('pages.perjalanan.show', compact('travel', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        return view('pages.perjalanan.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel)
    {
        $travel->update($request->validated());
        return redirect()->route('travels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        try {
            $travel->delete();
            return redirect()->route('travels.index');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors('Gagagal menghapus!, Perjalanan ini sudah memiliki penumpang!');
        }
    }

    public function print(Travel $travel)
    {
        $tickets = $travel->tickets()
            ->orderBy('seat_no')
            ->get();

        $pdf = Pdf::loadView('pdf.manifest', [
            'travel' => $travel,
            'tickets' => $tickets,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('manifest-penumpang.pdf');
    }
}
