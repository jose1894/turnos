<!-- Modal -->
<div wire:ignore.self wire:emit="refresh" class="modal fade" id="createTicketModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                
                <form>                    
                    @livewire('people.people-search-box')
                    @error('people_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    <input type='hidden' class="form-control" wire:model="people_id">       
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
                      <label for="reason">Motivo</label>
                      <div wire:ignore>
                          <select class="form-control select2bs4" id="reason_id" style="width: 100%;" placeholder="Seleccione" wire:model="reason_id">
                            <option>
                            @foreach ($reasons as $reason)
                              <option value="{{$reason->id}}">{{$reason->name}} 
                            @endforeach
                          </select>
                        </div>
                        @error('reason_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="record">Expediente</label>
                        <input type="text" class="form-control" id="record" wire:model="record" maxlength="15" required>
                        @error('record') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <textarea class="form-control" wire:model="comments"></textarea>
                        @error('comments') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="storeTicket()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>