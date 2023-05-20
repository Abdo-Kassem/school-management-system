<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_fee extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $table = 'student_fees';

    public $timestamps = false;

    public function student() 
    {
        return $this->belongsTo(Student::class,'studentID','id');
    }

    public function studyFees()
    {
        return $this->belongsTo(Study_Fee::class,'study_feesID','id');
    }

}
