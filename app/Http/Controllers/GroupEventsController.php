<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Modules\Services\EventService;
use Illuminate\Http\Request;

class GroupEventsController extends Controller
{
    private $_model;
    private EventService $service;
    public function __construct(Event $model, EventService $service)
    {
        $this->service = $service;
        $this->_model = $model;
    }

    public function findById($id)
    {
        return $this->service->getByGroupId($id);
    }
}
