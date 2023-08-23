<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\Attributes\Ticket;

class FinishReason extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'name', 'description', 'status'];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
