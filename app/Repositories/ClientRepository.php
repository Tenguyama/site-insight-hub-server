<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientRepository
{
    protected static $instance;

    private readonly Client $model;

    protected function __construct(){
        $this->model = new Client();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function save(ClientRequest $request)
    {
        $id = $request->input('id');
        $params = [
            'device' => $request->input('device'),
            'browser' => $request->input('browser'),
            'os' => $request->input('os'),
            'site_id' => $request->input('site_id'),
        ];

        if($id){
            return $this->model->query()->updateOrCreate(['id'=>$id],$params);
        }else{
            return false;
        }
    }
}
