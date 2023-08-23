@extends('adminlte::page')

@section('title', 'Motivos')

@section('content_header')
    <h1>Lista de motivos</h1>
@stop

@section('content')
  @livewire('reasons.index')
@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('reasonStore', () => {
            setTimeout(() => {
                $('#createReasonModal').modal('hide');
            }, 2500);
        });
        window.livewire.on('reasonUpdate', () => {
            $('#updateReasonModal').modal('hide');
        });
    </script>
@stop