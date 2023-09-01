<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-4">
            <div class="float-right">
                <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" data-target="#createRoleModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear rol
                </button>
            </div>
        </div>
    </div>
    
    @include('livewire.roles.create')

    @include('livewire.roles.update')

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
                @if($roles->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th width="8%"></th>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateRoleModal" wire:click="edit({{ $role->id }})" class="btn btn-primary btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        @if($this->confirming===$role->id)
                                            <button wire:click="kill({{ $role->id }})"
                                                class="btn btn-danger btn-sm">Seguro?</button>
                                        @else
                                            <button wire:click="confirmDelete({{ $role->id }})" class="btn btn-warning btn-sm">
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
                        {{ $roles->links() }}
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

