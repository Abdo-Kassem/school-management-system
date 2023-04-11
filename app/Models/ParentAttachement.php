<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentAttachement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'parent_attachements';

    public $timestamps = false;

    public function parent() 
    {
        return $this->belongsTo(My_Parent::class,'parentID','id');
    }
}
