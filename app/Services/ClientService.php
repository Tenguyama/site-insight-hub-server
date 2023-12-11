<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\ClientRequest;
use App\Repositories\ClientRepository;

class ClientService
{
    protected static $instance;

    private readonly ClientRepository $repository;

    protected function __construct(){
        $this->repository = ClientRepository::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function save(ClientRequest $request){
        return $this->repository->save($request);
    }
}
