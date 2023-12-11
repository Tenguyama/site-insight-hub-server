<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\AnalyticRequest;
use App\Repositories\AnalyticRepository;

class AnalyticService
{
    protected static $instance;

    private readonly AnalyticRepository $repository;

    protected function __construct(){
        $this->repository = AnalyticRepository::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create(AnalyticRequest $request){
        return $this->repository->create($request);
    }
}
