<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classe extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['id','name','gradeID'];

    protected $table = 'classes';

    public function grade()
    {
        return $this->belongsTo(Grade::class,'gradeID','id');
    }

    public function classeRooms()
    {
        return $this->hasMany(ClasseRoom::class,'classesID','id');
    }
    
}
