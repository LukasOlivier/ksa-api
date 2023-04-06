<?php

namespace App\Modules\Services;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class AnnouncementService extends ServicesLanguages {
    protected Model $model;

    public function __construct(Announcement $model) {
        parent::__construct($model);
    }

    public function all($language = null)
    {
        $data = $this->model->get();
        $data->transform(function ($item, $key) use ($language) {
            return $this->PresentWithTranslations($item->toArray(),$language);
        });
        return $data;
    }

    public function getAnnouncementById(int $id, $language = null): JsonResponse
    {
        try {
            $announcement = $this->model->findOrFail($id);
            $announcementWithTranslations = $this->PresentWithTranslations($announcement->toArray(),$language);
            return response()->json(['data' => $announcementWithTranslations], 200);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    public function deleteAnnouncementById(int $id): JsonResponse
    {
        try {
            $announcement = $this->model->findOrFail($id);
            $announcement->delete();
            return response()->json(['message' => 'Announcement deleted successfully'], 200);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    function updateAnnouncementById(int $id, Array $requestData): JsonResponse
    {
        try {
            $announcement = $this->model->findOrFail($id);
            $announcement->update($requestData);
            return response()->json(['data' => $announcement,'message' => 'Announcement updated successfully'], 200);
        }catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    function addAnnouncement($announcement): ?Announcement{
        return $this->model->create($announcement);
    }
}
