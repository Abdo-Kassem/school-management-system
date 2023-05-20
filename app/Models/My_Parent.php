<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
class My_Parent extends Authenticatable
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['fatherName','fatherJob','motherName','motherJob'];
    
    protected $guarded = [];

    protected $table = 'my_parents';

    public $timestamps = false;

    public function attachments() 
    {
        return $this->hasMany(ParentAttachement::class,'parentID','id');
    }

}
