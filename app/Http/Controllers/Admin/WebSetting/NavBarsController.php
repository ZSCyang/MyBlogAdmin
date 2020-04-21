<?php

namespace App\Http\Controllers\Admin\WebSetting;

use App\Repositories\V1\NavbarsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Http\Requests\Admin\NavbarRequest;
use App\Http\Response\ResponseJson;

class NavBarsController extends Controller
{
    use ResponseJson;
    protected $navbarsRepository;
    public function __construct(NavbarsRepository $navbarsRepository)
    {
        $this->navbarsRepository = $navbarsRepository;
    }

    /**
     * Author jintao.yang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $navbarsList = $this->navbarsRepository->getNavbars();
        return view('admin.navBars.index', compact('navbarsList'));
    }

    public function add(NavbarRequest $request)
    {
        $data = $request->all();
        $result = $this->navbarsRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10001', '添加失败，请稍后再试');
        }
    }

}
