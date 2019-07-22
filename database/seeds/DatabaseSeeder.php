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
                                [
                                    'title' => 'Bouvé College of Health Sciences',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'College of Arts, Media and Design',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'College of Engineering',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'College of Social Sciences and Humanities',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'College of Professional Studies',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'College of Science',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'Bouvé College of Health Sciences',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'D’Amore-McKim School of Business',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'Khoury College of Computer Sciences',
                                    'description' => 'Lorem Ipsum',
                                ],
                                [
                                    'title' => 'School of Law',
                                    'description' => 'Lorem Ipsum',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Academic and Faculty Affairs',
                            'description' => 'Lorem Ipsum',
                            'children' => [
                                [
                                    'title' => 'ADVANCE Faculty Development',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'University Ombuds',
                                    'description' => 'lipsum',
                                ],
                            ]
                        ],
                        [
                            'title' => 'Budget, Planning, and Administration',
                            'description' => 'Lorem Ipsum',
                            'children' => [
                                [
                                    'title' => 'Academic Fiscal Affairs',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Academic Space',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'University Decision Support',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'University Registrar',
                                    'description' => 'lipsum',
                                ],
                            ]
                        ],
                        [
                            'title' => 'Curriculum and Programs',
                            'description' => 'Lorem Ipsum',
                            'children' => [
                                [
                                    'title' => 'Explore Program',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'ROTC',
                                    'description' => 'lipsum',
                                ]
                            ]
                        ],
                        [
                            'title' => 'Institutional Diversity and Inclusion',
                            'description' => 'Lorem Ipsum'
                        ],
                        [
                            'title' => 'Information Technology',
                            'description' => 'Lorem Ipsum',
                            'children' => [
                                [
                                    'title' => 'IT Operations',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Information Security',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Research Computing',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Engagement and Experience',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Academic Technologies',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Enterprise Platforms',
                                    'description' => 'lipsum',
                                ]
                            ]
                        ],
                        [
                            'title' => 'Library',
                            'description' => 'Lorem Ipsum'
                        ],
                        [
                            'title' => 'Research and Institutes',
                            'description' => 'Lorem Ipsum',
                            'children' => [
                                [
                                    'title' => 'Office of Research Development',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Research Enterprise Services',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Research Compliance',
                                    'description' => 'lipsum',
                                ],
                                [
                                    'title' => 'Center for Research Innovation',
                                    'description' => 'lipsum',
                                ]
                            ]
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
