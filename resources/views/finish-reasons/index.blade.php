@extends('adminlte::page')

@section('title', 'Motivos')

@section('content_header')
    <h1>Lista de motivos de finalizaci&oacute;n</h1>
@stop

@section('content')
  @livewire('finish-reason.index')
@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('finishReasonStore', () => {
            setTimeout(() => {
                $('#createFinishReasonModal').modal('hide');
            }, 2500);
        });
        window.livewire.on('finisReasonUpdate', () => {
            $('#updateFinishReasonModal').modal('hide');
        });
    </script>
@stop