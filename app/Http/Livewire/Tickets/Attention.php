<?php

namespace App\Http\Livewire\Tickets;

use App\Events\NewMessage;
use App\Models\FinishReason;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tickets;
use App\Models\Office;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Attributes\Ticket;

class Attention extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $ticket_id, $finish_reason_id, $confirming;
    public $name, $lastname,$gender,$people_type,$id_card,$address, $status;
    public $updateMode = false;
    protected $listeners = ['refreshAttentionComponent' => '$refresh'];

    public function disattend($id)
    {
        if($id){
            Tickets::where('id',$id)->update(['status' => 'i']);
            session()->flash('message', ['type' => 'success', 'title'=> 'Ticket desatendido exitosamente']);
        }
    }

    public function attend($id)
    {
        $office = auth()->guard()->user()->office_id;
        $attendedTicket = Tickets::where('id',$id)->where('status', 'b')->where('office_id', $office)->get()->first();
        $attendedTickets = Tickets::where('status', 'b')->where('office_id', $office)->get();
        if($id){            
            if ( sizeof($attendedTickets) <= 0 || !is_null($attendedTicket) ){
                Tickets::where('id',$id)->update(['status' => 'b', 'attended' => Carbon::now()]);
                session()->flash('message', ['type' => 'success', 'title'=> 'Ticket llamado']);
                event(new NewMessage(json_encode(['process' => 'attend']),'attending-tickets'));
                event(new NewMessage(json_encode(['process' => 'attend']),'tickets-list'));
            }
        }
    }

    public function openFinishModal($id){
        $this->finish_reason_id = '';
        $this->ticket_id = $id;
    }

    public function clearFinish(){
        $this->ticket_id = '';
        $this->finish_reason_id = '';
    }

    public function finish($id)
    {
        $this->validate([
            'finish_reason_id' => ['required','numeric']
        ],
        [
            'finish_reason_id.required' => 'El motivo de finalización es requerido',
        ]);

        if($id){
            Tickets::where('id',$id)->update(['status' => 'c', 'finish_reason_id' => $this->finish_reason_id, 'finished' => Carbon::now()]);
            session()->flash('message', ['type' => 'success', 'title'=> 'Ticket atendido exitosamente']);
            event(new NewMessage(json_encode(['ticket' => $this]),'attending-tickets'));
            $this->emit('finishTicket');
            $this->emit('finishTicket');
            $this->clearFinish();
        }
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        $this->disattend($id);
    }

    
    public function render()
    {
        $search = $this->search;
        $people = People::where('status','1')->get();
        $peopleType = People::PEOPLE_TYPE;
        $offices = Office::where('status','1')->get();
        $finishReasons = FinishReason::where('status','1')->get();
        $tickets = Tickets::where( function($q1) use ($search){
                return $q1->where('office_id', auth()->guard()->user()->office->id)
                        ->whereHas('people', function($q2) use($search){
                            return $q2->where('name', 'like', '%'.$search.'%')
                                        ->orWhere('lastname', 'like', '%'.$search.'%')
                                        ->orWhere('id_card', 'like', '%'.$search.'%');
                        });
        })
        ->where('created_at','like', '%'. $search .'%')->orderBy('status', 'desc')->paginate();
        return view('livewire.tickets.attention',compact('tickets', 'people', 'offices', 'peopleType', 'finishReasons'));
    }
}
