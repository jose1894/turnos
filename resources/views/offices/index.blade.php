@extends('adminlte::page')

@section('title', 'Oficinas')

@section('content_header')
    <h1>Lista de oficinas</h1>
@stop

@section('content')
  @livewire('offices.index')
@stop

@section('css')
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('officeStore', () => {
            setTimeout(() => {
                $('#createOfficeModal').modal('hide');
            }, 500);
        });
        window.livewire.on('officeUpdate', () => {
            $('#updateOfficeModal').modal('hide');
        });
    </script>
@stop