<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbService;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BreadcrumbService $breadcrumbService
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, BreadcrumbService $breadcrumbService)
    {
        $data['breadcrumbs'] = $breadcrumbService->get('admin.dashboard');
        return view('backend.dashboard',$data);
    }
}
