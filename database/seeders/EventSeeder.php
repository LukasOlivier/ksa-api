<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('events');
        $model = new Event();
        foreach ($data as $row){
            $model->create($row);
        }
    }
}
