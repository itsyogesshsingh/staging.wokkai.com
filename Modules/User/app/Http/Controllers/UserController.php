<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\DTOs\UserDTO;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index(Request $request)
    {
        $data = $this->userService->list($request->keyword, $request->sort);
        return view('user::index', compact('data'));
    }

    public function store(UserRequest $request): JsonResponse
    {
        try {
            $dto = UserDTO::fromArray($request->validated());
            // dd($request->all());
            // dd([
            //     'request' => request('email_enabled'),
            //     'dto' => $dto->email_enabled,
            // ]);
            $user = $this->userService->create($dto);

            return response()->json(['status' => true, 'message' => 'User created successfully', 'data' => $user ], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit(int $uid): JsonResponse
    {
        try {
            $user = $this->userService->edit($uid);

            return response()->json(['status' => true, 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve user', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UserRequest $request, int $uid): JsonResponse
    {
        try {
            $dto = UserDTO::fromArray($request->validated());
            $user = $this->userService->update($uid, $dto);

            return response()->json(['status' => true, 'message' => 'User updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve user', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete(int $uid): JsonResponse
    {
        try {
            $this->userService->delete($uid);

            return response()->json(['status' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to retrieve user', 'error' => $e->getMessage()], 500);
        }
    }
}
