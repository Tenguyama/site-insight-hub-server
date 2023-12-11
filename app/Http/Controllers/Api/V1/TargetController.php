<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TargetRequest;
use App\Services\TargetService;
use Illuminate\Http\JsonResponse;

class TargetController extends Controller
{
    private readonly TargetService $service;

    public function __construct()
    {
        $this->service = TargetService::getInstance();
    }

    public function delete(int $id){
        $this->service->delete($id);
    }

    public function create(TargetRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->create($request), 200);
    }

    public function update(TargetRequest $request, int $id): JsonResponse
    {
        return new JsonResponse($this->service->update($request, $id), 200);
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse($this->service->getById($id), 200);
    }
}
