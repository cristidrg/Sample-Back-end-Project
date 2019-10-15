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
                    'description' => '',
                    'children' => []
                ],
                [
                    'title' => 'Chancellor',
                    'description' => '',
                    'children' => [
                        [
                            'title' => 'Undergraduate Affairs',
                            'description' => '',
                            'children' => [],
                        ],
                        [
                            'title' => 'Student Affairs',
                            'description' => '',
                            'children' => [
                                [
                                    'title' => 'Athletics',
                                    'description' => ''
                                ],
                            ]
                        ],
                        [
                            'title' => 'Digital and Mobile Learning',
                            'description' => '',
                        ],
                        [
                            'title' => 'Enrollment Management',
                            'description' => '',
                        ],
                    ]
                ],
                [
                    'title' => 'External Affairs',
                    'description' => '',
                    'children' => [
                        [
                            'title' => 'Communications',
                            'description' => ''
                        ],
                        [
                            'title' => 'Government Relations',
                            'description' => ''
                        ],
                        [
                            'title' => 'Marketing',
                            'description' => ''
                        ],
                    ],
                ],
                [
                    'title' => 'Finance',
                    'description' => '',
                    'children' => []
                ],
                [
                    'title' => 'General Counsel',
                    'description' => '',
                    'children' => []
                ],
                [
                    'title' => 'Provost',
                    'description' => '',
                    'children' => [
                        [
                            'title' => 'Colleges and schools',
                            'description' => '',
                            'children' => [
                                [
                                    'title' => 'Bouvé College of Health Sciences',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'College of Arts, Media and Design',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'Khoury College of Computer Sciences',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'College of Engineering',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'College of Professional Studies',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'College of Science',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'College of Social Sciences and Humanities',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'D’Amore-McKim School of Business',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'School of Law',
                                    'description' => '',
                                ],
                            ],
                        ],
                        [
                            'title' => 'Academic Affairs',
                            'description' => '',
                            'children' => []
                        ],
                        [
                            'title' => 'Budget, Planning, and Administration',
                            'description' => '',
                            'children' => [
                                [
                                    'title' => 'University Decision Support',
                                    'description' => '',
                                ],
                                [
                                    'title' => 'University Registrar',
                                    'description' => '',
                                ],
                            ]
                        ],
                        [
                            'title' => 'Curriculum and Programs',
                            'description' => '',
                            'children' => []
                        ],
                        [
                            'title' => 'Institutional Diversity and Inclusion',
                            'description' => ''
                        ],
                        [
                            'title' => 'Information Technology Services',
                            'description' => '',
                            'children' => []
                        ],
                        [
                            'title' => 'Library',
                            'description' => ''
                        ],
                        [
                            'title' => 'Entreprenuership',
                            'description' => '',
                        ],
                        [
                            'title' => 'Research',
                            'description' => '',
                        ],
                        [
                            'title' => 'Institutes',
                            'description' => '',
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
        DB::table('props')->insert([
            [
                'title' => 'University Advancement',
                'url' => 'https://advancement.northeastern.edu/',
            ],
            [
                'title' => 'Alumni Relations',
                'url' => 'https://alumni.northeastern.edu/',
            ],
            [
                'title' => 'Northeastern Giving',
                'url' => 'https://giving.northeastern.edu/',
            ],
            [
                'title' => 'Office of the Provost',
                'url' => 'https://provost.northeastern.edu/',
            ],
            [
                'title' => 'Broken Property',
                'url' => 'https://broken.northeastern.edu/',
            ],
            [
                'title' => 'Information Technology Services',
                'url' => 'https://its.northeastern.edu/',
            ],
            [
                'title' => 'Chief Information Officer',
                'url' => 'https://cio.northeastern.edu/',
            ],
            [
                'title' => 'Academic Technology Services',
                'url' => 'https://www.northeastern.edu/ats',
            ],
            [
                'title' => 'Office of Information Security',
                'url' => 'https://www.northeastern.edu/securenu',
            ],
            [
                'title' => 'Digital Accessibility',
                'url' => 'https://digital-accessibility.northeastern.edu/',
            ],
            [
                'title' => 'Connect to Tech',
                'url' => 'https://connect-to-tech.northeastern.edu/',
            ],
            [
                'title' => 'Bouvé College of Health Sciences',
                'description' => '',
                'url' => 'https://bouve.northeastern.edu/',
            ],
            [
                'title' => 'College of Arts, Media and Design',
                'description' => '',
                'url' => 'https://camd.northeastern.edu/',
            ],
            [
                'title' => 'Khoury College of Computer Sciences',
                'description' => '',
                'url' => 'https://www.khoury.northeastern.edu/',
            ],
            [
                'title' => 'College of Engineering',
                'description' => '',
                'url' => 'https://coe.northeastern.edu/',
            ],
            [
                'title' => 'College of Professional Studies',
                'description' => '',
                'url' => 'https://cps.northeastern.edu/',
            ],
            [
                'title' => 'College of Science',
                'description' => '',
                'url' => 'https://cos.northeastern.edu/',
            ],
            [
                'title' => 'College of Social Sciences and Humanities',
                'description' => '',
                'url' => 'https://cssh.northeastern.edu/',
            ],
            [
                'title' => 'D\'Amore-McKim School of Business',
                'description' => '',
                'url' => 'https://damore-mckim.northeastern.edu/',
            ],
            [
                'title' => 'School of Law',
                'description' => '',
                'url' => 'https://www.northeastern.edu/law',
            ],
            [
                'title' => 'Office of the Chancellor',
                'description' => '',
                'url' => 'https://chancellor.northeastern.edu/',
            ],
            [
                'title' => 'Self-Authored Integrated Learning (SAIL)',
                'description' => 'SAIL is a digital platform that helps students capture, reflect on, and express their unique learning experiences.',
                'url' => 'https://sail.northeastern.edu/',
            ],
        ]);

        DB::table('monitors')->insert([
            ['url' => 'https://advancement.northeastern.edu/'],
            ['url' => 'https://alumni.northeastern.edu/'],
            ['url' => 'https://giving.northeastern.edu/'],
            ['url' => 'https://provost.northeastern.edu/'],
            ['url' => 'https://broken.northeastern.edu/'],
            ['url' => 'https://its.northeastern.edu/'],
            ['url' => 'https://cio.northeastern.edu/'],
            ['url' => 'https://www.northeastern.edu/ats'],
            ['url' => 'https://www.northeastern.edu/securenu'],
            ['url' => 'https://digital-accessibility.northeastern.edu/'],
            ['url' => 'https://connect-to-tech.northeastern.edu/'],
            ['url' => 'https://bouve.northeastern.edu/'],
            ['url' => 'https://camd.northeastern.edu/'],
            ['url' => 'https://www.khoury.northeastern.edu/'],
            ['url' => 'https://coe.northeastern.edu/'],
            ['url' => 'https://cps.northeastern.edu/'],
            ['url' => 'https://cos.northeastern.edu/'],
            ['url' => 'https://cssh.northeastern.edu/'],
            ['url' => 'https://damore-mckim.northeastern.edu/'],
            ['url' => 'https://chancellor.northeastern.edu/'],
            ['url' => 'https://www.northeastern.edu/law'],
            ['url' => 'https://sail.northeastern.edu/'],
        ]);

        //Advancement
        $this->createOrgPropMonitorRelationship('Advancement', 'https://advancement.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Advancement', 'https://alumni.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Advancement', 'https://giving.northeastern.edu/');

        // Provost
        $this->createOrgPropMonitorRelationship('Provost', 'https://provost.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Provost', 'https://broken.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://its.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://cio.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://www.northeastern.edu/ats');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://www.northeastern.edu/securenu');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://digital-accessibility.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Information Technology Services', 'https://connect-to-tech.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Bouvé College of Health Sciences', 'https://bouve.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('College of Arts, Media and Design', 'https://camd.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Khoury College of Computer Sciences', 'https://www.khoury.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('College of Engineering', 'https://coe.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('College of Professional Studies', 'https://cps.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('College of Science', 'https://cos.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('College of Social Sciences and Humanities', 'https://cssh.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('D’Amore-McKim School of Business', 'https://damore-mckim.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('School of Law', 'https://www.northeastern.edu/law');

        //Chancellor
        $this->createOrgPropMonitorRelationship('Chancellor', 'https://chancellor.northeastern.edu/');
        $this->createOrgPropMonitorRelationship('Undergraduate Affairs', 'https://sail.northeastern.edu/');
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
