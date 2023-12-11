<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private readonly UserService $service;

    public function __construct()
    {
        $this->service = UserService::getInstance();
    }
}
