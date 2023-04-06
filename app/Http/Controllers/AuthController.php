<?php

namespace App\Http\Controllers;

use App\Modules\Services\MemberService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    private MemberService $userService;

    public function __construct(MemberService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        try {
            $this->userService->registerUser($request->all());
            return response()->json(['message' => "Member registration success"], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public
    function login(Request $request)
    {
        try {
            $token = $this->userService->login($request->only('email', 'password'));
            return response()->json([
                "authorisation" => ['token' => $token, 'type' => "bearer"],
                "data" => auth()->user()
            ])->withCookie(
                'token',
                $token,
                config('jwt.ttl'),
                '/',
                null,
                true,
                true,
                false,
                "None");
        }catch (AuthenticationException $e){
            return response()->json(['message' => "Invalid credentials"], 400);
        }catch (ValidationException $e){
            return response()->json(['message' => "Invalid data"], 400);
        }
    }
}
