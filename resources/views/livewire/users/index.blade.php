<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-4">
            <div class="float-right">
                @can('users-create')
                <button type="button" class="btn btn-success" data-toggle="modal" wire:click="resetInputFields()" data-target="#createUserModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear usuario
                </button>
                @endcan
            </div>
        </div>
    </div>

    @can('users-create')
        @include('livewire.users.create')
    @endcan

    <div>
        @if (session()->has('message'))
            <script>
                let msg = @json(session('message'));
                toastr[msg.type](msg.title)
            </script>
        @endif
    </div>

    @can('users-create')
        @include('livewire.users.update')
    @endcan

    @can('users-change-password')
        @include('livewire.users.change-password')
    @endcan

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <input wire:model="search" class="form-control" placeholder="busqueda">
                </div>
                @if($users->count())
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Oficina</th>
                                <th>Roles</th>
                                <th>Email</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->office->name ?? 'SIN OFICINA ASIGNADA'}}</td>
                                    <td>
                                        @php
                                            $roles = $user->getRoleNames();
                                            foreach($roles as $role){
                                                echo '<span class="badge badge-pill badge-info">'.$role.'</span>';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td width="10%">
                                        @can('users-change-password')
                                            <button data-toggle="modal" data-target="#changePasswordModal" wire:click="showResetPasswordForm({{ $user->id }})" class="btn btn-success btn-sm">
                                                <i class="fa fa-asterisk" aria-hidden="true"></i>
                                            </button>
                                        @endcan
                                        
                                        @can('users-update')
                                            <button data-toggle="modal" data-target="#updateUserModal" wire:click="edit({{ $user->id }})" class="btn btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        @endcan

                                        
                                        @can('users-delete')
                                            @if($confirming===$user->id)
                                                <button wire:click="kill({{ $user->id }})"
                                                    class="btn btn-danger btn-sm">Seguro?</button>
                                            @else
                                                <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-warning btn-sm">
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
                        {{ $users->links() }}
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