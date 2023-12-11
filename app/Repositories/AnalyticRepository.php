<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\AnalyticRequest;
use App\Models\Analytic;

class AnalyticRepository
{
    protected static $instance;

    private readonly Analytic $model;

    protected function __construct(){
        $this->model = new Analytic();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create(AnalyticRequest $request)
    {
        $params = [
            'site_id' => $request->input('site_id'),
            'target_id' => $request->input('target_id'),
            'client_id' => $request->input('client_id'),
        ];
        return $this->model->query()->create($params);
    }

}
