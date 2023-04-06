<?php

namespace Database\Seeders;

use App\Models\ActivityResponsible;
use Illuminate\Database\Seeder;

class ActivityResponsibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('activityResponsibles');

        $model = new ActivityResponsible();

        foreach ($data as $row){
            $model->create($row);
        }
    }

}
