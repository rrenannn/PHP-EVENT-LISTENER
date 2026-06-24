<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * Tabela associada ao modelo
     *
     * @var string
     */
    protected $table = 'events';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'type',
        'location',
        'start_at',
        'end_at',
        'active',
        'user_id',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
        'active'   => 'boolean',
    ];
}
