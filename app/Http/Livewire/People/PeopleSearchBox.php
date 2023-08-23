<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use App\Models\People;

class PeopleSearchBox extends Component
{
    public $showdiv = false;
    public $search = "";
    public $records;
    public $peopleDetail;
    public $showresult = false;
    protected $listeners = ['resetSearchBoxField' => 'resetField'];

    public function resetField(){
        $this->search = '';
        $this->records = '';
        $this->peopleDetail = '';
    }
    
    // Fetch records
    public function searchResult(){

        if(!empty($this->search)){
            
            $this->records = People::orderby('lastname','asc')
                      ->where('status', 1)
                      ->where('name','like','%'.$this->search.'%')
                      ->orWhere('lastname','like','%'.$this->search.'%')
                      ->orWhere('id_card','like','%'.$this->search.'%')
                      ->limit(5)
                      ->get();

            $this->showdiv = true;
            $this->showresult = true;
        }else{
            $this->showdiv = false;
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchPeopleDetail($id = 0){

        $record = People::where('id',$id)->first();

        $this->search = $record->people_type. $record->id_card .' '. $record->name . ' ' .$record->lastname;
        $this->peopleDetail = $record;
        $this->showdiv = false;
        $this->showresult = false;

        $this->emit('updatePeopleId', $record->id);
    }

    public function render()
    {

        return view('livewire.people.people-search-box');
    }
}
