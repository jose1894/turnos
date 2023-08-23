<div class="list-group">
    @foreach ($tickets as $ticket)
        <div id="ticket-{{$ticket->id}}" class="list-group-item list-group-item-action">
            <b>{{ $ticket->ticket}} </b> - {{$ticket->people->name.' '.$ticket->people->lastname}}
        </div>
    @endforeach
</div>