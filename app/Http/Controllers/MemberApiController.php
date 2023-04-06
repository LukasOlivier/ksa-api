<?php

namespace App\Http\Controllers;

use App\Modules\Services\MemberService;
use Illuminate\Http\Request;

class MemberApiController extends Controller
{
    private MemberService $service;
    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    public function all(){
        return $this->service->all();
    }

    public function find($id){
        $member = $this->service->getMemberById($id);

        if (is_null($member))
            return response(["error" => "Member not found"], 404);

        return $member;

    }

    public function add(Request $request){
        $member = $this->service->addMember($request->all());
        return response()->json(["message" => "Member added successfully", 'data' => $member], 200);
    }

    public function delete($id){
        return $this->service->deleteMemberById($id);
    }

    public function put(Request $request, $id){
        $member = $this->service->updateMemberById($id, $request->all());
        return response()->json(['message' => 'Member updated successfully', 'data' => $member], 200);
    }
}
