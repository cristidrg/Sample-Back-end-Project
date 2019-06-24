<?php

use Illuminate\Database\Seeder;

class PropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('props')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10).'@gmail.com',
            'url' => 'www.northeastern.edu',
        ]);
    }
}
