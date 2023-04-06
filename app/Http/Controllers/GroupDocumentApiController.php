<?php

namespace App\Http\Controllers;

use App\Models\GroupDocument;
use App\Modules\Services\GroupDocumentService;
use Illuminate\Http\Request;

class GroupDocumentApiController extends Controller
{
    private $_model;
    private GroupDocumentService $service;
    public function __construct(GroupDocument $model, GroupDocumentService $service)
    {
        $this->service = $service;
        $this->_model = $model;
    }

public function addDocument(Request $request){
        return $this->service->addDocument($request->all());
    }

    public function removeDocument($documentId){
        return $this->service->removeDocument($documentId);
    }

    public function updateDocument(Request $request,$documentId){
        return $this->service->updateDocument($request->all(),$documentId);
    }
}
