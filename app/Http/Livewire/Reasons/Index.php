<?php

namespace App\Http\Livewire\Reasons;

use App\Models\Reason;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $name, $description, $status, $confirming, $reason_id;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';

    private function rules(){
        
        $request = $this;
        if ( $this->updateMode ){
            $rules = [
                'name' => 'required|min:3|unique:reasons,name,'.$this->reason_id,
                'description' => 'string',
                'status' => 'required|numeric',
            ];
    
        }  else {
            $rules = [
                'name' => 'required|min:3|unique:reasons',
                'description' => 'string',
                'status' => 'required|numeric',
            ];
        }

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'El nombre ya está registrado',
            'status.required' => 'El estatus es requerido',
        ];

        return compact('rules','messages');
    }
        
    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->description = '';
        $this->status = 1;
    }

    public function storeReason()
    {
        $rules = $this->rules();

        $validatedReason = $this->validate($rules['rules'], $rules['messages']);

        Reason::create($validatedReason);

        session()->flash('message', ['type' => 'success', 'title'=> 'Motivo creado exitosamente']);

        $this->resetInputFields();

        $this->emit('reasonStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $reason = Reason::where('id',$id)->first();
        $this->reason_id = $id;
        $this->name = $reason->name;
        $this->description = $reason->description;
        $this->status = $reason->status;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $rules = $this->rules();

        $validatedReason = $this->validate($rules['rules'], $rules['messages']);
        if ($this->reason_id) {

            $reason = Reason::find($this->reason_id);
            $reason->update($validatedReason);
            $this->updateMode = false;
            session()->flash('message', ['type' => 'success', 'title'=> 'Motivo actualizado exitosamente']);
            $this->emit('reasonUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            Reason::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Motivo eliminado exitosamente']);
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
        $reasons = Reason::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')->paginate();
        return view('livewire.reasons.index', compact('reasons'));
    }
}
