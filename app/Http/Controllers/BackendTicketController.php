<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BackendTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('backend.ticket.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprises = Enterprise::all();
        return view('backend.ticket.create', ['enterprises' => $enterprises]);
    }
    
    function createTicketEp($identerprise) {
        $enterprise = Enterprise::find($identerprise);
        return view('backend.ticket.create', ['enterprise' => $enterprise]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $object = new Ticket($request->all());
        // dd($object);
        try {
            $result = $object->save();
        } catch(\Exception $e) {
            dd($e);
            $result = 0;
        }
        if($object->id > 0) {
            $response = ['op' => 'create', 'r' => $result, 'id' => $object->id];
            return redirect('backend/ticket')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // $ticket = Ticket::find($id);
        // $ticket->enterprise()->name;
        // $ticket->enterprise->name;
        return view('backend.ticket.show', ['ticket' => $ticket]);
    }
    
    function showTickets($identerprise) {
        $tickets = Ticket::where('identerprise', $identerprise)
                ->orderBy('name', 'asc')
                ->get();
        return view('backend.ticket.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $enterprises = Enterprise::all();
        return view('backend.ticket.edit', ['ticket' => $ticket, 'enterprises' => $enterprises]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        
        try {
            $result = $ticket->update($request->all());
        } catch (\Exception $e) {
            $result = 0;
        }
        /*$enterprise->fill($request->all());
        $result = $enterprise->save();*/
        if($result) {
            $response = ['op' => 'update', 'r' => $result, 'id' => $ticket->id];
            return redirect('backend/ticket')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $id = $ticket->id;
        try {
            $result = $ticket->delete();
        } catch(\Exception $e) {
            $result = 0;
        }
        //$result = Enterprise::destroy($enterprise->id);
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/ticket')->with($response);
    }
}
