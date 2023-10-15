<div class="marquee">
    @foreach ($tickets as $ticket)
        <div class="card m-3 shadow-lg p-3 bg-white">
            <div class="card-body">
                <div class="card-title">
                    <h1 class="text-center" style="font-size:50px; font-weight: bolder;"><b>{{ $ticket->ticket }}</b><h1>
                </div>
                <div class="card-text">
                    <h3 class="text-center" style="font-size:45px; font-weight: bolder;">{{ $ticket->prosecutor->prosecutor_type .' '. $ticket->prosecutor->id_card .' '. $ticket->prosecutor->name .' ' . $ticket->prosecutor->lastname  }}</b></h3>
                    <h3 class="text-center" style="font-size:40px; font-weight: bolder;">EXP N°: {{ $ticket->record }}</h3>
                    <h3 class="text-center" style="font-size:40px; font-weight: bolder;">{{ $ticket->reason->name }}</h3>
                </div>
            </div>
        </div>
    @endforeach
</div>
