<?php

use Illuminate\Database\Seeder;
use App\Prop;
use App\Org;

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
        Org::create([
            'title' => 'President\'s office',
            'description' => 'root',
            'children' => [
                [
                    'title' => 'Provost\'s office',
                    'description' => 'The place to be',
                    'children' => [
                        [
                            'title' => 'Colleges and schools',
                            'description' => 'What else would our university be without them?',
                            'children' => [
                                [
                                    'title' => 'Khoury College of Computer Sciences',
                                    'description' => 'An instant return on investment. Apply now!',
                                ],
                            ],
                        ],
                    ]
                ]
            ]
        ]);

        DB::table('props')->insert([
            [
                'title' => 'Provost PROP',
                'description' => 'An amazing prop',
                'url' => 'https://provost.northeastern.edu/'
            ],
            [
                'title' => 'Budget & Planning PROP',
                'description' => 'A prosperous prop',
                'url' => 'https://finance.northeastern.edu/departments/office-of-financial-planning-strategy-and-analytics/'
            ],
            [
                'title' => 'Colleges PROP',
                'description' => 'A collegiate prop',
                'url' => 'https://provost.northeastern.edu/academics/colleges-schools/'
            ],
            [
                'title' => 'CCIS PROP',
                'description' => 'A programmy prop',
                'url' => 'https://www.khoury.northeastern.edu/'
            ],
        ]);

        DB::table('monitors')->insert([
            ['url' => 'https://provost.northeastern.edu/'],
            ['url' => 'https://finance.northeastern.edu/departments/office-of-financial-planning-strategy-and-analytics/'],
            ['url' => 'https://provost.northeastern.edu/academics/colleges-schools/'],
            ['url' => 'https://www.khoury.northeastern.edu/'],
        ]);

        $this->createOrgPropMonitorRelationship('Provost\'s office', 'https://provost.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Provost\'s office', 'https://finance.northeastern.edu/departments/office-of-financial-planning-strategy-and-analytics/');
        $this->createOrgPropMonitorRelationship('Colleges and schools', 'https://provost.northeastern.edu/academics/colleges-schools/');
        $this->createOrgPropMonitorRelationship('Khoury College of Computer Sciences', 'https://www.khoury.northeastern.edu/');
    }

    private function createOrgPropMonitorRelationship($orgTitle, $propUrl) {
        $prop = Prop::where('url', $propUrl)->first();
        $org = Org::where('title', $orgTitle)->first();
        $monitor = Monitor::where('url', $propUrl)->first();
        $prop->monitor()->save($monitor);
        $org->props()->save($prop);
    }
}
