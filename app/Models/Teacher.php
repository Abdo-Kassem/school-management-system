<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'teachers';

    public $timestamps = false;


    public function grade() 
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class,'specializationID','id');
    }

    public function classrooms() 
    {
        return $this->belongsToMany(ClasseRoom::class,Teacher_Classroom::class,'teacherID','classroomID','id','id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class,'teacherID','id');
    }

    public function quizz()
    {
        return $this->hasMany(Quizze::class,'teacherID','id');
    }

}
