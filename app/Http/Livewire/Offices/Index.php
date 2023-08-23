<?php

namespace App\Http\Livewire\Offices;

use App\Models\Office;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $name, $type, $office_id, $status, $confirming;
    public $updateMode = false;
    protected $paginationTheme = 'bootstrap';
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetInputFields(){
        $this->name = '';
        $this->type = '';
        $this->status = 1;
    }

    public function store()
    {
        $validationRules = [
            'name' => 'required|unique:offices|min:5|max:20',
            'type' => 'required|numeric',
            'status' => 'required|numeric',
        ];

        $validationMessages = [
            'name.required' => 'El nombre es requerido',
            'type.required' => 'El tipo es requerido',
            'status.required' => 'El estado es requerido',
            'name.unique' => 'El nombre ya ha sido usado',
        ];

        $validatedOffice = $this->validate($validationRules, $validationMessages);
        
        Office::create($validatedOffice);

        session()->flash('message', ['type' => 'success', 'title'=> 'Oficina creada exitosamente']);

        $this->resetInputFields();

        $this->emit('officeStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $office = Office::where('id',$id)->first();
        $this->office_id = $id;
        $this->name = $office->name;
        $this->type = $office->type;
        $this->status = $office->status;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validationRules = [
            'name' => 'required|min:5|max:20|unique:offices,name,'.$this->office_id,
            'type' => 'required|numeric',
            'status' => 'required|numeric',
        ];

        $validationMessages = [
            'name.required' => 'El nombre es requerido',
            'type.required' => 'El tipo es requerido',
            'status.required' => 'El estado es requerido',
            'name.unique' => 'El nombre ya ha sido usado',
        ];

        $validatedOffice = $this->validate($validationRules, $validationMessages);
        

        if ($this->office_id) {
            $office = Office::find($this->office_id);
            $office->update([
                'name' => $this->name,
                'type' => $this->type,
                'status' => $this->status,
            ]);
            $this->updateMode = false;
            session()->flash('message', ['type' => 'success', 'title'=> 'Oficina actualizada exitosamente']);
            $this->emit('officeUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            Office::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Oficina eliminada exitosamente']);
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
        $offices = Office::where('name', 'like', '%'.$this->search.'%')->paginate();
        return view('livewire.offices.index', compact('offices'));
    }
}