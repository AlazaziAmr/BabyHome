<?php

namespace Database\Seeders;


use App\Models\Api\Generals\Nationality;
use App\Models\Api\Generals\NurseryServiceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $qualifications = [
            [
                "name" => json_encode([
                    'ar' => 'بكالوريوس',
                    'en' => 'Bachelor',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'ماجستير',
                    'en' => 'Master',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'دكتوراه',
                    'en' => 'PhD',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('qualifications')->insert($qualifications);


        $languages = [
            [
                "name" => json_encode([
                    'ar' => 'العربية',
                    'en' => 'Arabic',
                ]),
                'logo' => 'logo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الإنجليزيه',
                    'en' => 'Engilish',
                ]),
                'logo' => 'logo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('languages')->insert($languages);



        $nursery_service_types = [
            [
                "name" => json_encode([
                    'ar' => 'الأنشطة',
                    'en' => 'activities',
                ]),
                'description' => 'test description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'المأكولات',
                    'en' => 'foods',
                ]),
                'description' => 'test description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('nursery_service_types')->insert($nursery_service_types);

        $services = [
            [
                "name" => json_encode([
                    'ar' => 'اختبار',
                    'en' => 'test',
                ]),
                'description' => 'test description',
                'type_id' => 1,
                'price' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'اختبار',
                    'en' => 'test',
                ]),
                'description' => 'test description',
                'type_id' => 2,
                'price' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('services')->insert($services);


        $genders = [
            [
                "name" => json_encode([
                    'ar' => 'ذكر',
                    'en' => 'male',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'أنثى',
                    'en' => 'female',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('genders')->insert($genders);

        $relations = [
            [
                "name" => json_encode([
                    'ar' => 'أب',
                    'en' => 'father',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'أم',
                    'en' => 'mother',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('relations')->insert($relations);

        $utilities = [
            [
                "name" => json_encode([
                    'ar' => 'توجد كاميرات مراقبة',
                    'en' => 'Site Cameras',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'استقبال مرافق',
                    'en' => 'Amenities',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'أنشطة تعليمية',
                    'en' => 'learning activities',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'تستقبل خادمه مع الطفل',
                    'en' => 'maid with baby',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'وجبات للطفل',
                    'en' => 'Meals',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'غرفة نوم مستقلة',
                    'en' => 'Saperate bed rooms',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'ساحة مفتوحة',
                    'en' => 'open space',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'تستقبل أصحاب القدرات الخاصة',
                    'en' => 'Dissbilities Acceptance',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('utilities')->insert($utilities);



        $amenities = [
            [
                "name" => json_encode([
                    'ar' => 'غرفة إستقبال',
                    'en' => 'Reception Room',
                ]),
                'is_required' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'غرفة ألعاب',
                    'en' => 'Gaming Room',
                ]),
                'is_required' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'دورة مياة',
                    'en' => 'bathroom',
                ]),
                'is_required' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الحاضنة من الخارج',
                    'en' => 'Babysitter from the outside',
                ]),
                'is_required' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'إسعافات أولية',
                    'en' => 'Band Aid',
                ]),
                'is_required' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'حديقة خارجية',
                    'en' => 'outdoor garden',
                ]),
                'is_required' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'مسبح',
                    'en' => 'swimming pool',
                ]),
                'is_required' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ];

        DB::table('amenities')->insert($amenities);


        Nationality::create([
            "name" => [
                'ar' => 'سعودي',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'يمني',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'مصري',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'سوري',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'كويتي',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'قطري',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'بحريني',
                'en' => '',
            ],
        ]);

        Nationality::create([
            "name" => [
                'ar' => 'امراتي',
                'en' => '',
            ],
        ]);

        $s1 = NurseryServiceType::find(1);
        $s2 = NurseryServiceType::find(2);

        NurseryServiceType::create([
            'name' => [
                'en' => 'sport',
                'ar' => 'نشاط بدني',
            ],
            'description' => '',
            'parent_id' => $s1->id,
        ]);

        NurseryServiceType::create([
            'name' => [
                'en' => 'any activity',
                'ar' => 'نشاط اخر',
            ],
            'description' => '',
            'parent_id' => $s1->id,
        ]);

        NurseryServiceType::create([
            'name' => [
                'en' => 'breakfast',
                'ar' => 'فطور',
            ],
            'description' => '',
            'parent_id' => $s2->id,
        ]);

        NurseryServiceType::create([
            'name' => [
                'en' => 'dinner',
                'ar' => 'غداء',
            ],
            'description' => '',
            'parent_id' => $s2->id,
        ]);

        NurseryServiceType::create([
            'name' => [
                'en' => 'launch',
                'ar' => 'عشاء',
            ],
            'description' => '',
            'parent_id' => $s2->id,
        ]);
    }
}
