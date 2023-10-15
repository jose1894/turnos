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

    @can('tickets-finish')
        @include('livewire.tickets.finalize')
    @endcan

    @include('livewire.tickets.prosecutor-modal')

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
                @if(auth()->user()->office !== null)

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
                                    <th>Detalles</th>
                                    <th>Oficina</th>
                                    <th>Status</th>
                                    <th width="15%"></th>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y h:i:s' ) }} <br>
                                            <label>Motivo</label> <br>
                                            {{ $ticket->reason->name }}
                                        </td>
                                        <td>
                                            {{ $ticket->ticket }}<br>
                                            <label>Expediente</label> <br>
                                            {{ $ticket->record }}
                                        </td>
                                        <td>
                                            @if ($ticket->people)
                                                {{ $ticket->people->people_type .' '. $ticket->people->id_card .' '. $ticket->people->name . ' ' . $ticket->people->lastname }}
                                            @else
                                                No asignado(a)
                                            @endif
                                            <br>
                                            <label>Inputado/V&iacute;ctima/Relacionado</label>
                                            <ul>
                                                @foreach ($ticket->accused as $accused)
                                                    <li>{{ $accused->people->name .' '. $accused->people->lastname }}                                            
                                                @endforeach
                                            </ul>

                                            @if ($ticket->prosecutor)
                                                <label>Fiscal</label><br>
                                                {{$ticket->prosecutor->people_type.$ticket->prosecutor->id_card .' '. $ticket->prosecutor->name .' ' .$ticket->prosecutor->lastname }}
                                                 <br>
                                                 <br>
                                            @endif

                                            @if ($ticket->comments)
                                                <label>Observaciones</label>
                                                <p class="text-justify">{{ $ticket->comments }}</p>
                                            @endif

                                        </td>
                                        <td>{{ $ticket->office->name }}</td>
                                        <td>{{ App\Models\Tickets::STATUSES[$ticket->status] }}</td>
                                        <td>
                                            @can('tickets-attend')
                                                @if($ticket->status === 'a')
                                                    <button wire:click="attend({{ $ticket->id }})" class="btn btn-primary btn-sm" data-placement="top" title="Atender">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </button>
                                                @endif
                                            @endcan

                                            @can('tickets-recall')
                                                @if($ticket->status === 'b')
                                                    <button wire:click="recall({{ $ticket->id }})" class="btn btn-success btn-sm" data-placement="top" title="Llamar">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </button>
                                                
                                                    <button  class="btn btn-primary btn-sm" wire:click="openProsecutorModal({{ $ticket->id }})" data-placement="top" title="Asignar Fiscal" data-toggle="modal" data-target="#prosecutorModal">
                                                        <i class="fa fa-user"></i>
                                                    </button>

                                                    @if ($ticket->prosecutor)
                                                        <button wire:click="callProsecutor({{$ticket->id}})" class="btn btn-warning btn-sm" title="Llamar a fiscal">
                                                            <i class="fas fa-exclamation"></i> 
                                                            <i class="fa fa-bullhorn fa-flip-horizontal"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            @endcan
                                            
                                            @can('tickets-finish')
                                                @if($ticket->status === 'b')
                                                    <button wire:click="openFinishModal({{ $ticket->id }})" alt="Finalizar" class="btn btn-success btn-sm" data-placement="top" title="Finalizar" data-toggle="modal" data-target="#finishTicketModal">
                                                        <i class="fa fa-forward"></i>
                                                    </button>
                                                @endif
                                            @endcan

                                            @can('tickets-disattend')
                                                @if($confirming===$ticket->id)
                                                    <button wire:click="kill({{ $ticket->id }})"
                                                        class="btn btn-danger btn-sm">Seguro?</button>
                                                @elseif ($ticket->status !== 's' && $ticket->status !== 'a' && $ticket->status !== 'c')
                                                    <button wire:click="confirmDelete({{ $ticket->id }})" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                @endif
                                            @endcan
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

            $('#finish_reason_id').on('change', function (e) {
                var data = $('#finish_reason_id').select2("val");
                @this.set('finish_reason_id', data);
            });

            $('#prosecutor_id').on('change', function (e) {
                var data = $('#prosecutor_id').select2("val");
                @this.set('prosecutor_id', data);
            });

            Livewire.on('setSelect2Values', (record) => {
                $('#finish_reason_id').val(record.finish_reason_id).trigger('change.select2');
            });
            
        })
    </script>

    <script type="text/javascript">
    </script>

</div>
