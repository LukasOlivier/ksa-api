<?php

namespace App\Modules\Services;

use App\Models\ActivityResponsible;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ActivityResponsibleService extends Service{
    protected Model $model;

    public function __construct(ActivityResponsible $model) {
        parent::__construct($model);
    }

    public function addActivityResponsible($groupId, $memberId)
    {
        try {
            $group = Group::findOrFail($groupId);
            Member::findOrFail($memberId);
            $this->model->create([
                'groupId' => $groupId,
                'memberId' => $memberId
            ]);
            return response()->json(['message' => 'Activity responsible added successfully', 'data' => $group], 200);
        }catch (QueryException | ModelNotFoundException $exception){
            return response()->json(['message' => 'Group / Member not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function removeActivityResponsible($groupId, $memberId)
    {
        try {
            $group = Group::findOrFail($groupId);
            Member::findOrFail($memberId);
            $this->model->where('groupId', $groupId)->where('memberId', $memberId)->firstOrFail(); // Check if member is activity responsible
            $this->model->where('groupId', $groupId)->where('memberId', $memberId)->delete();
            return response()->json(['message' => 'Activity responsible removed successfully', 'data' => $group], 200);
        }catch (QueryException | ModelNotFoundException $exception){
            return response()->json(['message' => 'Group / Member not found or member is not an activity responsible', 'error' => $exception->getMessage()], 400);
        }
    }
}

