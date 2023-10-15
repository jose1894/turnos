<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tickets;

class ProsecutorAttendingTickets extends Component
{
    protected $listeners = ['refreshProsecutorAttendingTicketsComponent' => '$refresh',];
    public function render()
    {
        $tickets = Tickets ::whereHas('prosecutor')
        ->where('status', '=', 'b')
        // ->where('created_at','like', '%'. date('y-m-d') .'%')->get();
        ->get();

        return view('livewire.prosecutor-attending-tickets', compact('tickets'));
    }
}
