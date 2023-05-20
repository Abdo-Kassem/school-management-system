<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestampes = false;

    protected $table = 'student_answers';

    public function student()
    {
        return $this->belongsTo(Student::class,'studentID','id');
    }
}
