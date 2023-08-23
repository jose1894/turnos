<section>
    <div class="row my-5">                    
        <div class="col-4">
            <h3 style="color:white">Pendientes</h3>
            <div class="list-group">
                @livewire('tickets-list')
            </div>
        </div>
        <div class="col-8">
            <h3 style="color:white">Atendiendo</h3>
            <div class="marquee-container rounded">
                @livewire('attending-tickets')
            </div>
        </div>
    </div>
    <style>
        .marquee-container{
            width: 100%;
            height: 34em;
            margin: 1em auto;
            overflow: hidden;
            background: white;
            position: relative;
            box-sizing: border-box;
        }

        .marquee {
            top: 6em;
            position: relative;
            box-sizing: border-box;
            animation: marquee 15s linear infinite;
        }

        /* Make it move! */
        @keyframes marquee {
            0%   { top:   34em }
            100% { top: -32em }
        }
    </style>
</section>

