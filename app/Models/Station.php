<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected  $casts = [
        'sections' => 'array'
    ];
    protected $fillable = [
        'student_id',
        'academic',
        'finance',
        'library',
        'hostel',
        'sections'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
