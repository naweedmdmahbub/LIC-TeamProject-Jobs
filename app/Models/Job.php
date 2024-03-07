<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'post',
        'description',
        'ends_at',
        'website',
        'status',
        'salary_min',
        'salary_max',
        'link',
        'vacancy',
        'attempts',
        'experience',
    ];
    public function company(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function candidates(){
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
