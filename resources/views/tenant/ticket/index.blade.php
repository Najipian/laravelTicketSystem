@extends('tenant.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tenant Dashboard</div>

                <div class="card-body">
                    <a href="{{ url('/tenant/ticket/create') }}" type="button" class="btn btn-primary">New Ticket</a>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tenant Tickets</div>

                <div class="card-body">
                    @include('common.ticket.index' , ['tickets' => Auth::user()->tickets()->orderBy('created_at' , 'desc')->get() , 'routePrefix' => 'tenant'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
