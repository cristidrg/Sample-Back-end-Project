<?php

use Illuminate\Database\Seeder;
use App\Prop;
use Spatie\UptimeMonitor\Models\Monitor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monitors')->insert([
            'url' => 'www.northeastern.edu'
        ]);

        DB::table('props')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10).'@gmail.com',
            'url' => 'www.northeastern.edu',
        ]);

        $prop = Prop::find(1);
        $monitor = Monitor::find(1);
        $prop->monitor()->save($monitor);
    }
}
