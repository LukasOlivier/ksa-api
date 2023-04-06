<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Modules\Services\GroupService;
use Illuminate\Http\Request;

class GroupApiController extends Controller
{
    private $_model;
    private GroupService $groupService;
    public function __construct(Group $model, GroupService $service)
    {
        $this->groupService = $service;
    }

    public function all(Request $request){
        return $this->groupService->all();
    }

    public function addMember($groupId,$memberId){
        return $this->groupService->addMember($groupId,$memberId);
    }

    public function removeMember($groupId,$memberId){
        return $this->groupService->removeMember($groupId,$memberId);
    }

    public function find(int $id)
    {
        return $this->groupService->getGroupById($id);
    }
}
