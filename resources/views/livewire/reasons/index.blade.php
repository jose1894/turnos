<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-4">
            <div class="float-right">
                <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" data-target="#createReasonModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear motivo
                </button>
            </div>
        </div>
    </div>
    
    @include('livewire.reasons.create')

    @include('livewire.reasons.update')

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
                @if($reasons->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripci&oacute;n</th>
                                <th>Status</th>
                                <th width="8%"></th>
                            </thead>
                            <tbody>
                                @foreach ($reasons as $reason)
                                <tr>
                                    <td>{{ $reason->id }}</td>
                                    <td>{{ $reason->name }}</td>
                                    <td>{{ $reason->description }}</td>
                                    <td>{{ $reason->status == 1 ? 'Activo' : 'Inactivo'}}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateReasonModal" wire:click="edit({{ $reason->id }})" class="btn btn-primary btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        @if($this->confirming===$reason->id)
                                            <button wire:click="kill({{ $reason->id }})"
                                                class="btn btn-danger btn-sm">Seguro?</button>
                                        @else
                                            <button wire:click="confirmDelete({{ $reason->id }})" class="btn btn-warning btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                                </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $reasons->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

