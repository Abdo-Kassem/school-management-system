<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
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
