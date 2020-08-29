<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i <= 26; $i++) {
            DB::table('users')->insert([
                'name' => 'user '.$i,
                'nid' => '20208493'.$i,
                'email' => '20208493'.$i.'@xmail.ac.test',
                'password' => Hash::make('sandi'.'20208493'.$i),
                'profile_url' => 'blank.png',
                'role' => 'user',
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            DB::table('users')->insert([
                'name' => 'admin '.$i,
                'nid' => '20208493'.$i,
                'email' => '20208493'.$i.'@xmail.ac.test',
                'password' => Hash::make('sandi'.'20208493'.$i),
                'profile_url' => 'blank.png',
                'role' => 'admin',
            ]);
        }

        DB::table('users')->insert([
            'name' => 'super admin',
            'nid' => '123456',
            'email' => '123456sa'.'@xmail.ac.test',
            'password' => Hash::make('sandi'.'123456'),
            'profile_url' => 'blank.png',
            'role' => 'admin',
        ]);

    }
}
