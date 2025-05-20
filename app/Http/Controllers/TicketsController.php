<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Clients;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use PHPUnit\Framework\Attributes\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {


        $tickets = Tickets::select('id', 'ticket_number', 'title', 'the_client', 'status')
            ->orderBy('id', 'desc')  // Order by newest first
            ->paginate();

        // Pass the data to the Inertia view
        return Inertia::render('Tickets/Index', compact('tickets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $clients = Clients::select(['id', 'name', 'lastname'])->pluck('name', 'id');
        $users = User::select(['id', 'name'])->pluck('name', 'id');
        return Inertia::render('Tickets/Create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        Tickets::create($request->validated());

        return redirect()->route('tickets.index')
            ->with('message', __('Tciket created successfully'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Tickets $tickets)
    {
        //
    }

    public function edit(Tickets $ticket): Response
    {
        //dd($ticket);
        $clients = Clients::select(['id', 'name'])->pluck('name', 'id');
        // $tickets = Tickets::select(['id', 'description', 'title'])->pluck('id', 'title');
        return Inertia::render('Tickets/Edit', compact('ticket', 'clients'));
    }

    public function update(Tickets $tickets, UpdateTicketRequest $request): RedirectResponse
    {

        // dd($request->all());


        $tickets->update($request->validated());

        return redirect()->route('tickets.index')
            ->with('message', __('Ticket updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $tickets)
    {
        //
    }
}
