<?php

namespace Database\Seeders;

use App\Models\groupmember;
use Illuminate\Database\Seeder;

class GroupMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CvsReader::read('groupMembers');

        $model = new GroupMember();

        foreach ($data as $row){
            $model->create($row);
        }
    }

}
