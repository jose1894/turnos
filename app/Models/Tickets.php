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
        'user_id',
        'finish_comment',
        'prosecutor_id'
    ];

    public function office(){
        return $this->belongsTo(Office::class);
    }

    public function people(){
        return $this->belongsTo(People::class);
    }

    public function reason(){
        return $this->belongsTo(Reason::class);
    }

    public function finishReason(){
        return $this->belongsTo(FinishReason::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function accused(){
        return $this->hasMany(Accused::class, 'ticket_id', 'id');
    }

    public function prosecutor(){
        return $this->belongsTo(People::class, 'prosecutor_id', 'id');
    }
}
