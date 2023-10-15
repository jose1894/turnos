<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updatePeopleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div>
                    </div>
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
                          <select name="people_type" id="people_type" class="form-control" placeholder="Seleccione" wire:model="people_type">
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
                    <div class="form-group row">
                      <div class="col-12 col-md-6">
                          <label for="prosecutor">Fiscal</label>
                          <select name="prosecutor" class="form-control" placeholder="Seleccione" wire:model="prosecutor">
                            <option>
                            <option value="S" selected>S&Iacute;
                            <option value="N">NO
                          </select>
                          @error('prosecutor') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                      <div class="col-12 col-md-6">
                          <label for="">Oficina de fiscal&iacute;a</label>
                          <select name="prosecutor_office" class="form-control" placeholder="Seleccione" wire:model="prosecutor_office">
                            <option>
                            @foreach ($prosecutorOffices as $office)
                              <option value="{{$office->id}}">{{ $office->name}}
                            @endforeach
                          </select>
                          @error('prosecutor_office') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Estatus</label>
                        <select name="status" class="form-control" placeholder="Seleccione" wire:model="status">
                          <option>
                          <option value="1">Activo
                          <option value="0">Inactivo
                        </select>
                        @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Guardar</button>
            </div>
       </div>
    </div>
</div>