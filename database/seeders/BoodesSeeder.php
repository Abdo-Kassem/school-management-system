<?php

namespace Database\Seeders;

use App\Models\Bloode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('bloodes')->delete();

        Bloode::whereNotNull('id')->delete();

        $bloodes = ['-O','+O','-B','+B','-A','+A','-AB','+AB'];

        foreach($bloodes as $bloode) {
            Bloode::create(['name'=>$bloode]);
        }
    
    }
}
