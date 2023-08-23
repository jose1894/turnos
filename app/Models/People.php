<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use HasFactory, SoftDeletes;

    const PEOPLE_TYPE = [
        'V' => 'Venezolano',
        'E' => 'Extranjero',
        'P' => 'Pasaporte'
    ];

    protected $fillable = [
        'name',
        'lastname',
        'gender',
        'people_type',
        'id_card',
        'address',
        'status'
    ];
}
