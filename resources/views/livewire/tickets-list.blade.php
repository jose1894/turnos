<div class="list-group">
    @foreach ($tickets as $ticket)
        <div id="ticket-{{$ticket->id}}" style="font-size:35px; font-weight: bolder;" class="list-group-item list-group-item-action">
            <b>{{ $ticket->ticket}} </b> - {{$ticket->people->name.' '.$ticket->people->lastname}}
        </div>
    @endforeach
</div>