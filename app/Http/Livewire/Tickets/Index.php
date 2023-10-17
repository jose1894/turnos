<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tickets;
use App\Models\Office;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Events\NewMessage;
use App\Models\Accused;
use App\Models\Reason;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $ticket_id,$ticket,$people_id,$office_id,$comments, $confirming, $user_id, $record,  $data, $reason_id, $finish_reason_id;
    public $name, $lastname,$gender,$people_type,$id_card,$address, $status;
    public $updateMode = false;
    public $people, $accuseds, $accuseds_edt;
    public $peopleType;
    public $offices;
    public $reasons;    
    public $prosecutorOffices;
    protected $listeners = ['updatePeopleId' => 'updateId',];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updateId($id){
        $this->people_id = $id;
    }

    public function resetInputFields(){
        $this->ticket = '';
        $this->people_id= '';
        $this->office_id = '';
        $this->reason_id = '';
        $this->comments = '';
        $this->record = '';
        $this->accuseds = [
            ['people_id' => '', 'people_type' => '', 'id_card' => '', 'name' => '', 'lastname' => '']
        ];
        $this->updateMode = false;
        $this->emit('applySelect2');
        $this->emit('resetSearchBoxField');

    }

    public function resetPeopleInputFields(){
        $this->name = '';
        $this->lastname= '';
        $this->gender = '';
        $this->people_type = '';
        $this->id_card = '';
        $this->address = '';
        $this->status = 1;
    }

    public function rules()
    {
        $record = $this->record;
        if(!$this->updateMode){
            $rules = [
                'office_id' => 'required|numeric',
                'reason_id' => 'required|numeric',
                'people_id' => ['required_without:accuseds'],
                'record' => [
                    'required',
                    'max:50',
                    Rule::unique('tickets')->where(function ($query) use ($record) {
                        return $query
                            ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
                            ->where('record', '=', $record)
                            ->where('deleted_at', '=', null);
                    }),
                ],
                
            ];
        } else {
            $rules = [
                'office_id' => 'required|numeric',
                'reason_id' => 'required|numeric',
                'people_id' => ['required_without:accuseds'],
                'record' => [
                    'required',
                    'max:30',
                    Rule::unique('tickets')
                        ->ignore($this->record, 'record')
                        ->where(function ($query) use ($record) {
                            return $query
                                ->whereDate('created_at', Carbon::today()->format('Y-m-d'))
                                ->where('record', '=', $record)
                                ->where('deleted_at', '=', null);
                        }),
                ],
                
            ];
        }

        $messages = [
            'office_id.required' => 'La oficina es requerida',
            'reason_id.required' => 'El motivo es requerido',
            'record.required' => 'El expediente es requerido',
            'record.unique' => 'El expediente ya ha sido ingresado el dia de hoy',
            'record.max' => 'El expediente no puede superar los 15 caracteres',
        ];        
        
        return compact('rules','messages');
    }

    public function peopleRules(){
        $request = $this;
        $rules = [
            'name' => 'required|min:2',
            'lastname' => 'required|min:3',
            'gender' => 'required|in:M,F',
            'people_type' => ['required', 'in:V,E,P,INPRE', Rule::unique('people')->where(function ($query) use ($request) {
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

    public function storePeople()
    {
        $rules = $this->peopleRules();

        $validatedPerson = $this->validate($rules['rules'], $rules['messages']);

        People::create($validatedPerson);

        session()->flash('message', ['type' => 'success', 'title'=> 'Persona creada exitosamente']);

        $this->resetPeopleInputFields();

        $this->emit('peopleStore'); // Close model to using to jquery
    }

    public function storeTicket()
    {
        
        $rules = $this->rules();
        
        $this->validate($rules['rules'], $rules['messages']);

        if(empty($this->accuseds) || empty($this->accuseds[0]['people_id'])){
            session()->flash('message', ['type' => 'error', 'title'=> 'Debe seleccionar un imputado/victima/vinculado']);
            return;
        }

        $tickets = Tickets::whereDate('created_at', Carbon::today())->where('office_id', $this->office_id)->get();
        $this->ticket = Office::find($this->office_id)->name.'-'.(count($tickets) + 1);
        $this->user_id = auth()->guard()->user()->id;
        $ticket = Tickets::create([
            'ticket' => $this->ticket,
            'user_id' => $this->user_id,
            'people_id' => ($this->people_id ? $this->people_id : null),
            'office_id' => $this->office_id,
            'reason_id' => $this->reason_id,
            'record' => $this->record,
            'comments' => $this->comments ?? '',
        ]);

        if(sizeOf($this->accuseds) > 0){
            
            foreach($this->accuseds as $accused){
                Accused::create([
                    'people_id' => $accused['people_id'],
                    'ticket_id' => $ticket['id']
                ]);
            }
        }

        session()->flash('message', ['type' => 'success', 'title'=> 'Ticket creado exitosamente']);
        event(new NewMessage(json_encode(['update' => true]),'office-'.$this->office_id));
        event(new NewMessage(json_encode(['ticket' => $this]),'tickets-list'));

        $this->resetInputFields();
        $this->emit('ticketStore'); // Close model to using to jquery

    }

    public function edit($id){

        $this->updateMode = true;
        $ticket = Tickets::where('id',$id)->first();
        $this->ticket_id = $ticket->id;
        $this->ticket = $ticket->ticket;
        $this->people_id= $ticket->people_id;
        $this->office_id = $ticket->office_id;
        $this->reason_id = $ticket->reason_id;
        $this->comments = $ticket->comments;
        $this->status = $ticket->status;
        $this->record = $ticket->record;
        $this->accuseds = [];
        $accuseds = Accused::where('ticket_id', $ticket->id)->get();
        foreach($accuseds as $accused){
             $this->accuseds[] = ['people_id' => $accused->people_id, 'people_type' => $accused->people->people_type, 'id_card' => $accused->people->id_card, 'name' => $accused->people->name, 'lastname' => $accused->people->lastname];   
        }
        $this->emit('setSelect2Values', $this);
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {   
        $rules = $this->rules();
        if(empty($this->people_id)){
            $this->people_id = NULL;
        }
        $this->validate($rules['rules'], $rules['messages']);

        if(empty($this->accuseds) || empty($this->accuseds[0]['people_id'])){
            session()->flash('message', ['type' => 'error', 'title'=> 'Debe seleccionar un imputado/victima/vinculado']);
            return;
        }
        if ($this->ticket_id) {
            $ticket = Tickets::find($this->ticket_id);
            $ticketArr = [
                'people_id' => $this->people_id,
                'office_id' => $this->office_id,
                'reason_id' => $this->reason_id,
                'comments' => $this->comments,
                'record' => $this->record,
            ];
            $ticket->update($ticketArr);
            $ticket->accused()->delete();
            $this->updateMode = false;
            if($this->accuseds[0]['people_id']){
                foreach($this->accuseds as $accused){
                    Accused::create([
                        'people_id' => $accused['people_id'],
                        'ticket_id' => $ticket['id']
                    ]);
                }
            }
            session()->flash('message', ['type' => 'success', 'title'=> 'Ticket actualizado éxitosamente']);
            event(new NewMessage(json_encode(['update' => true]),'office-'.$this->office_id));
            event(new NewMessage(json_encode(['update' => true]),'tickets-list'));
            // $this->resetInputFields();
            $this->emit('ticketUpdate'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if($id){
            Tickets::where('id',$id)->delete();
            session()->flash('message', ['type' => 'success', 'title'=> 'Ticket eliminado exitosamente']);
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

    public function addAccused()
    {
        $index = sizeOf($this->accuseds);
        $this->accuseds[$index] = ['people_id' => '', 'people_type' => '', 'id_card' => '', 'name' => '', 'lastname' => ''];
        $this->emit('reApplySelect2', $index, $this->updateMode);
    }
    public function removeAccused($index)
    {
        unset($this->accuseds[$index]);
        $this->accuseds = array_values($this->accuseds);
        $this->emit('setSelect2Values', $this);
    }

    public function mount() {
        $this->people = People::where('status','1')->get();
        $this->peopleType = People::PEOPLE_TYPE;
        $this->offices = Office::where('status','1')->get();
        $this->reasons = Reason::where('status','1')->get();
        $this->accuseds[] = ['people_id' => '', 'people_type' => '', 'id_card' => '', 'name' => '', 'lastname' => ''];
        $this->prosecutorOffices = Office::where('prosecutor', 'S')->get();
    }

    public function render()
    {
        $search = $this->search;
        $tickets = Tickets::whereHas('people', function($query) use($search){
            return $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('record', 'like', '%'.$search.'%')
                        ->orWhere('id_card', 'like', '%'.$search.'%');
        })
        ->orWhere('created_at','like', '%'. $search .'%')->orderBy('created_at','desc')->paginate();
        return view('livewire.tickets.index', compact('tickets'));
    }

}
