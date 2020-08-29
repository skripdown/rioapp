<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QrScanner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('q_r_scanners')->insert([
            'qr' => '000'
        ]);
    }
}
