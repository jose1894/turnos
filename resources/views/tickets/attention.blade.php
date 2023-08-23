@extends('adminlte::page')

@section('meta_tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Atencion')

@section('content_header')
    <h1>Atenci&oacute;n <b>{{ auth()->guard()->user()->office->name }}</b></h1>
@stop

@section('content')
  @livewire('tickets.attention')
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

<script type="module">
      Echo.channel('office-{{ auth()->guard()->user()->office->id }}').listen('NewMessage', (e) => {
        Livewire.emit('refreshAttentionComponent');
      })
</script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  window.livewire.on('finishTicket', () => {
          $('#finishTicketModal').modal('hide');
          $('#finish_reason_id').val(null).trigger('change.select2');
     
  });
</script>


@endsection