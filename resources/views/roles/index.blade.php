@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')
    @can('roles-list')
        @livewire('roles.index')
    @endcan

    @cannot('roles-list')
        <h2>No tiene permisos para este m&oacute;dulo</h2>
    @endcannot
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('roleStore', () => {
            setTimeout(() => {
                $('#createRoleModal .close-btn').trigger('click');
            }, 500);
        });
        window.livewire.on('roleUpdate', () => {
            $('#updateRoleModal .close-btn').trigger('click');
        });
    </script>
@stop