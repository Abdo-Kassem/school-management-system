<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();

        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
            ['en'=> 'Social Studies', 'ar'=> 'دراسات اجتماعيه'],
            ['en'=> 'religion', 'ar'=> 'دين'],
            ['en'=> 'Biology', 'ar'=> 'احياء'],
            ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
            ['en'=> 'french', 'ar'=> 'فرنساوي'],
        ];

        foreach($specializations as $sp) {
            Specialization::create(['name'=>$sp]);
        }
        
    }
}
