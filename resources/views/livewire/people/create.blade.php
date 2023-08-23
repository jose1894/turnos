<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createPeopleModal" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-row">
                      <div class="form-group col-12 col-md-6">
                          <label for="nombres">Nombres</label>
                          <input type="text" class="form-control" id="nombres" placeholder="Ingrese nombre" wire:model="name">
                          @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group col-12 col-md-6">
                          <label for="apellidos">Apellidos</label>
                          <input type="text" class="form-control" id="apellidos" placeholder="Ingrese apellido" wire:model="lastname">
                          @error('lastname') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-12 col-md-4">
                          <label for="genero-m">
                            Masculino
                            <input type="radio" class="form-control" id="genero-m" value="M" name="genero" wire:model="gender">
                          </label>
                          <label for="genero-f">
                            Femenino
                            <input type="radio" class="form-control" id="genero-f" value="F" name="genero"  wire:model="gender">
                          </label>                        
                          @error('genero') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group col-12 col-md-4">
                          <label for="people_type">Tipo persona</label>
                          <select name="status" id="people_type" class="form-control" placeholder="Seleccione" wire:model="people_type">
                            <option>
                            @foreach ($peopleType as $key => $type)
                              <option value="{{ $key }}"> {{ $type }}
                            @endforeach
                          </select>
                          @error('people_type') <span class="text-danger error">{{ $message }}</span>@enderror                    
                      </div>
                      <div class="form-group col-12 col-md-4">
                          <label for="id_card">Identificaci&oacute;n</label>
                          <input type="text" class="form-control" id="id_card" placeholder="Ingrese identificaci&oacute;n" wire:model="id_card">
                          @error('id_card') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Direcci&oacute;n</label>
                        <textarea class="form-control" id="address" placeholder="Ingrese direcci&oacute;n" wire:model="address">
                        </textarea>
                        @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Estatus</label>
                        <select name="status" class="form-control" placeholder="Seleccione" wire:model="status">
                          <option value="1" selected>Activo
                          <option value="0">Inactivo
                        </select>
                        @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="storePeople()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>