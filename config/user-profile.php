<?php

use Carbon\Carbon;

return [
    'ages' => [
        'en' => [
            '0' => 'All',
            '1' => 'From 18 to 19 years',
            '2' => 'From 20 to 24 years',
            '3' => 'From 25 to 29 years',
            '4' => 'From 30 to 34 years',
            '5' => 'From 35 to 39 years',
            '6' => 'From 40 years',
        ],
        'jp' => [
            '0' => 'すべて',
            '1' => '18～19歳',
            '2' => '20～24歳',
            '3' => '25～29歳',
            '4' => '30～34歳',
            '5' => '35～39歳',
            '6' => '40歳以上',
        ]
    ],

    'male_ages' => [
        'en' => [
            '0' => 'Private',
            '1' => 'Under 30 years',
            '2' => 'From 30 to 35 years and under',
            '3' => 'From 35 to 40 years and under',
            '4' => 'From 40 to 45 years and under',
            '5' => 'From 45 to 50 years and under',
            '6' => 'From 50 to 55 years and under',
            '7' => 'From 55 to 60 years and under',
            '8' => 'From 60 to 65 years and under',
            '9' => 'From 65 to 70 years and under',
            '10' => '70 years or older',
        ],
        'jp' => [
            '0' => '非公開',
            '1' => '30歳未満',
            '2' => '30歳～35歳未満',
            '3' => '35歳～40歳未満',
            '4' => '40歳～45歳未満',
            '5' => '45歳～50歳未満',
            '6' => '50歳～55歳未満',
            '7' => '55歳～60歳未満',
            '8' => '60歳～65歳未満',
            '9' => '65歳～70歳未満',
            '10' => '70歳以上',
        ]
    ],

    'underwear_types' => [
        'en' => [
            'B' => 'Bcup',
            'C' => 'Ccup',
            'D' => 'Dcup',
            'E' => 'Ecup',
            'F' => 'Fcup',
            'G' => 'Gcup',
        ],
        'jp' => [
            'B' => 'Bカップ',
            'C' => 'Cカップ',
            'D' => 'Dカップ',
            'E' => 'Eカップ',
            'F' => 'Fカップ',
            'G' => 'Gカップ',
        ]
    ],

    'rating_stars' => ['1', '2', '3', '4', '5'],

    'dating_types' => [
        'en' => [
            'A' => 'Dinner Date Only',
            'B' => 'After 2 or 3 dates',
            'C' => 'Depends on chemistry',
            'D' => 'Highly Motivated',
            'E' => 'No Transportation Fee'
        ],
        'jp' => [
            'A' => 'お食事デート',
            'B' => '2回目以降',
            'C' => 'フィーリング次第',
            'D' => '積極的',
            'E' => '交通費不要'
        ]
    ],

    'blood_types' => [
        'en' => [
            '0' => 'Private',
            '1' => 'O',
            '2' => 'A',
            '3' => 'B',
            '4' => 'AB'
        ],
        'jp' => [
            '0' => '非公開',
            '1' => 'O',
            '2' => 'A',
            '3' => 'B',
            '4' => 'AB'
        ]
    ],

    'ranks' => [
        [
            'name' => 'standard',
            'description' => 'standard',
            'amount' => 2000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'gold',
            'description' => 'gold',
            'amount' => 3000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'platinum',
            'description' => 'platinum',
            'amount' => 10000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'black',
            'description' => 'black',
            'amount' => 20000,
            'created_at' => Carbon::now(),
        ],
    ],

    'areas' => [
        [
            'name' => '北海道・東北地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => '関東地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => '中部地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => '近畿地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => '中国・四国地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => '九州・沖縄地方',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
    ],

    'new_rank_seeder' => [
        [
            'name' => 'silver',
            'description' => 'silver',
            'amount' => 2000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'gold',
            'description' => 'gold',
            'amount' => 3000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'diamond',
            'description' => 'diamond',
            'amount' => 10000,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'premier',
            'description' => 'premier',
            'amount' => 20000,
            'created_at' => Carbon::now(),
        ]
    ],

    'heights' => [
        'en' => [
            '0' => 'All',
            '1' => '～150cm',
            '2' => '151～154cm',
            '3' => '155～160cm',
            '4' => '161～164cm',
            '5' => '165～169cm',
            '6' => '170cm～'
        ],
        'jp' => [
            '0' => 'すべて',
            '1' => '～150cm',
            '2' => '151～154cm',
            '3' => '155～160cm',
            '4' => '161～164cm',
            '5' => '165～169cm',
            '6' => '170cm～'
        ],
    ],

    'favorite_dating_type' => [
        'en' => [
            '0' => 'Private',
            '1' => 'Platonic relationship',
            '2' => 'Meal date first',
            '3' => 'Depending on the chemistry',
            '4' => 'Want to be in relationship knowing that it`s a dating club',
            '5' => 'Short-term financial support',
            '6' => 'Long-term financial support'
        ],
        'jp' => [
            '0' => '非公開',
            '1' => 'プラトニックな関係',
            '2' => 'まずはお食事デート',
            '3' => '会ってからのお互いフィーリング次第',
            '4' => '交際クラブと踏まえた上で恋愛がしたい',
            '5' => '短期経済的支援',
            '6' => '長期経済的支援'
        ]
    ],

    'male_smoking' => [
        'en' => [
            '0' => 'Private',
            '1' => 'I don\'t smoke. (I prefer no smoking female)',
            '2' => 'I don\'t smoke. (I don\'t care that female smokes)',
            '3' => 'I smoke. (I prefer no smoking female)',
            '4' => 'I smoke. (I don\'t care that female smokes)',
        ],
        'jp' => [
            '0' => '非公開',
            '1' => '喫煙しません（女性もNo Smokingを希望します）',
            '2' => '喫煙しません（女性の喫煙は問いません）',
            '3' => '喫煙します（女性はNo Smokingを希望します）',
            '4' => '喫煙します（女性の喫煙は問いません）',
        ],
    ],

    'income' => [
        'en' => [
            '0' => 'Private',
            '1' => 'Under 6,000,000 yen',
            '2' => 'From 8,000,000 yen and above',
            '3' => 'From 10,000,000 yen and above',
            '4' => 'From 20,000,000 yen and above',
            '5' => 'From 30,000,000 yen and above',
            '6' => 'From 40,000,000 yen and above',
            '7' => 'From 50,000,000 yen and above',
            '8' => 'From 60,000,000 yen and above',
            '9' => 'From 70,000,000 yen and above',
            '10' => 'From 80,000,000 yen and above',
            '11' => 'From 90,000,000 yen and above',
            '12' => '100,000,000 yen and above'
        ],
        'jp' => [
            '0' => '非公開',
            '1' => '600万円未満',
            '2' => '800万円～',
            '3' => '1000万円～',
            '4' => '2000万円～',
            '5' => '3000万円～',
            '6' => '4000万円～',
            '7' => '5000万円～',
            '8' => '6000万円～',
            '9' => '7000万円～',
            '10' => '8000万円～',
            '11' => '9000万円～',
            '12' => '1億円～'
        ]
    ],
    'dating_types_description' => [
        'en' => [
            'A' => 'Mostly looking to go on a meal date or for light drinks. Not looking for any intimacy.',
            'B' => 'From the 2nd date if the feelings are mutual it may turn into a intimate relationship.',
            'C' => 'From the 1st date if the feeling is mutual it may turn into 
                    a intimate relationship on the day of the date.',
            'D' => 'From the 1st date if you are a real gentleman(warm and nice) 
                    on the date it may turn into a intimate relationship.',
            'E' => 'I do not need any transportation fee since I want to concentrate
                    on the chance of meeting with nice gentleman.'
        ],
        'jp' => [
            'A' => '基本的にお茶やお食事のデートを希望します。肉体関係を含む交際は希望しません。',
            'B' => '2回目以降のデートでお互いのフィーリングが合えば、交際に発展する可能性があります。',
            'C' => '初日からお互いのフィーリングが合えば、交際に発展する可能性があります。',
            'D' => '初日からスマートにお誘い頂ければ、交際に発展する可能性があります。',
            'E' => '出会いのチャンスを優先したいので、お食事デートでの交通費はいただきません。'
        ]
    ],
];
