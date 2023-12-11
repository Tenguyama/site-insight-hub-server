<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyticRequest;
use App\Services\AnalyticService;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    private readonly AnalyticService $service;

    public function __construct()
    {
        $this->service = AnalyticService::getInstance();
    }

    public function create(AnalyticRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->create($request),200);
    }
}
