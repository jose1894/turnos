@extends('adminlte::page')

@section('meta_tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
  @livewire('users.index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            setTimeout(() => {
                $('#createUserModal').modal('hide');
            }, 2500);
        });
        window.livewire.on('userUpdate', () => {
            $('#updateUserModal').modal('hide');
        });
    </script>

            <script type="module">
                Echo.channel('office-{{ auth()->guard()->user()->office->id }}').listen('NewMessage', (e) => {
                    console.log(JSON.parse(e.message))
                    Livewire.emit('refreshAttentionComponent');
                })


                Echo.channel('home').listen('NewMessage', (e) => {
                    console.log(JSON.parse(e.message))
                })
        </script>
@stop