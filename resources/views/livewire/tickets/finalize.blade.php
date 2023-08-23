<!-- Modal -->
<div wire:ignore.self class="modal fade" id="finishTicketModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                
                <form>                    
                    <div class="form-group">
                      <label for="reason">Motivo de finalizaci&oacute;n</label>
                      <div wire:ignore>
                          <select class="form-control select2bs4" id="finish_reason_id" style="width: 100%;" placeholder="Seleccione" wire:model="finish_reason_id">
                            <option>
                            @foreach ($finishReasons as $reason)
                              <option value="{{$reason->id}}">{{$reason->name}} 
                            @endforeach
                          </select>
                        </div>
                        @error('finish_reason_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="finish({{ $ticket_id }})" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>