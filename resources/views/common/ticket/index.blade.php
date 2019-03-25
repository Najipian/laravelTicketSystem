<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Property</th>
                <th class="text-center">Title</th>
                <th class="text-center">Status</th>
                <th class="text-center">Created at</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr class="{{ \StaticArray::$ticketStatus[$ticket->status]['color'] }}" onclick="window.location='{{ url($routePrefix . '/ticket/' . $ticket->id) }}';" style="cursor: pointer">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $ticket->property->name }}</td>
                <td class="text-center">{{ $ticket->title }}</td>
                <td class="text-center">{{ \StaticArray::$ticketStatus[$ticket->status]['name'] }}</td>
                <td class="text-center">{{ $ticket->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
