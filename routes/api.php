<?php

use App\Http\Controllers\ActivityResponsibleApiController;
use App\Http\Controllers\AnnouncementApiController;
use App\Http\Controllers\AnnouncementTranslationApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventApiController;
use App\Http\Controllers\GroupApiController;
use App\Http\Controllers\GroupDocumentApiController;
use App\Http\Controllers\groupevents;
use App\Http\Controllers\GroupEvents as ControllersGroupEvents;
use App\Http\Controllers\GroupEventsController;
use App\Http\Controllers\GroupMembersApiController;
use App\Http\Controllers\MemberApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/members", [MemberApiController::class, "all"]);

Route::get("/members/{id}", [MemberApiController::class, "find"]);

Route::get("/groups", [GroupApiController::class, "all"]);

Route::get("/groups/{id}", [GroupApiController::class, "find"]);

Route::get("/groups/{id}/events", [GroupEventsController::class, "findById"]);

Route::get("/announcements", [AnnouncementApiController::class, "all"]);

Route::get("/events", [EventApiController::class, "all"]);

Route::get("/announcements/{id}", [AnnouncementApiController::class, "find"]);

Route::post('/register', [AuthController::class, "register"]);

Route::post('/login', [AuthController::class, "login"]);

Route::middleware('auth:api')->group(function () {

    Route::post("/members", [MemberApiController::class, "add"]);

    Route::put("/members/{id}", [MemberApiController::class, "put"]);

    Route::delete("/members/{id}", [MemberApiController::class, "delete"]);

    Route::post("/groups/{groupId}/addMember/{memberId}", [GroupApiController::class, "addMember"]);

    Route::delete("/groups/{groupId}/removeMember/{memberId}", [GroupApiController::class, "removeMember"]);

    Route::post("/groups/{groupId}/activityResponsibles/{memberId}", [ActivityResponsibleApiController::class, "addActivityResponsible"]);

    Route::delete("/groups/{groupId}/activityResponsibles/{memberId}", [ActivityResponsibleApiController::class, "removeActivityResponsible"]);

    Route::delete("/events/{eventId}/", [EventApiController::class, "removeEvent"]);

    Route::put("/events/{eventId}/", [EventApiController::class, "updateEvent"]);

    Route::post("/events", [EventApiController::class, "addEvent"]);

    Route::delete("/documents/{documentId}", [GroupDocumentApiController::class, "removeDocument"]);

    Route::put("/documents/{documentId}", [GroupDocumentApiController::class, "updateDocument"]);

    Route::post("/documents", [GroupDocumentApiController::class, "addDocument"]);

    Route::post("/groups/{groupId}/removeMember", [GroupApiController::class, "removeMember"]);

    Route::post("/announcements", [AnnouncementApiController::class, "add"]);

    Route::post("/announcements/translation", [AnnouncementTranslationApiController::class, "add"]);

    Route::put("/announcements/translation", [AnnouncementTranslationApiController::class, "put"]);

    Route::put("/announcements/{id}", [AnnouncementApiController::class, "put"]);

    Route::delete("/announcements/{id}", [AnnouncementApiController::class, "delete"]);
});


