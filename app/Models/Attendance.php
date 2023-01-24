<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'clockin',
        'clockout',
        'desc_clockin',
        'desc_clockout',
        'status_clockin',
        'status_clockout',
        'lateness_clockin',
        'lateness_clockout',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
