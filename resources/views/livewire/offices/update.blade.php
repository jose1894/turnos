<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateOfficeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar oficinas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="office_id">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" wire:model.defer="name" wire:model="name" autocomplete="off" id="exampleFormControlInput1" placeholder="Ingrese nombre">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Tipo</label>
                        <select name="type" class="form-control" placeholder="Seleccione" wire:model.defer="type" wire:model="type">
                          <option>
                          <option value="1">Control
                          <option value="2">Jur&iacute;dico
                        </select>
                        @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Oficina de Fiscal&iacute;a</label>
                        <select name="fiscalia" class="form-control" placeholder="Seleccione" wire:model="prosecutor">
                          <option>
                          <option value="N">NO
                          <option value="S">S&Iacute;
                        </select>
                        @error('prosecutor') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Estatus</label>
                        <select name="status" class="form-control" placeholder="Seleccione" wire:model.defer="status" wire:model="status">
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