<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClasseRoom extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name','status','gradeID','classesID','teacherID'];

    protected $table = 'classe_rooms';

    public function grade()
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'classesID','id');
    }

    public function teachers() 
    {
        return $this->belongsToMany(Teacher::class,Teacher_Classroom::class,'classroomID','teacherID','id','id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'classroomID','id');
    }
}
