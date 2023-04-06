<?php

namespace App\Modules\Services;

use App\Models\Member;
use Couchbase\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;
use PHPUnit\Exception;

class MemberService
{
    protected Member $model;

    private array $loginRules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ];

    private array $registerRules =  [
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'nickName' => 'required|string|max:255',
        'phone' => 'required|string|max:255 ',
        'address' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
        'rank' => 'required|string|in:hernieuwer,leider,hoofdleider,bond'
    ];

    public function __construct(Member $userModel)
    {
        $this->model = $userModel;
    }

    public function registerUser(array $data)
    {
        try {
            $validator = Validator::make($data, $this->registerRules);
            if ($validator->fails()) throw new ValidationException("Invalid data");
            $data['password'] = Hash::make($data['password']);
            return response()->json(['message' => 'Document creation successfully','data' =>  $this->model->create($data)], 200);

        }catch (Exception| ValidationException $exception){
            return response()->json(['message' => 'Data is not valid or user already exists', 'error' => $exception->getMessage()], 400);
        }
    }

    function login($credentials): ?string
    {
        $validator = Validator::make($credentials, $this->loginRules);
        if ($validator->fails()) throw new ValidationException("Invalid data");
        $token = auth()->attempt($credentials);
        if ($token == null) throw new AuthenticationException("Wrong credentials");
        return $token;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function getMemberById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }

    public function deleteMemberById(int $id): JsonResponse
    {
        try {
            $member = $this->model->findOrFail($id);
            $member->delete();
            return response()->json(['message' => 'Member deleted successfully'], 200);
        } catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }

    function updateMemberById(int $id, array $requestData): JsonResponse
    {
        try {
            $member = $this->model->findOrFail($id);
            $member->update($requestData);
            return response()->json(['message' => 'Member deleted successfully'], 200);
        } catch (QueryException|ModelNotFoundException $exception) {
            return response()->json(['message' => 'Member not found'], 404);
        }
    }

    function addMember(array $member): ?Member
    {
        return $this->model->create($member);
    }
}
