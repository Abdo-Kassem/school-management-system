<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name'];
    
    protected $guarded = [];

    protected $table = 'specializations';

    public $timestamps = false;

    public function teachers() 
    {
        return $this->hasMany(Teacher::class,'specializationID','id');
    }
}
