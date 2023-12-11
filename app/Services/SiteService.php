<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\SiteRequest;
use App\Repositories\SiteRepository;
use Illuminate\Http\Request;

class SiteService
{
    protected static $instance;

    private readonly SiteRepository $repository;

    protected function __construct(){
        $this->repository = SiteRepository::getInstance();
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

    public function create(SiteRequest $request){
        return $this->repository->save($request);
    }

    public function update(SiteRequest $request, int $id){
        return $this->repository->save($request, $id);
    }

    public function getById(int $id){
        return $this->repository->getById($id);
    }

    public function getSiteTargets(int $id){
        return $this->repository->getSiteTargets($id);
    }

    public function isNameAndUrlUnique(string $name,string $url)
    {
        return $this->repository->isNameAndUrlUnique($name, $url);
    }

    public function getSiteByUrlPage(Request $request){
        return $this->repository->getSiteByUrlPage($request);
    }
    public function getSiteClients(int $id){
        return $this->repository->getSiteClients($id);
    }
    public function getSiteVisits(int $id){
        return $this->repository->getSiteVisits($id);
    }
    public function getSiteAnalytics(int $id){
        return $this->repository->getSiteAnalytics($id);
    }
}
