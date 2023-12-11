<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchCodeRequest;
use App\Services\ConnectService;
use Illuminate\Http\JsonResponse;

class ConnectController extends Controller
{
    private readonly ConnectService $service;

    public function __construct()
    {
        $this->service = ConnectService::getInstance();
    }

    public function searchCode(SearchCodeRequest $request){
        return new JsonResponse($this->service->searchCode($request), 200);
    }
}
