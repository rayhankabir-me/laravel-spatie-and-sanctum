<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Libraries\AppLibrary;
use Illuminate\Http\JsonResponse;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\DefaultAccessService;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public string $token;
    public DefaultAccessService $defaultAccessService;
    public PermissionService $permissionService;

    public function __construct(
        PermissionService    $permissionService,
        DefaultAccessService $defaultAccessService
    ) {
        $this->permissionService    = $permissionService;
        $this->defaultAccessService = $defaultAccessService;
    }

    /**
     * @throws \Exception
     */

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'        => $request['phone'] ? ['nullable', 'string', 'email', 'max:255'] : ['required', 'string', 'email', 'max:255'],
                'phone'        => $request['email'] ? ['nullable', 'string', 'max:20'] : ['required', 'string', 'max:20'],
                'country_code' => $request['email'] ? ['nullable', 'string', 'max:20'] : ['required', 'string', 'max:20'],
                'password'     => ['required', 'string', 'min:6'],
            ],
        );

        if ($validator->fails()) {
            if (!$request['email'] && !$request['phone']) {
                return new JsonResponse([
                    'errors' => [
                            'email_or_phone' => 'you must provide email or phone..',
                        ] + $validator->errors()->toArray()
                ], 422);
            } else {
                return new JsonResponse([
                    'errors' => $validator->errors()
                ], 422);
            }
        }

        $request->merge(['status' => 5]);

        if ($request['email']) {
            if (!Auth::guard('web')->attempt($request->only('email', 'password', 'status'))) {
                return new JsonResponse([
                    'errors' => ['validation' => 'credentials are invalid..']
                ], 400);
            }
            $user = User::where('email', $request['email'])->first();
        } else {
            if (!Auth::guard('web')->attempt($request->only('country_code', 'phone', 'password', 'status'))) {
                return new JsonResponse([
                    'errors' => ['validation' => 'invalid credentials..']
                ], 400);
            }
            $user = User::where(['phone' => $request['phone'], 'country_code' => $request->country_code])->first();
        }

        $this->token = $user->createToken('auth_token')->plainTextToken;

        if (!isset($user->roles[0])) {
            return new JsonResponse([
                'errors' => ['validation' => 'role already exists..']
            ], 400);
        }

        $permission        = PermissionResource::collection($this->permissionService->permission($user->roles[0]));
        $defaultPermission = AppLibrary::defaultPermission($permission);

        return new JsonResponse([
            'message'           => 'login success..',
            'token'             => $this->token,
            'user'              => new UserResource($user),
            'permission'        => $permission,
            'defaultPermission' => $defaultPermission,
        ], 201);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return new JsonResponse([
            'message' => trans('all.message.logout_success')
        ], 200);
    }
}
