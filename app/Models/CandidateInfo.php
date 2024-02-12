<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'experience',
        'address',
        'skill',
        'avatar',
        'user_id'
    ];
}
