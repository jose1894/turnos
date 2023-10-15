<!-- Modal -->
<div wire:ignore.self class="modal fade" id="prosecutorModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar fiscal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                
                <form>                    
                    <div class="form-group">
                      <label for="reason">Fiscal</label>
                      <div wire:ignore>
                          <select id="prosecutor_id" class="form-control select2bs4" id="prosecutor" style="width: 100%;" placeholder="Seleccione" wire:model="prosecutor_id">
                            <option>
                            @foreach ($prosecutors as $prosecutor)
                              <option value="{{$prosecutor->id}}">{{ $prosecutor->people_type}}{{ $prosecutor->id_card}} {{ $prosecutor->name}} {{ $prosecutor->lastname}}
                            @endforeach
                          </select>
                        </div>
                        @error('prosecutor_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="assignProsecutor({{ $ticket_id }})" class="btn btn-primary close-modal">Asignar</button>
            </div>
        </div>
    </div>
</div>