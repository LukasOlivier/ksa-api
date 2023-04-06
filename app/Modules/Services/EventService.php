<?php

namespace App\Modules\Services;

use App\Models\Event;
use App\Models\Group;
use App\Models\Member;
use Couchbase\QueryException;
use http\Env\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;
use PHPUnit\Exception;

class EventService
{
    protected Event $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function addEvent($eventData)
    {
        try {
            Group::findOrFail($eventData['groupId']); //Test if group exists
            return response()->json(['message' => 'Event created successfully', 'data' => $this->model->create($eventData)],200);
        } catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Group not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }
    public function updateEvent($eventId, $eventData){
        try {
            $event = $this->model->findOrFail($eventId);
            $event->update($eventData);
            return response()->json(['message' => 'Event updated successfully', 'data' => $event], 200);
        }catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Event not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function removeEvent($eventId){
        try {
            $event = $this->model->findOrFail($eventId);
            $event->delete();
            return response()->json(['message' => 'Event removed successfully'], 200);
        }catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Event not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function getByGroupId($id){
        try{
            $events = $this->model->where('groupId', $id)->get();
            return response()->json(['message' => 'events found successfully for that group', 'data' => $events]);
        }catch (QueryException|ModelNotFoundException|ValidationException $exception) {
            return response()->json(['message' => 'Group not found or data is not valid', 'error' => $exception->getMessage()], 400);
        }
    }

    public function all()
    {
        return response()->json(['message' => 'Events found successfully', 'data' => $this->model->all()], 200);
    }
}
