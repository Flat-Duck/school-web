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
    }
}
