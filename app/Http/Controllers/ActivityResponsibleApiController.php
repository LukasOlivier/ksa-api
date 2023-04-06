<?php

namespace App\Http\Controllers;

use App\Models\ActivityResponsible;
use App\Modules\Services\ActivityResponsibleService;

class ActivityResponsibleApiController extends Controller
{
    private ActivityResponsibleService $service;
    public function __construct(ActivityResponsible $model, ActivityResponsibleService $service)
    {
        $this->service = $service;
    }

    public function addActivityResponsible($groupId,$memberId){
        return $this->service->addActivityResponsible($groupId,$memberId);
    }

    public function removeActivityResponsible($groupId,$memberId){
        return $this->service->removeActivityResponsible($groupId,$memberId);
    }
}
