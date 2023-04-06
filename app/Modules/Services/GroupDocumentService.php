<?php

namespace App\Modules\Services;

use App\Models\Group;
use App\Models\GroupDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Nette\Schema\ValidationException;

class GroupDocumentService extends Service{
    protected Model $model;


    public function __construct(GroupDocument $model) {
        parent::__construct($model);
    }

    public function addDocument($document)
    {
        try {
            Group::findOrFail($document['groupId']); //Test if group exists
            $document = $this->model->create($document);
            return response()->json(['message' => 'Document creation successfully','data' => $document], 200);
        } catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Group not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function removeDocument($documentId)
    {
        try {
            $document = $this->model->findOrFail($documentId);
            $document->delete();
            return response()->json(['message' => 'Document removed successfully'], 200);
        }catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Document not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function updateDocument($newDocumentInfo, $documentId)
    {
        try {
            Group::findOrFail($newDocumentInfo['groupId']); //Test if group exists
            $document = $this->model->findOrFail($documentId);
            $document->update($newDocumentInfo);
            return response()->json(['message' => 'Document updated successfully', 'data' => $document], 200);
        }catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Group / Document not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }
}

