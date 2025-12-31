<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTicketRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "tickets" => Ticket::with('travel')->orderBy('created_at', 'desc')->paginate(10),
        ];
        return view('pages.tiket.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tiket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        Ticket::create($request->validated());
        return redirect()->route('tickets.index');
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
    public function edit(Ticket $ticket)
    {
        return view('pages.tiket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
