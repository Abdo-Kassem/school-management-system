<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'students';

    public $timestamps = false;

    public function religion()
    {
        return $this->belongsTo(Religion::class,'religionID','id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationalitie_ID','id');
    }

    public function blood()
    {
        return $this->belongsTo(Bloode::class,'bloodID','id');
    }

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

    public function parent()
    {
        return $this->belongsTo(My_Parent::class,'parentID','id');
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imagable');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class,'studentID','id');
    }
}
