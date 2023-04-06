<?php

namespace App\Modules\Services;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class GroupService extends Service{
    protected Model $model;

    public function __construct(Group $model) {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->get();
    }

    public function getGroupById($id)
    {
        try {
            return $this->model->findOrFail($id);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Group not found'], 404);
        }
    }

    public function addMember($groupId, $memberId)
    {
        try {
            $group = $this->model->findOrFail($groupId);
            $group->members()->attach($memberId);
            return response()->json(['message' => 'Member added successfully', 'data' => $group], 200);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Member / group not found or member already in group'], 400);
        }
    }

    public function removeMember($groupId, $memberId)
    {
        try {
            $group = $this->model->findOrFail($groupId);
            $member = $group->members()->findOrFail($memberId);
            $group->members()->detach($member->id);
            return response()->json(['message' => 'Member removed successfully', 'data' => $group], 200);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Member / group not found or member already in group'], 400);
        }
    }
}

