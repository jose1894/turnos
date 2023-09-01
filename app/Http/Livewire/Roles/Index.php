<?php

namespace App\Http\Livewire\Roles;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    
    use WithPagination;
    public $search;
    public $name, $confirming, $role_id;
    public $selectedPermissions = [];
    public $updateMode = false;
    public $tabSelected = 0;
    protected $paginationTheme = 'bootstrap';

    public function selectedTab($tab){
        $this->tabSelected = $tab;
    }

    private function rules(){
        
        $request = $this;
        if ( $this->updateMode ){
            $rules = [
                'name' => 'required|min:3|unique:roles,name,'.$this->role_id,
                'selectedPermissions'=> ['required','exists:permissions,id']
            ];
    
        }  else {
            $rules = [
                'name' => 'required|min:3|unique:roles',
                'selectedPermissions'=>['required','exists:permissions,id']
            ];
        }

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'El nombre ya está registrado',
            'name.min' => 'El nombre debe tener mas de 3 caracteres',
            'selectedPermissions.required' => 'Debe seleccionar al menos un permiso'
        ];

        return compact('rules','messages');
    }
        
    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->selectedPermissions = [];
        $this->tabSelected = 0;
    }

    public function storeRole()
    {
        
        $rules = $this->rules();

        $validatedRole = $this->validate($rules['rules'], $rules['messages']);

        $role = Role::create($validatedRole);

        if($this->selectedPermissions)
        {   // remove unchecked values that comes with false assign it
            $this->selectedPermissions = Arr::where($this->selectedPermissions, function ($value) {
                return $value;
            });
        }

        $role->syncPermissions(Permission::find(array_keys($this->selectedPermissions))->pluck('name')->toArray());

        session()->flash('message', ['type' => 'success', 'title'=> 'Rol creado exitosamente']);

        $this->resetInputFields();

        $this->emit('roleStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $role = Role::where('id',$id)->first();
        $this->role_id = $id;
        $this->name = $role->name;
        $this->selectedPermissions = [];
        foreach($role->permissions as $key => $permission){
            $this->selectedPermissions[$key] = $permission->id;
        }

        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $rules = $this->rules();

        $validatedRole = $this->validate($rules['rules'], $rules['messages']);
        if ($this->role_id) {

            $role = Role::find($this->role_id);
            $role->update($validatedRole);

            if($this->selectedPermissions)
            {   // remove unchecked values that comes with false assign it
                $this->selectedPermissions = Arr::where($this->selectedPermissions, function ($value) {
                    return $value;
                });
            }

            $role->syncPermissions(Permission::find(array_keys($this->selectedPermissions))->pluck('name')->toArray());
            $this->updateMode = false;
            session()->flash('message', ['type' => 'success', 'title'=> 'Rol actualizado exitosamente']);
            $this->emit('roleUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            Role::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Rol eliminado exitosamente']);
        }
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        $this->delete($id);
    }

    
    public function render()
    {
        $roles = Role::where('name', 'like', '%'.$this->search.'%')->paginate();
        return view('livewire.roles.index', compact('roles'));
    }
}
