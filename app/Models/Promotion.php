<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'promotions';

    public function gradeFrom()
    {
        return $this->belongsTo(Grade::class,'gradeID_from','id');
    }

    public function gradeTo()
    {
        return $this->belongsTo(Grade::class,'gradeID_to','id');
    }

    public function classFrom()
    {
        return $this->belongsTo(Classe::class,'classID_from','id');
    }

    public function classTo()
    {
        return $this->belongsTo(Classe::class,'classID_to','id');
    }

}
