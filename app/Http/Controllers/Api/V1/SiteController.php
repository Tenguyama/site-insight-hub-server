<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest;
use App\Models\Site;
use App\Services\SiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private readonly SiteService $service;

    public function __construct()
    {
        $this->service = SiteService::getInstance();
    }

    public function delete(int $id){
        $this->service->delete($id);
    }

    public function create(SiteRequest $request): JsonResponse
    {
        $data = $request->validated();
        $isUnique = $this->service->isNameAndUrlUnique($data['name'], $data['url_page']);

        if (!$isUnique) {
            return new JsonResponse(['result' => false, 'message' => 'The couple (Name and URL) must be unique!'], 200);
        }
        return new JsonResponse($this->service->create($request), 200);
    }

    public function update(SiteRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $isUnique = $this->service->isNameAndUrlUnique($data['name'], $data['url_page']);

        if (!$isUnique) {
            return new JsonResponse(['result' => false, 'message' => 'The couple (Name and URL) must be unique!'], 200);
        }
        return new JsonResponse($this->service->update($request, $id), 200);
    }

    public function getSiteTargets(int $id): JsonResponse
    {
        return new JsonResponse($this->service->getSiteTargets($id), 200);
    }

    public function getSiteByUrlPage(Request $request): JsonResponse
    {
        return new JsonResponse( $this->service->getSiteByUrlPage($request),200);
    }
    public function getSiteClients(int $id): JsonResponse
    {
        return new JsonResponse( $this->service->getSiteClients($id),200);
    }
    public function getSiteVisits(int $id): JsonResponse
    {
        return new JsonResponse( $this->service->getSiteVisits($id),200);
    }
    public function getSiteAnalytics(int $id): JsonResponse
    {
        return new JsonResponse( $this->service->getSiteAnalytics($id),200);
    }
}
