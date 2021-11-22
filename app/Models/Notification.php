<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'type',
        'notifiable',
        'data', // json
        'read_at',
    ];

    public $casts = [
        'data' => 'array',
    ];
}
