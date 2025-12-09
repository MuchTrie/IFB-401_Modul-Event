<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // nama tabel
    protected $fillable = [
        'title', 'description', 'date', 'attendees', 'poster'
    ];

    protected $dates = ['date'];
    protected $primaryKey = 'event_id';  // 👈 WAJIB

    public $incrementing = true;
    protected $keyType = 'int';
}
