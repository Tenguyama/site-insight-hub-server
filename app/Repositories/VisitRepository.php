<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\VisitRequest;
use App\Models\Visit;

class VisitRepository
{
    protected static $instance;

    private readonly Visit $model;

    protected function __construct(){
        $this->model = new Visit();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create(VisitRequest $request)
    {
        $params = [
            'site_id' => $request->input('site_id'),
            'client_id' => $request->input('client_id'),
//            'last_visit_time' => $request->input('last_visit_time'),
            'pages_visited' => $request->input('pages_visited'),
            'session_duration' => $request->input('session_duration'),
            'visit_count' => $request->input('visit_count'),
            'referrer' => $request->input('referrer'),
        ];
        return $this->model->query()->create($params);
    }
}
