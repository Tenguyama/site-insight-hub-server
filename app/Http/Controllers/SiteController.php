<?php

namespace App\Http\Controllers;

use App\Services\SiteService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    private readonly UserService $userService;
    private readonly SiteService $siteService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userService = UserService::getInstance();
        $this->siteService = SiteService::getInstance();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sites = $this->userService->getUserSites(Auth::user()->id);
        return view('sites', compact('sites'));
    }

    public function add(){
        return view('site-add');
    }

    public function show(int $id){
        $site = $this->siteService->getById($id);
        //        return view('site-show', compact('sites', , ,));
    }
}
