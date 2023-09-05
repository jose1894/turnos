<div class="list-group">
    @foreach ($tickets as $ticket)
        <div id="ticket-{{$ticket->id}}" style=" font-weight: bold;" class="list-group-item list-group-item-action">
            <b>{{ $ticket->ticket}} </b> ｜ {{$ticket->people->name.' '.$ticket->people->lastname}} ｜ EXP N°: {{ $ticket->record }}
        </div>
    @endforeach
</div>

<style>
    .list-group-item{
        font-size: 30px;
    }
</style>