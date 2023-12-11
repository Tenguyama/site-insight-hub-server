<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\SiteRequest;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteRepository
{
    protected static $instance;

    private readonly Site $model;

    protected function __construct(){
        $this->model = new Site();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function delete(int $id){
        $site = $this->model->query()->find($id);
        $site->delete();
    }

    public function save(SiteRequest $request, ?int $id = null)
    {
        $params = [
            'name' => $request->input('name'),
            'url_page' => $request->input('url_page'),
            'user_id' => $request->input('user_id'),
        ];

        if($id){
            $site = $this->model->query()->updateOrCreate(['id'=>$id],$params);
        }else{
            $site = $this->model->query()->create($params);
        }
        return $site;
    }

    public function getById(int $id){
        return $this->model->query()->find('id');
    }

    public function getSiteTargets(int $id){
        $site = $this->model->query()->find($id);
        return $site->targets()->orderBy('created_at', 'desc')->get();
    }

    public function isNameAndUrlUnique(string $name,string $url)
    {
        return $this->model->query()
            ->where('name', $name)
            ->where('url_page', $url)
            ->doesntExist();
    }

    public function getSiteByUrlPage(Request $request){
        // тут момент в тому що js бачить сам себе як 127.0.0.1:5500
        // але в бд він записаний не так, бо докер інакше не запарсить
        // локально підняту сторінку за посиланням
        $page = $request->input('url_page');
        $parts = parse_url($page);

        if ($parts && isset($parts['host'])) {
            $protocol = isset($parts['scheme']) ? $parts['scheme'] . '://' : '';
            $domain = $parts['host'];
            $port = isset($parts['port']) ? ':' . $parts['port'] : '';
            $path = isset($parts['path']) ? $parts['path'] : '';

            if ($domain === '127.0.0.1' || $domain === 'localhost') {
                $domain = 'host.docker.internal';
                $url = $protocol . $domain . $port . $path;
            } else {
                $url = $page;
            }
        } else {
            return false;
        }
        return $this->model->query()->where('url_page','=', $url)->first();
    }
    public function getSiteClients(int $id){
        $site = $this->model->query()->find($id);
        return $site->clients()->orderBy('created_at', 'desc')->get();
    }
    public function getSiteVisits(int $id){
        $site = $this->model->query()->find($id);
        return $site->visits()->orderBy('created_at', 'desc')->get();
    }
    public function getSiteAnalytics(int $id){
        $site = $this->model->query()->find($id);
        return $site->analytics()->orderBy('created_at', 'desc')->get();
    }
}
