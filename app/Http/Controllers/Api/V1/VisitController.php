<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitRequest;
use App\Services\VisitService;
use Illuminate\Http\JsonResponse;

class VisitController extends Controller
{
    private readonly VisitService $service;

    public function __construct()
    {
        $this->service = VisitService::getInstance();
    }

    public function create(VisitRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->create($request),200);
    }
}
