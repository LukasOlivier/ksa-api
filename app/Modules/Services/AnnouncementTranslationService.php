<?php

namespace App\Modules\Services;

use App\Models\AnnouncementTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class AnnouncementTranslationService extends Service
{
    protected Model $model;

    public function __construct(AnnouncementTranslation $model)
    {
        parent::__construct($model);
    }

    function addAnnouncementTranslation($announcementTranslation): JsonResponse
    {
        try {
            $announcement = $this->model->findOrFail($announcementTranslation['announcementId']);
            $announcement->create($announcementTranslation);
            return response()->json(['data' => $announcement], 200);
        } catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }

    public function updateAnnouncementTranslation(array $requestData): JsonResponse
    {
        try {
            $announcementTranslation = $this->model->where('announcementId', $requestData['announcementId'])->where('language', $requestData['language'])->firstOrFail();
            $announcementTranslation->update($requestData);
            return response()->json(['message' => 'Translation updated successfully', 'data' => $announcementTranslation], 200);
        } catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
    }
}
