<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{

    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name','notes'];
    
    protected $table = 'grades';

    public $timestamps = true;

    public function classes()
    {
        return $this->hasMany(Classe::class,'gradeID','id');
    }

    public function classeRooms()
    {
        return $this->hasMany(ClasseRoom::class,'gradeID','id');
    }

    public function teachers() 
    {
        return $this->hasMany(Teacher::class,'gradeID','id');
    }

}