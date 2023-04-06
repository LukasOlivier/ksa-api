<?php

namespace Database\Seeders;

use App\Models\AnnouncementTranslation;
use Illuminate\Database\Seeder;

class AnnouncementTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('announcements_languages');
        $model = new AnnouncementTranslation();
        foreach ($data as $row){
            $model->create($row);
        }
    }
}
