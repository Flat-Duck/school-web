<?php

use App\Grade;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Subject::class)->create([            
            'name' => 'رياضيات',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'تربية اسلاميه',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'اللغة العربية',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'اللغة انجليزية',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'حاسوب',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'تربية فنيه',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'تربيه بدنيه',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'تربية موسيقية',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'علوم',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'تربيه وطنيه',
        ]);
        factory(App\Subject::class)->create([            
            'name' => 'اجتماعيات',
        ]);
        $one = [1,2,3,4,5,6,7,8];
        $three = [1,2,3,4,5,6,7,8,9];
        $four = [1,2,3,4,5,6,7,8,9,10,11];
        foreach(Grade::all() as $k => $grade){
            if($grade->id == 1|| $grade->id == 2){
                $grade->subjects()->sync($one);
            }elseif($grade->id == 3){
                $grade->subjects()->sync($three);
            }elseif($grade->id > 3){
                $grade->subjects()->sync($four);
            }
        }   
    }
}
