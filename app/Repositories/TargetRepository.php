<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\TargetRequest;
use App\Models\Target;

class TargetRepository
{
    protected static $instance;

    private readonly Target $model;

    protected function __construct(){
        $this->model = new Target();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function delete(int $id){
        $target = $this->model->query()->find($id);
        $target->delete();
    }

    public function save(TargetRequest $request, ?int $id = null)
    {
        $params = [
            'search_type' => $request->input('search_type'),
            'identified' => $request->input('identified'),
            'search_value' => $request->input('search_value'),
            'site_id' => $request->input('site_id'),
        ];

        if($id){
            $target = $this->model->query()->updateOrCreate(['id'=>$id],$params);
        }else{
            $target = $this->model->query()->create($params);
        }
        return $target;
    }

    public function getById(int $id){
        return $this->model->query()->find($id);
    }
}
