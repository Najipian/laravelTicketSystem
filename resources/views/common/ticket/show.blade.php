<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @component('components.ticket_status' , ['status' => $ticket->status ])

                @endcomponent
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{$ticket->title}}</div>

            <div class="card-body">
                {!! $ticket->description !!}
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row justify-content-center">
    <div class="col-md-8">
        @foreach($ticket->comments()->orderBy('created_at' , 'desc')->get() as $comment)
        <div class="panel {{ $comment->direction == FROM_TENANT_TO_LANDLORD ? ' panel-success' : ' panel-info' }}">
            <div class="panel-body">
                <p class="text-center">{{ $comment->comment}}</p>
            </div>
            <div class="panel-heading">
                <p class="text-left">{!! nl2br(e($comment->created_at)) !!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

