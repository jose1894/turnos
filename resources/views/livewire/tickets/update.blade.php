
<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateTicketModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">

                <form>
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="record">Expediente</label>
                      <input type="text" class="form-control" id="record" wire:model="record" required>
                      @error('record') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="exampleFormControlInput1">Abogado(a)</label>
                        <div wire:ignore>
                          <select class="form-control select2bs4" id="people_edt" name="people_id" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" wire:model="people_id">
                            <option>
                            @foreach ($people as $person)
                              <option value="{{ $person->id }}"> {{ $person->people_type.$person->id_card.' '.$person->name . ' ' .$person->lastname}}
                            @endforeach
                          </select>
                        </div>
                        @error('people_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="office">Oficina</label>
                      <div wire:ignore>
                          <select class="form-control select2bs4" id="office_edt" style="width: 100%;" placeholder="Seleccione" wire:model="office_id">
                            <option>
                            @foreach ($offices as $office)
                              <option value="{{$office->id}}">{{$office->name}} 
                            @endforeach
                          </select>
                        </div>
                        @error('office_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="reason">Motivo</label>
                      <div wire:ignore>
                          <select class="form-control select2bs4" id="reason_edt" style="width: 100%;" placeholder="Seleccione" wire:model="reason_id">
                            <option>
                            @foreach ($reasons as $reason)
                              <option value="{{$reason->id}}">{{$reason->name}} 
                            @endforeach
                          </select>
                        </div>
                        @error('reason_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <table class="table">
                          <thead>
                            <tr>
                              <td width="90%"><label>Inputado/V&iacute;ctima/Relacionado</label></td>
                              <td>
                                <button 
                                  class="btn btn-sm btn-outline-success" 
                                  wire:click.prevent="addAccused">+ Agregar
                                </button>
                              </td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($accuseds as $index => $accused)
                              <tr>
                                <td>
                                    <div wire:ignore>
                                      <select 
                                        class="form-control select2bs4 accuseds-edt accuseds-edt-{{$index}}-people_id" 
                                        id="accuseds.{{$index}}.people_id" 
                                        style="width: 100%;" 
                                        placeholder="Seleccione" 
                                        wire:model="accuseds.{{$index}}.people_id"
                                        name="accuseds[{{$index}}][people_id]">
                                        <option>
                                        @foreach ($people as $person)
                                            <option value="{{$person->id}}">{{$person->people_type.$person->id_card}}-{{$person->name}} {{$person->lastname}}
                                        @endforeach
                                      </select>
                                       @error('accuseds.{{$index}}.person_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </td>
                                <td>
                                  <button class="btn btn-outline-danger" wire:click.prevent="removeAccused({{$index}})">Borrar</button>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                        <label for="">Observaciones</label>
                        <textarea class="form-control" wire:model="comments"></textarea>
                        @error('comments') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
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