<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tickets;

class TicketsList extends Component
{
    protected $listeners = ['refreshTicketsListComponent' => '$refresh',];
    public function render()
    {
        $tickets = Tickets::whereHas('people')
        ->where('status', '=', 'a')
        ->where('created_at','like', '%'. date('y-m-d') .'%')->get();
        return view('livewire.tickets-list', compact('tickets'));
    }
}
