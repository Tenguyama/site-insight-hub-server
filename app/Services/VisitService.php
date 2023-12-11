<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\VisitRequest;
use App\Repositories\VisitRepository;

class VisitService
{
    protected static $instance;

    private readonly VisitRepository $repository;

    protected function __construct(){
        $this->repository = VisitRepository::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create(VisitRequest $request){
        return $this->repository->create($request);
    }
}
