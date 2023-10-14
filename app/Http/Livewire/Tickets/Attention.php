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
    public $ticket_id, $finish_reason_id, $confirming, $finish_comment;
    public $name, $lastname,$gender,$people_type,$id_card,$address, $status;
    public $updateMode = false;
    public $people, $peopleType, $offices, $finishReasons, $officeUser;
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
        $ticket = Tickets::where('id',$id)->with(['people', 'office', 'reason', 'accused.people'])->first();
        
        $people = $ticket->people_id;

        $otherOfficeTicket = Tickets::where('people_id', $people)->where('status', 'b');
        
        if ( $otherOfficeTicket->count() > 0){
            session()->flash('message', ['type' => 'info', 'title'=> 'La persona ya esta asignada a un ticket en la oficina: '. $otherOfficeTicket->first()->office->name]);
            $this->emit('refreshAttentionComponent');
        } else {
 
            $office = auth()->guard()->user()->office_id;
            $attendedTicket = Tickets::where('id',$id)->where('status', 'b')->where('office_id', $office)->get()->first();
            $attendedTickets = Tickets::where('status', 'b')->where('office_id', $office)->get();
            if($id){            
                if ( sizeof($attendedTickets) <= 0 || !is_null($attendedTicket) ){
                    $ticket->update(['status' => 'b', 'attended' => Carbon::now()]);
                    session()->flash('message', ['type' => 'success', 'title'=> 'Ticket llamado']);
                    event(new NewMessage(json_encode(['process' => 'attend']),'attending-tickets'));
                    event(new NewMessage(json_encode(['process' => 'attend']),'tickets-list'));
                    event(new NewMessage(json_encode(['ticket' => $ticket]),'tickets-number'));
                } 
            }
        }
    }

    public function recall($id){
        $ticket = Tickets::where('id',$id)->with(['people', 'office', 'reason', 'accused.people'])->first();
        session()->flash('message', ['type' => 'info', 'title'=> 'Llamado nuevamente']);
        event(new NewMessage(json_encode(['process' => 'attend']),'attending-tickets'));
        event(new NewMessage(json_encode(['ticket' => $ticket]),'tickets-number'));
        $this->emit('refreshAttentionComponent');
    }

    public function openFinishModal($id){
        $this->finish_reason_id = '';
        $this->ticket_id = $id;
    }

    public function clearFinish(){
        $this->ticket_id = '';
        $this->finish_comment = '';
        $this->finish_reason_id = '';
    }

    public function finish($id)
    {
        $this->validate([
            'finish_reason_id' => ['required','numeric'],
            'finish_comment' => ['required','sometimes']
        ],
        [
            'finish_reason_id.required' => 'El motivo de finalización es requerido',
            'finish_comment.required' => 'Los comentarios finales son requeridos',
        ]);

        if($id){
            Tickets::where('id',$id)->update(['status' => 'c', 'finish_reason_id' => $this->finish_reason_id, 'finish_comment' => $this->finish_comment, 'finished' => Carbon::now()]);
            session()->flash('message', ['type' => 'success', 'title'=> 'Ticket atendido exitosamente']);
            event(new NewMessage(json_encode(['ticket' => $this]),'attending-tickets'));
            event(new NewMessage(json_encode(['process' => 'attend']),'tickets-list'));
            event(new NewMessage(json_encode(['ticket' => true]),'tickets-number'));
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

    public function mount(){
        $this->people = People::where('status','1')->get();
        $this->peopleType = People::PEOPLE_TYPE;
        $this->offices = Office::where('status','1')->get();
        $this->finishReasons = FinishReason::where('status','1')->get();
        $this->officeUser = auth()->guard()->user()->office->id ?? null;
    }

    
    public function render()
    {
        $search = $this->search;
        $officeUser = $this->officeUser;
        $tickets = Tickets::orWhere( function($q1) use ($search, $officeUser){
                return $q1
                        ->when(!empty($officeUser),function($query) use ($officeUser) {
                            return $query->where('office_id', $officeUser);
                        })
                        ->with('people', function($q2) use($search){
                            return $q2->where('name', 'like', '%'.$search.'%')
                                        ->orWhere('lastname', 'like', '%'.$search.'%')
                                        ->orWhere('id_card', 'like', '%'.$search.'%');
                        })->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })
        ->orWhere(function($q) use ($officeUser){
            return $q->where('status', 'b')->when( $officeUser, function ($query){
                return $query->where('office_id', auth()->guard()->user()->office->id);
            });
        })
        ->orderBy('status', 'desc')->paginate();
        return view('livewire.tickets.attention',compact('tickets'));
    }
}
