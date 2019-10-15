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
            'title' => 'Northeastern',
            'description' => 'root',
            'children' => [
                [
                    'title' => 'Advancement',
                ],
                [
                    'title' => 'Chancellor',
                    'children' => [
                        [
                            'title' => 'Undergraduate Affairs',
                        ],
                        [
                            'title' => 'Student Affairs',
                            'children' => [
                                [
                                    'title' => 'Athletics',
                                ],
                            ]
                        ],
                        [
                            'title' => 'Digital and Mobile Learning',
                        ],
                        [
                            'title' => 'Enrollment Management',
                        ],
                    ]
                ],
                [
                    'title' => 'External Affairs',
                    'children' => [
                        [
                            'title' => 'Communications',
                        ],
                        [
                            'title' => 'Government Relations',
                        ],
                        [
                            'title' => 'Marketing',
                        ],
                    ],
                ],
                [
                    'title' => 'Finance',
                ],
                [
                    'title' => 'General Counsel',
                ],
                [
                    'title' => 'Provost',
                    'children' => [
                        [
                            'title' => 'Colleges and schools',
                            'children' => [
                                [
                                    'title' => 'Bouvé College of Health Sciences',
                                ],
                                [
                                    'title' => 'College of Arts, Media and Design',
                                ],
                                [
                                    'title' => 'Khoury College of Computer Sciences',
                                ],
                                [
                                    'title' => 'College of Engineering',
                                ],
                                [
                                    'title' => 'College of Professional Studies',
                                ],
                                [
                                    'title' => 'College of Science',
                                ],
                                [
                                    'title' => 'College of Social Sciences and Humanities',
                                ],
                                [
                                    'title' => 'D’Amore-McKim School of Business',
                                ],
                                [
                                    'title' => 'School of Law',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Academic Affairs',
                        ],
                        [
                            'title' => 'Budget, Planning, and Administration',
                            'children' => [
                                [
                                    'title' => 'University Decision Support',
                                ],
                                [
                                    'title' => 'University Registrar',
                                ],
                            ]
                        ],
                        [
                            'title' => 'Curriculum and Programs',
                        ],
                        [
                            'title' => 'Institutional Diversity and Inclusion',
                        ],
                        [
                            'title' => 'ITS',
                        ],
                        [
                            'title' => 'Library',
                        ],
                        [
                            'title' => 'Entreprenuership',
                        ],
                        [
                            'title' => 'Research',
                        ],
                        [
                            'title' => 'Institutes',
                        ],
                    ]
                ],
            ]
        ]);


        /*
            In order for the lighthouse script to work,
            root level domains need to end with '/'

            Correct:
                https://provost.northeastern.edu/
            Incorrect:
                https://provost.northeastern.edu
        */
        $props = [
            [
                'org' => 'Advancement',
                'title' => 'University Advancement',
                'url' => 'https://advancement.northeastern.edu/',
            ],
            [
                'org' => 'Advancement',
                'title' => 'Alumni Relations',
                'url' => 'https://alumni.northeastern.edu/',
            ],
            [
                'org' => 'Advancement',
                'title' => 'Northeastern Giving',
                'url' => 'https://giving.northeastern.edu/',
            ],
            [
                'org' => 'Provost',
                'title' => 'Office of the Provost',
                'url' => 'https://provost.northeastern.edu/',
            ],
            [
                'org' => 'Provost',
                'title' => 'Broken Property',
                'url' => 'https://broken.northeastern.edu/',
            ],
            [
                'org' => 'ITS',
                'title' => 'Information Technology Services',
                'url' => 'https://its.northeastern.edu/',
            ],
            [
                'org' => 'ITS',
                'title' => 'Chief Information Officer',
                'url' => 'https://cio.northeastern.edu/',
            ],
            [
                'org' => 'ITS',
                'title' => 'Academic Technology Services',
                'url' => 'https://www.northeastern.edu/ats',
            ],
            [
                'org' => 'ITS',
                'title' => 'Office of Information Security',
                'url' => 'https://www.northeastern.edu/securenu',
            ],
            [
                'org' => 'ITS',
                'title' => 'Digital Accessibility',
                'url' => 'https://digital-accessibility.northeastern.edu/',
            ],
            [
                'org' => 'ITS',
                'title' => 'Connect to Tech',
                'url' => 'https://connect-to-tech.northeastern.edu/',
            ],
            [
                'org' => 'Bouvé College of Health Sciences',
                'title' => 'Bouvé College of Health Sciences',
                'url' => 'https://bouve.northeastern.edu/',
            ],
            [
                'org' => 'College of Arts, Media and Design',
                'title' => 'College of Arts, Media and Design',
                'url' => 'https://camd.northeastern.edu/',
            ],
            [
                'org' => 'Khoury College of Computer Sciences',
                'title' => 'Khoury College of Computer Sciences',
                'url' => 'https://www.khoury.northeastern.edu/',
            ],
            [
                'org' => 'College of Engineering',
                'title' => 'College of Engineering',
                'url' => 'https://coe.northeastern.edu/',
            ],
            [
                'org' => 'College of Professional Studies',
                'title' => 'College of Professional Studies',
                'url' => 'https://cps.northeastern.edu/',
            ],
            [
                'org' => 'College of Science',
                'title' => 'College of Science',
                'url' => 'https://cos.northeastern.edu/',
            ],
            [
                'org' => 'College of Social Sciences and Humanities',
                'title' => 'College of Social Sciences and Humanities',
                'url' => 'https://cssh.northeastern.edu/',
            ],
            [
                'org' => 'D’Amore-McKim School of Business',
                'title' => 'D’Amore-McKim School of Business',
                'url' => 'https://damore-mckim.northeastern.edu/',
            ],
            [
                'org' => 'School of Law',
                'title' => 'School of Law',
                'url' => 'https://www.northeastern.edu/law',
            ],
            [
                'org' => 'Chancellor',
                'title' => 'Office of the Chancellor',
                'url' => 'https://chancellor.northeastern.edu/',
            ],
            [
                'org' => 'Undergraduate Affairs',
                'title' => 'Self-Authored Integrated Learning (SAIL)',
                'url' => 'https://sail.northeastern.edu/',
            ],
        ];

        foreach ($props as $prop) {
            DB::table('props')->insert([
                'title' => $prop['title'],
                'url' => $prop['url'],
            ]);

            DB::table('monitors')->insert([
                'url' => $prop['url'],
            ]);

            $this->createOrgPropMonitorRelationship($prop['org'], $prop['url']);
        }
    }

    /*
        This function maps a prop to its monitor and parent org.
        @orgTitle - The org->title value
        @propUrl - the url of the prop -- be sure that a monitor with this url is created
    */
    private function createOrgPropMonitorRelationship($orgTitle, $propUrl)
    {
        $prop = Prop::where('url', $propUrl)->first();
        $org = Org::where('title', $orgTitle)->first();
        $monitor = Monitor::where('url', $propUrl)->first();
        $prop->monitor()->save($monitor);
        $org->props()->save($prop);
    }
}
