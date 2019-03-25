@extends('landlord.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if($ticket->property->landlord->id == Auth::user()->landlord->id)
                        <div class="col-xs-6">
                            <form  method="POST" action="{{ url('/landlord/ticket/reassign/' . $ticket->id) }}">
                                @csrf
                                <div class="form-group{{ $errors->has('landlord_user_id') ? ' has-error  has-feedback' : '' }}">
                                    <label for="landlord_user_id">Assign ticket to</label>
                                    <select class="form-control" name="landlord_user_id" id="landlord_user_id">
                                        <option value="">Select</option>
                                        <option value="{{ Auth::user()->landlord->id }}">{{ Auth::user()->name }}</option>
                                        @foreach(Auth::user()->landlord->landlord_account_users as $landlordUser)
                                        <option value="{{ $landlordUser->id }}"
                                                @if(old('landlord_user_id') == $landlordUser->id)
                                                    selected
                                                @elseif($ticket->assigned_landlord_id == $landlordUser->id)
                                                    selected
                                                @endif>

                                                {{ $landlordUser->user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('landlord_user_id'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('landlord_user_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Assign</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <form method="POST" action="{{ url('/landlord/ticket/status/'  . $ticket->id) }}">
                                @csrf
                                <div class="form-group{{ $errors->has('ticket_status') ? ' has-error  has-feedback' : '' }}">
                                    <label for="ticket_status">Change ticket status</label>
                                    <select class="form-control" name="ticket_status" id="ticket_status">
                                        <option value="">Select</option>
                                        @foreach(\StaticArray::$ticketStatus as $key => $ticketStatus)
                                            <option value="{{ $key }}" @if(old('ticket_status') == $key) selected @elseif($ticket->status == $key) selected @endif>{{ $ticketStatus['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('ticket_status'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('ticket_status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">Change</button>
                                </div>
                            </form>
                        </div>
                    @else
                        @component('components.ticket_status' , ['status' => $ticket->status ])

                        @endcomponent
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br/>
    @include('common.ticket.show' , ['routePrefix' => 'landlord'])

    @if( ( Auth::user()->landlord->id == $ticket->property->landlord_id ) || ( Auth::user()->landlord->id == $ticket->assigned_landlord_id ) )
        @include('common.ticket.new_comment' , [ 'routePrefix' => 'landlord' ])
    @endif
</div>
@endsection
