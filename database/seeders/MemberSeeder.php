<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('members');

        $model = new Member();

        foreach ($data as $row){
            $model->create($row);
        }
    }

}
