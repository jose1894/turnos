<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\People;
use Illuminate\Validation\Rule;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $people_id,$name,$lastname,$gender,$people_type,$id_card,$address, $status, $confirming;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';

    private function rules(){
        
        $request = $this;
        if ( $this->updateMode ){
            $rules = [
                'name' => 'required|min:2',
                'lastname' => 'required|min:3',
                'gender' => 'required|in:M,F',
                'people_type' => ['required', 'in:V,E,P', Rule::unique('people')->where(function ($query) use ($request) {
                    return $query->where('people_type', $request->people_type)
                    ->where('id_card', $request->id_card);
                })->ignore($request->people_id)],
                'id_card' => ['required','string','max:10',Rule::unique('people')->where(function ($query) use ($request) {
                    return $query->where('id_card', $request->id_card)
                    ->where('people_type', $request->people_type);
                })->ignore($request->people_id)],
                'address' => 'required',
                'status' => 'required|numeric',
            ];
    
        }  else {
            $rules = [
                'name' => 'required|min:2',
                'lastname' => 'required|min:3',
                'gender' => 'required|in:M,F',
                'people_type' => ['required', 'in:V,E,P', Rule::unique('people')->where(function ($query) use ($request) {
                    return $query->where('people_type', $request->people_type)
                    ->where('id_card', $request->id_card);
                })],
                'id_card' => ['required','string','max:10',Rule::unique('people')->where(function ($query) use ($request) {
                    return $query->where('id_card', $request->id_card)
                    ->where('people_type', $request->people_type);
                })],
                'address' => 'required',
                'status' => 'required|numeric',
            ];
        }

        $messages = [
            'name.required' => 'El nombre es requerido',
            'lastname.required' => 'El apellido es requerido',
            'gender.required' => 'El genero es requerido',
            'people_type.required' => 'El tipo de persona es requerido',
            'people_type.unique' => 'El tipo de persona y la cédula ya existen',
            'id_card.unique' => 'El tipo de persona y la cédula ya existen',
            'id_card.required' => 'La cédula es requerida',
            'address.required' => 'La dirección es requerida',
            'status.required' => 'El estatus es requerido',
        ];

        return compact('rules','messages');
    }
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->lastname= '';
        $this->gender = '';
        $this->people_type = '';
        $this->id_card = '';
        $this->address = '';
        $this->status = 1;
    }

    public function storePeople()
    {
        $rules = $this->rules();

        $validatedPerson = $this->validate($rules['rules'], $rules['messages']);

        People::create($validatedPerson);

        session()->flash('message', ['type' => 'success', 'title'=> 'Persona creada exitosamente']);

        $this->resetInputFields();

        $this->emit('peopleStore'); // Close model to using to jquery
    }

    
    public function edit($id)
    {
        $this->updateMode = true;
        $people = People::where('id',$id)->first();
        $this->people_id = $id;
        $this->name = $people->name;
        $this->lastname = $people->lastname;
        $this->gender = $people->gender;
        $this->people_type = $people->people_type;
        $this->id_card = $people->id_card;
        $this->address = $people->address;
        $this->status = $people->status;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        
        $rules = $this->rules();

        $validatedPerson = $this->validate($rules['rules'], $rules['messages']);
        if ($this->people_id) {
            $people = People::find($this->people_id);
            $people->update($validatedPerson);
            $this->updateMode = false;
            session()->flash('message', ['type' => 'success', 'title'=> 'Persona actualizada exitosamente']);
            // $this->resetInputFields();
            $this->emit('peopleUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            People::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Persona eliminada exitosamente']);
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
        $people = People::
                where('name', 'like', '%'.$this->search.'%')
                ->orWhere('lastname', 'like', '%'.$this->search.'%')
                ->orWhere('id_card', 'like', '%'.$this->search.'%')
                ->paginate();
        $peopleType = People::PEOPLE_TYPE;
        return view('livewire.people.index',  compact('people', 'peopleType'));
    }
}
