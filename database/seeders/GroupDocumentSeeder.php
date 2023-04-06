<?php

namespace Database\Seeders;

use App\Models\GroupDocument;
use Illuminate\Database\Seeder;

class GroupDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('groupDocuments');

        $model = new GroupDocument();

        foreach ($data as $row){
            $model->create($row);
        }
    }

}
