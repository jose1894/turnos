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
            $('#createPeopleModal .close-btn').trigger('click');
        });
        window.livewire.on('ticketStore', () => {
            $('#createTicketModal .close-btn').trigger('click');
            $('#office').val(null).trigger('change.select2');
            $('#reason_id').val(null).trigger('change.select2');
        });
        window.livewire.on('ticketUpdate', () => {
            $('#updateTicketModal .close-btn').trigger('click');
        });

        window.livewire.on('applySelect2', () => {
            const accuseds = document.querySelector('.accuseds')
            $('.select2bs4').select2({
                placeholder: "Seleccione",
                allowClear: true
            });

            $(accuseds).select2({
                ajax:{
                    url: '{{ route('get-people') }}',
                    dataType: 'json',
                    delay:50,
                    data: function(params){
                        return {
                            searchItem: params.term
                        }
                    },
                    processResults:function (data, params) {
                        return {
                            results: data.data
                        }
                    },
                    cache: true,
                },
                'placeholder': 'Seleccione',
                templateResult: templateResult,
                templateSelection: templateSelection
            });
        });

        function templateResult(data){
            if(data.loading){
                return data.text
            }

            return data.people_type + data.id_card + ' ' + data.name + ' ' + data.lastname

        }

        function templateSelection(data){
            console.log('select')
            if(!data.people_type) return data.text
            
            return data.people_type + data.id_card + ' ' + data.name + ' ' + data.lastname

        }

        window.livewire.on('reApplySelect2', (index, updateMode) => {
            if (updateMode){
                let element = document.querySelector('.accuseds-edt-'+index+'-people_id')
                $(element).select2({
                    ajax:{
                        url: '{{ route('get-people') }}',
                        dataType: 'json',
                        delay:50,
                        data: function(params){
                            return {
                                searchItem: params.term
                            }
                        },
                        processResults:function (data, params) {
                            return {
                                results: data.data
                            }
                        },
                        cache: true,
                    },
                    'placeholder': 'Seleccione',
                    templateResult: templateResult,
                    templateSelection: templateSelection
                });
            }else{
                let element = document.getElementById('accuseds.'+index+'.people_id')
                $(element).select2({
                    ajax:{
                        url: '{{ route('get-people') }}',
                        dataType: 'json',
                        delay:50,
                        data: function(params){
                            return {
                                searchItem: params.term
                            }
                        },
                        processResults:function (data, params) {
                            return {
                                results: data.data
                            }
                        },
                        cache: true,
                    },
                    'placeholder': 'Seleccione',
                    templateResult: templateResult,
                    templateSelection: templateSelection
                });
            }
        });
    </script>
@stop