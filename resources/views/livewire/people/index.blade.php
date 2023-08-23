<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-4">
            <div class="float-right">
                <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" data-target="#createPeopleModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear persona
                </button>
            </div>
        </div>
    </div>
    
    @include('livewire.people.create')

    @include('livewire.people.update')

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
                @if($people->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Tipo</th>
                                <th>C&eacute;dula</th>
                                <th>Status</th>
                                <th width="8%"></th>
                            </thead>
                            <tbody>
                                @foreach ($people as $person)
                                <tr>
                                    <td>{{ $person->id }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->lastname }}</td>
                                    <td>{{ $person->people_type }}</td>
                                    <td>{{ $person->id_card }}</td>
                                    <td>{{ $person->status == 1 ? 'Activo' : 'Inactivo'}}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updatePeopleModal" wire:click="edit({{ $person->id }})" class="btn btn-primary btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>

                                        @if($this->confirming===$person->id)
                                            <button wire:click="kill({{ $person->id }})"
                                                class="btn btn-danger btn-sm">Seguro?</button>
                                        @else
                                            <button wire:click="confirmDelete({{ $person->id }})" class="btn btn-warning btn-sm">
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
                        {{ $people->links() }}
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

