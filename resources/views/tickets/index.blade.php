@extends('adminlte::page')

@section('title', 'Tickets')

@section('content_header')
    <h1>Tickets de atenci&oacute;n</h1>
@stop

@section('content')
  @livewire('tickets.index')
@stop

@section('css')
<style>
    .input-group > .select2-container--bootstrap {
        width: auto;
        flex: 1 1 auto;
    }

    .input-group > .select2-container--bootstrap .select2-selection--single {
        height: 100%;
        line-height: inherit;
        padding: 0.5rem 1rem;
    }
    .select2-container .select2-selection--single{
        height:35px
    }

    .input-group  .select2-container--default .select2-selection--single{
        border-radius: unset !important;
        border-bottom-left-radius: 4px !important;
        border-top-left-radius: 4px !important;
    }
    .input-group{
        margin-bottom: 16px;
        flex-wrap: inherit;    
    }
    .input-group .select2-container--bootstrap {
        width: auto;
        flex: 1 1 auto;
    }

</style>
@stop

@section('js')
    <script type="text/javascript">

        window.livewire.on('peopleStore', () => {
            $('#createTicketModal .close-btn').trigger('click');
        });
        window.livewire.on('ticketStore', () => {
            $('#createTicketModal .close-btn').trigger('click');
            $('#office').val(null).trigger('change.select2');
            $('#reason_id').val(null).trigger('change.select2');
        });
        window.livewire.on('ticketUpdate', () => {
            $('#updateTicketModal .close-btn').trigger('click');
        });
    </script>
@stop