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
            <div class="float-right">
                <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" data-target="#createOfficeModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear oficina
                </button>
            </div>
        </div>
    </div>
    
    @include('livewire.offices.create')

    @include('livewire.offices.update')

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
                @if($offices->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Oficina de fiscal&iacute;a</th>
                                <th>Status</th>
                                <th width="8%"></th>
                            </thead>
                            <tbody>
                                @foreach ($offices as $office)
                                <tr>
                                    <td>{{ $office->id }}</td>
                                    <td>{{ $office->name }}</td>
                                    <td>{{ $office->type == '1' ? 'Control' : ($office->type == '2' ? 'Jurídico' : 'No definido')}}</td>
                                    <td>{{ $office->prosecutor == 'S' ? 'Sí' : 'No' }}</td>
                                    <td>{{ $office->status == 1 ? 'Activo' : 'Inactivo' }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateOfficeModal" wire:click="edit({{ $office->id }})" class="btn btn-primary btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        {{-- <button wire:click="delete({{ $office->id }})" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button> --}}

                                        @if($confirming===$office->id)
                                            <button wire:click="kill({{ $office->id }})"
                                                class="btn btn-danger btn-sm">Seguro?</button>
                                        @else
                                            <button wire:click="confirmDelete({{ $office->id }})" class="btn btn-warning btn-sm">
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
                        {{ $offices->links() }}
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
