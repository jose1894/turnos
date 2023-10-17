<div class="container-fluid">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12 my-4">
            @can('tickets-create')
                <div class="float-right">
                    <a class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" href="#createTicketModal">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear ticket
                    </a>
                </div>
            @endcan
        </div>
    </div>
    
    @can('tickets-create')
        @include('livewire.tickets.create')
    @endcan

    @can('tickets-update')
        @include('livewire.tickets.update')
    @endcan

    @can('people-create')
        @include('livewire.people.create')
    @endcan

    <div>
        @if (session()->has('message'))
            <script>
                let msg = @json(session('message'));
                toastr[msg.type](msg.title)
            </script>
        @endif
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <input wire:model="search" class="form-control" placeholder="busqueda">
                </div>
                @if($tickets->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Ticket</th>
                                <th>Expediente</th>
                                <th>Abogado(a)</th>
                                <th>Oficina</th>
                                <th>Status</th>
                                <th width="8%"></th>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y h:i:s' ) }}</td>
                                    <td>{{ $ticket->ticket }}</td>
                                    <td>{{ $ticket->record }}</td>
                                    <td>
                                        @if ($ticket->people)
                                            {{ $ticket->people->people_type .' '. $ticket->people->id_card .' '. $ticket->people->name . ' ' . $ticket->people->lastname }}
                                        @else
                                            No asignado(a)
                                        @endif
                                    </td>
                                    <td>{{ $ticket->office->name }}</td>
                                    <td>{{ App\Models\Tickets::STATUSES[$ticket->status] }}</td>
                                    <td>
                                        @if ($ticket->status === 'a')
                                            @can('tickets-update')
                                                <button data-toggle="modal" data-target="#updateTicketModal" wire:click="edit({{ $ticket->id }})" class="btn btn-primary btn-sm">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            @endcan

                                            @can('tickets-delete')
                                                @if($confirming===$ticket->id)
                                                    <button wire:click="kill({{ $ticket->id }})"
                                                        class="btn btn-danger btn-sm">Seguro?</button>
                                                @else
                                                {{-- @elseif ($ticket->status !== 'a' && $ticket->status !== 'b' && $ticket->status !== 'c') --}}
                                                    <button wire:click="confirmDelete({{ $ticket->id }})" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                @endif
                                            @endcan
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $tickets->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            $('select').select2({
                placeholder: "Seleccione",
                allowClear: true
            })
            {{-- $('#office').select2() --}}

            $('#people').on('change', function (e) {
                var data = $('#people').select2("val");
                @this.set('people_id', data);
            });
            
            $('#office').on('change', function (e) {
                var data = $('#office').select2("val");
                @this.set('office_id', data);
            });

            $('body').on('change','.accuseds', function (e) { 
                var data = $(this).select2("val");
                @this.set(this.id, data);
            });

            $('body').on('change','.accuseds-edt', function (e) { 
                var data = $(this).val();
                @this.set(this.id, data);
            });

            $('#reason_id').on('change', function (e) {
                var data = $('#reason_id').select2("val");
                @this.set('reason_id', data);
            });

            $('#people_edt').on('change', function (e) {
                var data = $('#people_edt').select2("val");
                @this.set('people_id', data);
            });
            
            $('#office_edt').on('change', function (e) {
                var data = $('#office_edt').select2("val");
                @this.set('office_id', data);
            });

            $('#reason_edt').on('change', function (e) {
                var data = $('#reason_edt').select2("val");
                @this.set('reason_id', data);
            });


            Livewire.on('setSelect2Values', (record) => {
                $('#people_edt').val(record.people_id).trigger('change.select2');
                $('#office_edt').val(record.office_id).trigger('change.select2');
                $('#reason_edt').val(record.reason_id).trigger('change.select2');
                
                $.each(record.accuseds, function(index, value){
                    console.log(value)
                    let element = document.querySelector('.accuseds-edt-'+index+'-people_id')
                    const text = value.people_type + value.id_card + '-' + value.name + ' ' + value.lastname;
                    const id = value.people_id;
                    $(element).empty();
                    $(element).append(new Option(text, id));
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
                    })
                    $(element).select2('data', { id, text} )
                    {{-- .val(value.people_id).trigger('change.select2') --}}
                })
            });


            function templateResult(data){
                if(data.loading) return data.text;
                return data.people_type + data.id_card + ' ' + data.name + ' ' + data.lastname;
            }

            function templateSelection(data){
                if(data.selected){
                    return data.text
                }
                return data.people_type + data.id_card + ' ' + data.name + ' ' + data.lastname
            }
        })
    </script>

</div>
