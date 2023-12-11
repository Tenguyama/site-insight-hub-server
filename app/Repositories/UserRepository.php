<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    private static $instance;

    private readonly User $model;

    protected function __construct(){
        $this->model = new User();
    }

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUserSites(int $id){
        $user = $this->model->query()->find($id);
        return $user->sites()->orderBy('created_at', 'desc')->get();
    }
}
