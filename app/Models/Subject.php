<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'subjects';

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
