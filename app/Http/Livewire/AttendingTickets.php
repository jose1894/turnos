<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tickets;

class AttendingTickets extends Component
{
    protected $listeners = ['refreshAttendingTicketsComponent' => '$refresh',];
    public function render()
    {
        $tickets = Tickets::whereHas('people')
        ->where('status', '=', 'b')
        // ->where('created_at','like', '%'. date('y-m-d') .'%')->get();
        ->get();
        return view('livewire.attending-tickets', compact('tickets'));
    }
}
