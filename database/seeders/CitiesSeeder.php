<?php

namespace Database\Seeders;

use App\Models\Api\Generals\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            [
                "name" => json_encode([
                    'ar' => 'الرياض',
                    'en' => 'Riyadh',
                ]),
                "country_id" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('cities')->insert($data);

        $south = [" الشفاء","بدر"," المروة","الفواز"," الحزم","الغزيزية"," الدار البيضاء","المنصورة"," نمار","الدريهمة"," شبرا","اليمامة"," المصانع","بن تركي"," السويدي","الشميسي"," الحاير","الشعلان"];
        $middle = [" المربع","المرقب"," البطحاء","الديرة","الصالة"," الملز"," الملز"];
        $north = [" الملقا","الصحافة"," النخيل","و الياسمين","النفل"," الازدهار","قرناطة"," المغرزات","الواحة","المرسلات"," الورود","المروج"," الغدير","الربيع"," الرائد"," العقيق","النخيل الغربي"," النخيل الشرقي"];
        $east = [" القدس","الروضة","النسيم"," الفلاح","السلي"," النظيم"," الحمراء","النهضة"," غرناطة","المغرزات"," الخليج","الجزيرة"," الربوة","الرواد"," اليرموك","إشبيليا","قرطبة"," الشهداء"," الريان","الرمال","المونسية"," القادسية","السعادة"," السلام", "الأندلس"," الروابي" ];
        $west = [
            " العوالي","نمار"," طويق","ديراب"," ضاة نمار",
            "المؤتمرات"," النموذجية","الشميسي"," صياح","أم سليم"
            ," البديعة","الوشام"," الناصرية","عليشة"," الفيعة","المعذر"," الفاخرية","الجرادية"," الهدا","الشرفية",
            " الزهرة","السويدي","ظهرة البديعة"," سلطانة"," الدريهمي","العريجاء الأوسط"
            ," العريجاء"," السويدي الغربي","العريجاء الغربي"," شبرا",
            " لبن","الخزامي"," السفارات","وادي لبن",
            " المهدي","ظهرة لبن"
        ];

        foreach ($south as $s){
            $data = [
                [
                    "name" => json_encode([
                        'ar' => $s,
                        'en' => '',
                    ]),
                    "city_id" => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            DB::table('neighborhoods')->insert($data);
        }

        foreach ($north as $n){
            $data = [
                [
                    "name" => json_encode([
                        'ar' => $n,
                        'en' => '',
                    ]),
                    "city_id" => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            DB::table('neighborhoods')->insert($data);
        }

        foreach ($middle as $m){
            $data = [
                [
                    "name" => json_encode([
                        'ar' => $m,
                        'en' => '',
                    ]),
                    "city_id" => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            DB::table('neighborhoods')->insert($data);
        }

        foreach ($east as $e){
            $data = [
                [
                    "name" => json_encode([
                        'ar' => $e,
                        'en' => '',
                    ]),
                    "city_id" => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            DB::table('neighborhoods')->insert($data);
        }

        foreach ($west as $w){
            $data = [
                [
                    "name" => json_encode([
                        'ar' => $w,
                        'en' => '',
                    ]),
                    "city_id" => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            DB::table('neighborhoods')->insert($data);
        }


    }
}
