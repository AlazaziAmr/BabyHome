<?php

namespace App\Http\Controllers\Api\Admin\Roles;

use App\Helpers\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\Roles\RoleResource;
use App\Http\Requests\Api\Admin\Roles\CreateRoleRequest;
use App\Http\Requests\Api\Admin\Roles\UpdateRoleRequest;
use App\Http\Resources\Api\Admin\Roles\PermissionResource;
use App\Repositories\Interfaces\Api\Admin\IRoleRepository;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', RoleResource::collection($this->roleRepository->fetchAll([],['id','name'])));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->roleRepository->createRequest($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        try {
            $role = new RoleResource($role->load('permissions:id'));
            return JsonResponse::successfulResponse('msg_success', $role);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $this->roleRepository->updateRequest($request->validated(), $role);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $this->roleRepository->delete($role['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchPermissions()
    {
        try {
            return JsonResponse::successfulResponse('', PermissionResource::collection($this->roleRepository->fetchPermissions()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
