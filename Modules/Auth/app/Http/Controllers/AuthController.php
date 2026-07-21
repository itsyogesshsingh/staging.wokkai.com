<?php

namespace Modules\Auth\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\AuthRequest;
use Modules\Auth\services\AuthServices;

class AuthController extends Controller
{
    public function __construct(
        protected AuthServices $authServices
    ) {}

    public function index()
    {
        return view('auth::index');
    }

    public function doLogin(AuthRequest $request): JsonResponse
    {
        try {
            $response = $this->authServices->login($request->validated());
            // dd($response);
            if (!$response['status']) {
                return response()->json($response, 401);
            }

            return response()->json(['status' => true, 'message' => 'Login successful', 'redirect' => route('dashboard')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $response = $this->authServices->logout();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
