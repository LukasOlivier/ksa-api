<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Modules\Services\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementApiController extends Controller
{
    private AnnouncementService $service;
    public function __construct(Announcement $model, AnnouncementService $service)
    {
        $this->service = $service;
    }

    public function all(Request $request){
        $language = $request->get('language');
        return $this->service->all($language);
    }

    public function find(Request $request, $id){
        $language = $request->get('language');
        return $this->service->getAnnouncementById($id,$language);
    }

    public function add(Request $request){
        $announcement = $request->all();
        return $this->service->addAnnouncement($announcement);
    }

    public function delete($id){
        return $this->service->deleteAnnouncementById($id);
    }

    public function put(Request $request, $id){
        $requestData = $request->all();
        return $this->service->updateAnnouncementById($id, $requestData);
    }
}
