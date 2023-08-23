<div class="marquee">
    @foreach ($tickets as $ticket)
        <div class="card m-3 shadow-lg p-3 bg-white">
            <div class="card-body">
                <div class="card-title">
                    <h1 class="text-center"><b>{{ $ticket->ticket }}</b><h1>
                </div>
                <div class="card-text">
                    <h3 class="text-center">{{ $ticket->people->people_type .' '. $ticket->people->id_card .' '. $ticket->people->name .' ' . $ticket->people->lastname  }}</b></h3>
                </div>
            </div>
        </div>
    @endforeach
</div>
