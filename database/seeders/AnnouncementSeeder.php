<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('announcements');
        $model = new Announcement();
        foreach ($data as $row){
            $model->create($row);
        }
    }
}
