<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasTranslations;

    protected $translatable = ['title'];

    protected $guarded = [];

    public $timestamps = false;


    public function grade()
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function class()
    {
        return $this->belongsTo(Classe::class,'classID','id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacherID','id');
    }


}
