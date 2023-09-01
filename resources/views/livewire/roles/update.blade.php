<div>
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar rol</h5>
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
                            @php
                                $count = 1;
                                $modules = \Spatie\Permission\Models\Permission::select('module')->distinct()->orderBy('module')->get()->toArray();
                                $tabs = '';
                                $contents = '';
                            @endphp

                            @foreach ($modules as $key => $module)
                                @php
                                    $tabs .= '
                                    <li class="nav-item">
                                        <a class="nav-link '.($tabSelected === $count ? 'active' : '').'" id="'.$module['module'].'-tab" wire:click="selectedTab('.$count.')" data-toggle="tab" href="#'.$module['module'].'" role="tab" aria-selected="true">'.$module['module'].'</a>
                                    </li>';

                                    $permissions = '';
                                    foreach (\Spatie\Permission\Models\Permission::where('module', $module['module'])->get() as $key => $value){
                                        $permissions .= '
                                            <div class="form-check">
                                                <label class="flex-fill">
                                                    <input type="checkbox" id="permission-'.$value->id.'" wire:model.defer="selectedPermissions.'.$value->id.'" class="form-check-input">
                                                    '.$value->name.'
                                                </label>
                                            </div>';
                                    }

                                    $contents .= '
                                        <div class="tab-pane fade '.(($tabSelected === $count) ? 'show active' : '').' mt-3" id="'.$module['module'].'" role="tabpanel" aria-labelledby="'.$module['module'].'-tab">
                                            '.$permissions.'
                                        </div>
                                    ';
                                    $count++;
                                    
                                @endphp
                            @endforeach
                            <ul class="nav nav-tabs" id="modules" role="tablist">
                                {!! $tabs !!}
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                {!! $contents !!}
                            </div>
                            @error('selectedPermissions') <span class="text-danger error">{{ $message }}</span>@enderror
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
