<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    private readonly ClientService $service;

    public function __construct()
    {
        $this->service = ClientService::getInstance();
    }
    public function save(ClientRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->save($request),200);
    }
}
