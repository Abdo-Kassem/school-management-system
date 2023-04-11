<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
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

}
