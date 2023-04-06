<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementTranslation;
use App\Modules\Services\AnnouncementTranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementTranslationApiController extends Controller
{
    private AnnouncementTranslationService $service;
    public function __construct(AnnouncementTranslation $model, AnnouncementTranslationService $service)
    {
        $this->service = $service;
    }
    public function add(Request $request): JsonResponse
    {
        $announcement = $request->all();
        return $this->service->addAnnouncementTranslation($announcement);
    }
    public function put(Request $request){
        $requestData = $request->all();
        return $this->service->updateAnnouncementTranslation($requestData);
    }
}
