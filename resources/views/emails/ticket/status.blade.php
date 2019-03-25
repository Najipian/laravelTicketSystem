@component('mail::message')
# Ticket status changed

@component('mail::panel')
Your ticket status changed to : {{ \StaticArray::$ticketStatus[$ticket->status]['name'] }}
@endcomponent


@component('mail::button', ['url' => url('/tenant/ticket/' . $ticket->id)])
Ticket
@endcomponent

Thanks, {{ $ticket->tenant->name }}<br>
<strong> {{ config('app.name') }} </strong>
@endcomponent
