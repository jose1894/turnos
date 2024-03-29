<div>
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="updateReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar motivo de atenci&oacute;n</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true close-btn">×</span>
                  </button>
              </div>
            <div class="modal-body">

                  <form>
                      <div class="form-group">
                          <label for="exampleFormControlInput1">Nombre</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese nombre" wire:model="name">
                          @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                      </div>
                      <div class="form-group">
                        <label for="">Descripci&oacute;n</label>
                        <textarea class="form-control" wire:model="description"></textarea>
                        @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
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
                  <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                  <button type="button" wire:click.prevent="update()" class="btn btn-primary close-modal">Guardar</button>
              </div>
          </div>
      </div>
  </div>
</div>
