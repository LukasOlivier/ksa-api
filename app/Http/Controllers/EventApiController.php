<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Modules\Services\EventService;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    private EventService $service;
    public function __construct(Event $model, EventService $service)
    {
        $this->service = $service;
    }

    public function all(){
        return $this->service->all();
    }
    public function addEvent(Request $request){
        $event = $request->all();
        return $this->service->addEvent($event);
    }

    public function updateEvent(Request $request, $id){
        $event = $request->all();
        return $this->service->updateEvent($id, $event);
    }

    public function removeEvent($id){
        return $this->service->removeEvent($id);
    }
}
