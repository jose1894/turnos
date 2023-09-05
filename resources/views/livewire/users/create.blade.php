<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createUserModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">

                <form>
                    <div class="form-group">
                      <label for="office">Oficina</label>
                      <div wire:ignore>
                          <select class="form-control select2bs4" id="office" style="width: 100%;" placeholder="Seleccione" wire:model="office_id">
                            <option>
                            @foreach ($offices as $office)
                              <option value="{{$office->id}}">{{$office->name}} 
                            @endforeach
                          </select>
                        </div>
                        @error('office_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" wire:model="name" required>
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname">Apellido</label>
                        <input type="text" class="form-control" id="lastname" wire:model="lastname" required>
                        @error('lastname') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" wire:model="email" required>
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" wire:model="password" required>
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirme password</label>
                        <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation" required>
                        @error('password_c') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select class="form-control" id="rol" style="width: 100%;" placeholder="Seleccione" wire:model="rol">
                            <option>
                            @foreach ($roles as $rol)
                              <option value="{{$rol}}">{{$rol}} 
                            @endforeach
                          </select>
                        @error('rol') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>