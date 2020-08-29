<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i <= 26; $i++) {
            DB::table('q_r_dosens')->insert([
                'nid' => '20208493'.$i,
                'qr' => '000'
            ]);
        }
    }
}
