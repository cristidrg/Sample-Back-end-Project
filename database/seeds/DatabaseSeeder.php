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
        Prop::create([
            'title' => 'Provost\'s office',
            'description' => 'The place to be',
            'url' => 'https://provost.northeastern.edu/',
            'children' => [
                [
                    'title' => 'Colleges and schools',
                    'description' => 'What else would our university be without them?',
                    'url' => 'https://provost.northeastern.edu/academics/colleges-schools/',
                    'children' => [
                        [
                            'title' => 'Khoury College of Computer Sciences',
                            'description' => 'An instant return on investment. Apply now!',
                            'url' => 'https://www.khoury.northeastern.edu/',
                        ],
                    ],
                ],
            ],
        ]);


        DB::table('monitors')->insert([
            'url' => 'https://provost.northeastern.edu/'
        ]);

        DB::table('monitors')->insert([
            'url' => 'https://provost.northeastern.edu/academics/colleges-schools/'
        ]);

        DB::table('monitors')->insert([
            'url' => 'https://www.khoury.northeastern.edu/'
        ]);

        $prop1 = Prop::where('url', 'https://provost.northeastern.edu/')->first();
        $monitor1 = Monitor::where('url', 'https://provost.northeastern.edu/')->first();
        
        $prop2 = Prop::where('url', 'https://provost.northeastern.edu/academics/colleges-schools/')->first();
        $monitor2 = Monitor::where('url', 'https://provost.northeastern.edu/academics/colleges-schools/')->first();

        $prop3 = Prop::where('url', 'https://www.khoury.northeastern.edu/')->first();
        $monitor3 = Monitor::where('url', 'https://www.khoury.northeastern.edu/')->first();

        $prop1->monitor()->save($monitor1);
        $prop2->monitor()->save($monitor2);
        $prop3->monitor()->save($monitor3);
    }
}
