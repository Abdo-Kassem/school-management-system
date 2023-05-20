<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Study_Fee extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'study_fees';

    public $timestamps = false;

    public function grade() 
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function class() 
    {
        return $this->belongsTo(Classe::class,'classID','id');
    }

}
