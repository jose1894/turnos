<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Atencion</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <neta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        @vite(['resources/js/app.js']) 
    </head>
    <body class="antialiased" style="background:url('{{ asset('imgs/bg3.jpg') }}')">
        <audio id="audio" src="{{asset('audio/ding-dong.mp3')}}"></audio>
        <div class="container-fluid">
            <header class="mx-auto text-center">
                <img src="{{ asset('imgs/banner_aprobado.jpg') }}">
            </header>
            <div class="row d-none">
                @if (Route::has('login'))
                    <div class="col-12 text-right">
                        @auth
                            <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            @livewire('tickets')
            
        </div>
        <script type="module">
                'use strict';
                Echo.channel('tickets-number').listen('NewMessage', async (e) => {
                    const data = JSON.parse(e.message)
                    const ticket = data.ticket
                    if (ticket === null){ 
                        $("#ticket-called #number b").text('')
                        $("#ticket-called #person b").text('')
                        $("#ticket-called #reason b").text('')
                    }

                    if (ticket){ 
                        $("#ticket-called #number b").text(ticket.ticket.toUpperCase())
                        $("#ticket-called #person b").text(ticket.people.people_type.toUpperCase() + ' ' + ticket.people.id_card.toUpperCase() + ' ' + ticket.people.name.toUpperCase() + ' ' + ticket.people.lastname.toUpperCase())
                        $("#ticket-called #reason b").text('MOTIVO: ' + ticket.reason.name.toUpperCase())
                        playAudio('{{asset('audio/ding-dong.mp3')}}');
                        //playSound('{{asset('audio/ding-dong.mp3')}}');                        
                    }
                })
                Echo.channel('tickets-list').listen('NewMessage', (e) => {
                    Livewire.emit('refreshTicketsListComponent');
                })
                Echo.channel('attending-tickets').listen('NewMessage', async (e) => {                    
                    Livewire.emit('refreshAttendingTicketsComponent');
                })

                
                function playSound(url) {
                    return new Promise(function(resolve, reject) { // return a promise
                        var audio = new Audio();                     // create audio wo/ src
                        audio.preload = "auto";                      // intend to play through
                        audio.autoplay = true;                       // autoplay when loaded
                        audio.onerror = reject;                      // on error, reject
                        audio.onended = resolve;                     // when done, resolve                    
                        audio.src = url
                    });
                }
        </script>
        <style>
            .ticket-attend{
                width: 100%;
                height: 130px;
                font-weight: bold;
                line-height: 35px;
                font-size: 90px;
                margin: 0 auto;
                text-align: center;
            }


            
        </style>
        <!-- Livewire -->
        @livewireScripts
        <script>
            function playAudio(audioUrl){
                let audio = new Audio(audioUrl)
                audio.play()
            }
        </script>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="js/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
            -->
    </body>
</html>
