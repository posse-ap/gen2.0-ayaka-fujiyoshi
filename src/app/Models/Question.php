<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // use HasFactory;

    protected $fillable = [
        'image',
        'big_question_id'
    ];

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function bigQuestion()
    {
        return $this->belongsTo(BigQuestion::class);
    }
}
