<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TargetRequest;
use App\Repositories\TargetRepository;

class TargetService
{
    protected static $instance;

    private readonly TargetRepository $repository;

    protected function __construct(){
        $this->repository = TargetRepository::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function delete(int $id){
        $this->repository->delete($id);
    }

    public function create(TargetRequest $request){
        return $this->repository->save($request);
    }

    public function update(TargetRequest $request, int $id){
        return $this->repository->save($request, $id);
    }

    public function getById(int $id){
        return $this->repository->getById($id);
    }
}
