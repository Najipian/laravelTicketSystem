<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\ChangeStatusTicket;
use App\Http\Requests\Ticket\ReassignTicket;
use App\Http\Requests\Ticket\StoreTicket;
use App\Http\Requests\Ticket\UpdateTicket;
use App\Http\Resources\TicketStatistics;
use App\Mail\TickedStatus;
use App\Mail\TickedUpdated;
use App\Mail\TicketCreated;
use App\Property;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use DB;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->viewLocation . '.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenant.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Ticket\StoreTicket  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
        //
        $ticket = new Ticket();

        $ticket->user_id = Auth::user()->id;
        $ticket->property_id = intval($request->property_id);
        $ticket->title = e(trim($request->title));
        $ticket->description = e(trim($request->description));
        $ticket->status = OPEN_TICKET_STATUS;
        $ticket->assigned_landlord_id = Property::find($request->property_id)->landlord_id;

        if($ticket->save()) {

            Mail::to($ticket->property->landlord->user , 'EMAILS_SUBJECT')
                ->queue(new TicketCreated($ticket));

            return redirect('/tenant/ticket')->with([
                'message_success' => "Ticket created successfully"
            ]);
        }else
            return redirect()->back()->with([
                "message_danger" => "Error creating ticket"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if (Gate::denies('show-ticket', [$ticket , $this->loggedAs] )) {
            return redirect()->back()->with(
                [
                    'message_danger' => 'You are not authorized to show this ticket'
                ]
            );
        }

        return view($this->viewLocation . '/ticket/show' ,
            [
                'ticket' => $ticket
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Ticket\UpdateTicket  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicket $request, Ticket $ticket)
    {
        /*
         *  If the called user is tenant user comment direction will be FROM_TENANT_TO_LANDLORD else FROM_LANDLORD_TO_TENANT
         *
         * */
        $comment = $ticket->comments()->create([
            'comment' => e($request->comment),
            'direction' => $this->loggedAs == TENANT_USER ? FROM_TENANT_TO_LANDLORD : FROM_LANDLORD_TO_TENANT,
            'landlord_user_id_response' => $this->loggedAs == TENANT_USER ? null : Auth::user()->landlord->id
        ]);

        $type = $this->loggedAs == TENANT_USER ? 'landlord' : 'tenant';

        $to = $comment->direction == FROM_TENANT_TO_LANDLORD ? $ticket->assigned_landlord->user : $ticket->tenant;

        Mail::to($to , 'EMAILS_SUBJECT')
            ->queue(new TickedUpdated($comment , $type));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }


    /**
     * Change specified ticket status.
     *
     * @param  \App\Http\Requests\Ticket\ChangeStatusTicket  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function changeTicketStatus(ChangeStatusTicket $request,Ticket $ticket){
        $ticket->status = $request->ticket_status;

        $output = [
            'message_danger' => 'Can\'t change ticket status'
        ];

        if($ticket->save()){
            $output = [
                'message_success' => 'Ticket status changed successfully'
            ];

            Mail::to($ticket->tenant , 'EMAILS_SUBJECT')
                ->queue(new TickedStatus($ticket));
        }

        return redirect('/landlord/ticket/' . $ticket->id)->with($output);
    }


    /**
     * Reassign landlord user to specified ticket .
     *
     * @param  \App\Http\Requests\Ticket\ReassignTicket  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function reassignTicketToUser(ReassignTicket $request,Ticket $ticket){
        $ticket->assigned_landlord_id = $request->landlord_user_id;

        $output = [
            'message_danger' => 'Can\'t reassign ticket'
        ];

        if($ticket->save()){
            $output = [
                'message_success' => 'Ticket reassigned to selected landlord user successfully'
            ];
        }

        return redirect('/landlord/ticket/' . $ticket->id)->with($output);
    }

    /**
     * Reassign landlord user to specified ticket .
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics(){
        $tickets = new Ticket();

        if($this->loggedAs == TENANT_USER)
            $tickets = $tickets->where('user_id' , Auth::user()->id);
        else
            $tickets = $tickets->whereHas('property' , function($properties){
                $properties->where('landlord_id' , Auth::user()->landlord->id);
            });

        $tickets = $tickets->select(DB::raw('count(*) as total') , 'status')
            ->groupBy('status')
            ->get();

        return TicketStatistics::collection($tickets);
    }
}
