@component('mail::message' , ['ticket' => $ticket])
# New Ticket opened

@component('mail::panel' , ['ticket' => $ticket])
{{ $ticket->title }}
<br/>
{{ $ticket->description }}
@endcomponent

@component('mail::button', ['url' => url('/landlord/ticket/' . $ticket->id)])
Ticket
@endcomponent

Thanks,<br>
<strong> {{ config('app.name') }} </strong>
@endcomponent
