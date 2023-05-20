<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizze extends Model
{
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'quizzes';

    public function grade()
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function class()
    {
        return $this->belongsTo(Classe::class,'classID','id');
    }

    public function classroom()
    {
        return $this->belongsTo(ClasseRoom::class,'classroomID','id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacherID','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subjectID','id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'quizzID','id');
    }

}
