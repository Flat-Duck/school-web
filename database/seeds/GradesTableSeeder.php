<?php

use Illuminate\Database\Seeder;
use App\Grade;
class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Grade::class)->create([
            'id' => '1',
            'name' => 'أول',
        ]);
        factory(App\Grade::class)->create([
            'id' => '2',
            'name' => 'ثاني',
        ]);
        factory(App\Grade::class)->create([
            'id' => '3',
            'name' => 'ثالث',
        ]);
        factory(App\Grade::class)->create([
            'id' => '4',
            'name' => 'رابع',
        ]);
        factory(App\Grade::class)->create([
            'id' => '5',
            'name' => 'خامس',
        ]);
        factory(App\Grade::class)->create([
            'id' => '6',
            'name' => 'سادس',
        ]);
//=========Grade-1=====/
        factory(App\Room::class)->create([
            'id' => '1',
            'name' => 'أ',
            'grade_id' => '1',
        ]);
        factory(App\Room::class)->create([
            'id' => '2',
            'name' => 'ب',
            'grade_id' => '1',
        ]);factory(App\Room::class)->create([
            'id' => '3',
            'name' => 'ج',
            'grade_id' => '1',
        ]);
        //=========Grade-2=====/
        factory(App\Room::class)->create([
            'id' => '11',
            'name' => 'أ',
            'grade_id' => '2',
        ]);
        factory(App\Room::class)->create([
            'id' => '12',
            'name' => 'ب',
            'grade_id' => '2',
        ]);factory(App\Room::class)->create([
            'id' => '13',
            'name' => 'ج',
            'grade_id' => '2',
        ]);
        //=========Grade-3=====/
        factory(App\Room::class)->create([
            'id' => '21',
            'name' => 'أ',
            'grade_id' => '3',
        ]);
        factory(App\Room::class)->create([
            'id' => '22',
            'name' => 'ب',
            'grade_id' => '3',
        ]);factory(App\Room::class)->create([
            'id' => '23',
            'name' => 'ج',
            'grade_id' => '3',
        ]);
        //=========Grade-4=====/
        factory(App\Room::class)->create([
            'id' => '31',
            'name' => 'أ',
            'grade_id' => '4',
        ]);
        factory(App\Room::class)->create([
            'id' => '32',
            'name' => 'ب',
            'grade_id' => '4',
        ]);factory(App\Room::class)->create([
            'id' => '33',
            'name' => 'ج',
            'grade_id' => '4',
        ]);    
        //=========Grade-5=====/
        factory(App\Room::class)->create([
            'id' => '41',
            'name' => 'أ',
            'grade_id' => '5',
        ]);
        factory(App\Room::class)->create([
            'id' => '42',
            'name' => 'ب',
            'grade_id' => '5',
        ]);factory(App\Room::class)->create([
            'id' => '43',
            'name' => 'ج',
            'grade_id' => '5',
        ]);
        //=========Grade-6=====/
        factory(App\Room::class)->create([
            'id' => '51',
            'name' => 'أ',
            'grade_id' => '6',
        ]);
        factory(App\Room::class)->create([
            'id' => '52',
            'name' => 'ب',
            'grade_id' => '6',
        ]);factory(App\Room::class)->create([
            'id' => '53',
            'name' => 'ج',
            'grade_id' => '6',
        ]);    
    }
}
