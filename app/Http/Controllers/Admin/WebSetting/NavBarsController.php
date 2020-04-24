<?php

namespace App\Http\Controllers\Admin\WebSetting;

use App\Repositories\V1\NavbarsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NavbarRequest;
use App\Http\Response\ResponseJson;

use App\Models\Navbar;

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

    public function addPost(NavbarRequest $request)
    {
        $data = $request->all();
        $result = $this->navbarsRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }

    public function editPost(NavbarRequest $request)
    {
        $data = $request->all();
        $result = $this->navbarsRepository->edit($data);

        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }
}
