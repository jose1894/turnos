@extends('adminlte::page')

@section('title', 'Personas')

@section('content_header')
    <h1>Lista de personas</h1>
@stop

@section('content')
  @livewire('people.index')
@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('peopleStore', () => {
            setTimeout(() => {
                $('#createPeopleModal .close-btn').trigger('click');
            }, 2500);
        });
        window.livewire.on('peopleUpdate', () => {
            $('#updatePeopleModal .close-btn').trigger('click');
        });
    </script>
@stop