<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private static $instance;

    private readonly UserRepository $repository;

    protected function __construct(){
        $this->repository = UserRepository::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUserSites($id){
        return $this->repository->getUserSites($id);
    }

}
