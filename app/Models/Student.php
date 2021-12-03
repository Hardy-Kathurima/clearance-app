<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'user_id',
        'reg_no',
        'course',
        'year_study',
        'department'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function station()
    {
        return $this->hasOne(Station::class);
    }
}
