<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use HasFactory, SoftDeletes;
    const STATUSES = [
        'a' => 'SIN ATENDER',
        'b' => 'ATENDIENDO', 
        'c' => 'ATENDIDO',
        'i' => 'ANULADO',
    ];

    protected $fillable = [
        'ticket',
        'people_id',
        'office_id',
        'reason_id',
        'record',
        'comments',
        'status',
        'user_id'
    ];

    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function people(){
        return $this->belongsTo(People::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
