@extends('landlord.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Landlord Dashboard</div>

                <div class="card-body">
                    Landlord logged in!
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="nav nav-pills">
                <li class="active">
                    <a data-toggle="pill" href="#landlordPropertyTickets">Landlord property Tickets</a>
                </li>
                <li>
                    <a data-toggle="pill" href="#landlordAssignedTickets">Landlord assigned Tickets</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="landlordPropertyTickets">
                    @include('common.ticket.index' , ['tickets' => Auth::user()->landlord->tickets()->orderBy('created_at' , 'desc')->get() , 'routePrefix' => 'landlord'])
                </div>

                <div class="tab-pane fade" id="landlordAssignedTickets">
                    @include('common.ticket.index' , ['tickets' => Auth::user()->landlord->assigned_tickets()->orderBy('created_at' , 'desc')->get() , 'routePrefix' => 'landlord'])
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
