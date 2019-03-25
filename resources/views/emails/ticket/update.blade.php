@component('mail::message')
# Ticket update

<i> New comment on ticket </i>
<br/>
@component('mail::panel')
{{ $comment->comment }}
@endcomponent


@component('mail::button', ['url' => url('/' . $type . '/ticket/' . $comment->ticket_id)])
    Ticket
@endcomponent

Thanks,<br>
<strong> {{ config('app.name') }} </strong>
@endcomponent
