<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accused extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'ticket_id'
    ];

    protected $table = "accused";

    public function ticket(){
        return $this->belongsTo(Tickets::class);
    }

    public function people(){
        return $this->belongsTo(People::class);
    }
}
