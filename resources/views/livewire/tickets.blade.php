<section>
    <div class="row my-5">                    
        <div class="col-12 col-md-3 order-2 order-md-1">
            <h5 class="text-white" style="font-size:40px; font-weight: bolder;">PENDIENTE POR AUDIENCIA</h5>
            <div class="list-group">
                @livewire('tickets-list')
            </div>
        </div>
        <div  class="col-12 col-md-9 order-1 order-md-2">
            <div  class="row">
                <div  class="col-12">   
                    <h3 class="text-white" style="font-size:65px; font-weight: bolder;" >LLAMADO</h3>
                    <div id="ticket-called" class="rounded text-white mx-auto">
                        <h1 id="number" class="text-center" style="font-size: 60px;font-weight: bolder;"><b></b><h1>                            
                        <h3 id="person" class="text-center" style="font-size: 60px;font-weight: bolder;"><b></b></h3>
                        <h3 id="reason" class="text-center"><b></b></h3>
                    </div>
                </div>
            </div>
            <div  class="row">
                <div  class="col-12">
                
                    <h3 class="text-white" style="font-size:65px; font-weight: bolder;">EN AUDIENCIA</h3>
                    <div class="marquee-container rounded">
                        @livewire('attending-tickets')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #ticket-called{
            width: 100%;
            height: 10em;
            margin: 1em auto;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            color:white;
        }
        .marquee-container{
            width: 100%;
            height: 28em;
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
            0%   { top:   30em }
            100% { top: -28em }
        }
       
    </style>
</section>

