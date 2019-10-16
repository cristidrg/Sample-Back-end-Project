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
                                    'title' => 'Bouvé',
                                ],
                                [
                                    'title' => 'CAMD',
                                ],
                                [
                                    'title' => 'Khoury',
                                ],
                                [
                                    'title' => 'COE',
                                ],
                                [
                                    'title' => 'CPS',
                                ],
                                [
                                    'title' => 'COS',
                                ],
                                [
                                    'title' => 'CSSH',
                                ],
                                [
                                    'title' => 'DMSB',
                                ],
                                [
                                    'title' => 'Law',
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
                                    'title' => 'UDS',
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
                'org' => 'Academic Affairs',
                'title' => 'ADVANCE: Office of Faculty Development',
                'url' => 'https://faculty.northeastern.edu/advance',
            ],
            [
                'org' => 'Academic Affairs',
                'title' => 'University Ombuds',
                'url' => 'https://provost.northeastern.edu/ombuds',
            ],
            [
                'org' => 'Academic Affairs',
                'title' => 'New Faculty Orientation',
                'url' => 'https://faculty.northeastern.edu/orientation',
            ],
            [
                'org' => 'Academic Affairs',
                'title' => 'Faculty Senate',
                'url' => 'https://faculty.northeastern.edu/senate/',
            ],
            [
                'org' => 'Academic Affairs',
                'title' => 'Faculty Handbook',
                'url' => 'https://faculty.northeastern.edu/handbook/',
            ],
            [
                'org' => 'Academic Affairs',
                'title' => 'Northeast Faculty Leadership Program',
                'url' => 'https://web.northeastern.edu/nflp/',
            ],
            [
                'org' => 'Budget, Planning, and Administration',
                'title' => 'Academic Fiscal Affairs',
                'url' => 'https://provost.northeastern.edu/budget',
            ],
            [
                'org' => 'Budget, Planning, and Administration',
                'title' => 'University Registrar',
                'url' => 'https://registrar.northeastern.edu/',
            ],
            [
                'org' => 'UDS',
                'title' => 'University Decision Support',
                'url' => 'https://provost.northeastern.edu/uds',
            ],
            [
                'org' => 'UDS',
                'title' => 'Career Outcomes',
                'url' => 'https://dev-graduateoutcomes.northeastern.edu/',
            ],
            [
                'org' => 'UDS',
                'title' => 'Facts and Figures',
                'url' => 'https://facts.northeastern.edu/',
            ],
            [
                'org' => 'Curriculum and Programs',
                'title' => 'Undergraduate Education',
                'url' => 'https://undergraduate.northeastern.edu/',
            ],
            [
                'org' => 'Curriculum and Programs',
                'title' => 'Explore Program',
                'url' => 'http://undergraduate.northeastern.edu/explore',
            ],
            [
                'org' => 'Curriculum and Programs',
                'title' => 'NUpath',
                'url' => 'https://www.northeastern.edu/core',
            ],
            [
                'org' => 'Curriculum and Programs',
                'title' => 'ROTC',
                'url' => 'http://www.northeastern.edu/neurotc',
            ],
            [
                'org' => 'Institutional Diversity and Inclusion',
                'title' => 'Office of Institutional Diversity and Inclusion',
                'url' => 'https://provost.northeastern.edu/oidi',
            ],
            [
                'org' => 'Institutional Diversity and Inclusion',
                'title' => 'Diversity at  Northeastern',
                'url' => 'https://www.northeastern.edu/diversity',
            ],
            [
                'org' => 'Institutional Diversity and Inclusion',
                'title' => 'Women of Color in the Academy Conference',
                'url' => 'http://web.northeastern.edu/woc',
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
                'org' => 'Library',
                'title' => 'Northeastern University Library',
                'url' => 'https://library.northeastern.edu/',
            ],
            [
                'org' => 'Library',
                'title' => 'Scholar OneSearch',
                'url' => 'https://onesearch.library.northeastern.edu/',
            ],
            [
                'org' => 'Library',
                'title' => 'Digital Repository Service',
                'url' => 'https://repository.library.northeastern.edu/',
            ],
            [
                'org' => 'Library',
                'title' => 'Digital Publishing',
                'url' => 'https://digitalpublishing.library.northeastern.edu/',
            ],
            [
                'org' => 'Bouvé',
                'title' => 'Bouvé College of Health Sciences',
                'url' => 'https://bouve.northeastern.edu/',
            ],
            [
                'org' => 'CAMD',
                'title' => 'College of Arts, Media and Design',
                'url' => 'https://camd.northeastern.edu/',
            ],
            [
                'org' => 'Khoury',
                'title' => 'Khoury College of Computer Sciences',
                'url' => 'https://www.khoury.northeastern.edu/',
            ],
            [
                'org' => 'COE',
                'title' => 'College of Engineering',
                'url' => 'https://coe.northeastern.edu/',
            ],
            [
                'org' => 'COE',
                'title' => 'Bernard M. Gordon Center for Subsurface Sensing and Imaging Systems (Gordon-CenSSIS)',
                'url' => 'http://www.censsis.neu.edu/',
            ],
            [
                'org' => 'CPS',
                'title' => 'College of Professional Studies',
                'url' => 'https://cps.northeastern.edu/',
            ],
            [
                'org' => 'COS',
                'title' => 'College of Science',
                'url' => 'https://cos.northeastern.edu/',
            ],
            [
                'org' => 'COS',
                'title' => 'Marine Science Center',
                'url' => 'https://cos.northeastern.edu/marinescience',
            ],
            [
                'org' => 'CSSH',
                'title' => 'College of Social Sciences and Humanities',
                'url' => 'https://cssh.northeastern.edu/',
            ],
            [
                'org' => 'CSSH',
                'title' => 'Center for International Affairs and World Cultures',
                'url' => 'https://cssh.northeastern.edu/internationalcenter',
            ],
            [
                'org' => 'DMSB',
                'title' => 'D’Amore-McKim School of Business',
                'url' => 'https://damore-mckim.northeastern.edu/',
            ],
            [
                'org' => 'Law',
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
