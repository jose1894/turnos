<?php

namespace App\Http\Livewire\Users;

use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    public $search,$name,$user_id, $lastname, $office_id, $email, $password, $confirming, $password_confirmation, $rol;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->lastname = '';
        $this->office_id = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->email = '';
        $this->rol = '';
    }

    private function rules(){
        $request = $this;

        if ($request->updateMode){
            $rules = [
                'name' => 'required|string|min:3|max:30',
                'lastname' => 'required|string|min:3|max:30',
                'office_id' => 'nullable',
                'rol' => 'required',
                'email' => 'email|unique:users,id,'.$request->id,
            ];
        } else {
            $rules = [
                'name' => 'required|string|min:3|max:30',
                'lastname' => 'required|string|min:3|max:30',
                'office_id' => 'nullable',
                'email' => 'email|unique:users',
                'rol' => 'required',
                'password' => [
                    'required',
                    'min:6',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                    'confirmed'
                ]
            ];
        }

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre no debe tener mas de 30 caracteres',
            'lastname.required' => 'El apellido es requerido',
            'lastname.min' => 'El apellido debe tener al menos 3 caracteres',
            'lastname.max' => 'El apellido no debe tener mas de 30 caracteres',
            'office_id.required' => 'La oficina es requerida',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya está siendo utilizado',
            'password.required' => 'El password es requerido',
            'rol.required' => 'El rol es requerido',
            'password.min' => 'El password debe tener al menos 6 caracteres',
            'password.regex' => 'El password debe tener caracteres de la A-Z, mayusculas y minusculas, al menos un numero, al menos un caracter especial (!$#%)',
            'password.confirmed' => 'El password debe coincidir',
        ];

        return compact('rules', 'messages');
    }

    public function store(){
        $this->office_id = empty($this->office_id) ?  NULL : $this->office_id;
        $rules = $this->rules();
        $validatedUser = $this->validate($rules['rules'], $rules['messages']);

        $user = User::create($validatedUser);

        $user->assignRole($validatedUser['rol']);
        session()->flash('message', ['type' => 'success', 'title' => 'Usuario creado exitosamente']);

        $this->resetInputFields();

        $this->emit('userStore');
    }

    public function showResetPasswordForm($id){
        $this->user_id = $id;
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function savePassword($id){
        
        $this->validate([
            'password' => [
                'required',
                'min:6',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'
            ]
        ],
        [
            'password.required' => 'El password es requerido',
            'password.min' => 'El password debe tener al menos 6 caracteres',
            'password.regex' => 'El password debe tener caracteres de la A-Z, mayusculas y minusculas, al menos un caracter especial',
            'password.confirmed' => 'El password debe coincidir',
        ]);

        $user = User::where('id', $id)->first();
        $user->password = Hash::make($this->password);
        $user->save();
        session()->flash('message', ['type' => 'success', 'title' => 'Contraseña cambiada exitosamente']);

    }

    public function edit($id){
        $this->updateMode = true;
        $user = User::where('id', $id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->office_id = $user->office_id;
        $this->email = $user->email;
        $this->rol = $user->getRoleNames()[0];
    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->office_id = empty($this->office_id) ?  NULL : $this->office_id;
        $rules = $this->rules();
        
        $validatedUser = $this->validate($rules['rules'], $rules['messages']);
        
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update($validatedUser);
            $user->syncRoles($validatedUser['rol']);
            $this->updateMode = false;
            session()->flash('message', ['type' => 'success', 'title'=> 'Usuario actualizado exitosamente']);
            $this->resetInputFields();
            $this->emit('userUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            User::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Usuario eliminado exitosamente']);
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
        $search = $this->search;
        $offices = Office::where('status','1')->get();
        $roles = Role::where ('name', '<>', 'Superadmin')->pluck('name', 'name')->all();
        $users = User::where('name', 'like', '%'.$search.'%')
        ->orWhere('lastname', 'like', "%".$search."%")
        ->orWhere('email', 'like', '%'. $search .'%')
        ->orWhereHas('office', function($query) use ($search){
            return $query->where('name', 'like', '%'.$search.'%');
        })
        ->paginate();
        return view('livewire.users.index', compact('users', 'offices', 'roles'));
    }
}
