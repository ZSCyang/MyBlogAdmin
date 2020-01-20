<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use App\Services\AdminsService;
use App\Repositories\RolesRepository;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminsController extends BaseController
{
    protected $adminsService;

    protected $rolesRepository;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(AdminsService $adminsService,RolesRepository $rolesRepository)
    {
        $this->adminsService = $adminsService;

        $this->rolesRepository = $rolesRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admins = $this->adminsService->getAdminsWithRoles();

        return $this->view(null, compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->rolesRepository->getRoles();

        return view('admin.admins.create', compact('roles'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $this->adminsService->create($request);

        flash('添加管理员成功')->success()->important();

        return redirect()->route('admins.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = $this->adminsService->ById($id);

        $roles = $this->rolesRepository->getRoles();

        return view('admin.admins.edit', compact('admin','roles'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request,$id)
    {
        $this->adminsService->update($request,$id);

        flash('更新资料成功')->success()->important();

        return redirect()->route('admins.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $admin = $this->adminsService->ById($id);

        if(empty($admin))
        {
            flash('删除失败')->error()->important();

            return redirect()->route('admins.index');
        }


        $admin->roles()->detach();

        $admin->delete();

        //flash('删除成功')->success()->important();
        //return redirect()->route('admins.index');

        return $this->formatResponse(200, '删除成功');
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status,$id)
    {
        $admin = $this->adminsService->ById($id);

        if(empty($admin))
        {
            flash('操作失败')->error()->important();

            return redirect()->route('admins.index');
        }

        $admin->update(['status'=>$status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('admins.index');
    }

    public function showLoginForm()
    {
        return view('admin.admins.login');
    }

    /**
     * 管理员登陆
     * @param AdminLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function loginHandle(AdminLoginRequest $request)
    {
        $result = $this->adminsService->login($request);

        if(!$result)
        {
            return viewError('登录失败','login');
        }

        //将当前账号id存入到session
        $admin_id = $result -> id;
        $request->session()->put('admin_id',$admin_id);
        return viewError('登录成功!','index.index','success');
    }

    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->adminsService->logout();
        $request->session()->put('admin_id',null);
        return redirect()->route('login');
    }

    /**
     * 修改头像页面
     * Author jintao.yang
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAvatr(Request $request){

        $adminId = session('admin_id');
        $admin = $this->adminsService->ById($adminId);
        $avatr = $admin -> avatr;

        return view('admin.admins.editAvatr',compact('avatr'));
    }


    /**
     * 提交修改头像
     * Author jintao.yang
     * @param Request $request
     * @return int
     */
    public function post_changeAvatr(Request $request){

        $adminId = session('admin_id');
        $photo = $this->adminsService->uploadAvatrs($request,$adminId);
        if($photo) {
            flash('更新头像成功')->success()->important();
        }else{
            flash('更新头像失败')->error()->important();
        }
        return redirect()->route('admins.editAvatr');
    }

    /**
     * 修改密码页面
     * Author jintao.yang
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePsw(Request $request){

        return view('admin.admins.changePsw');

    }


    /**
     * 后台修改密码
     * Author jintao.yang
     * @param Request $request
     * @return int
     */
    public function post_changePsw(Request $request){
        $adminId = session('admin_id');
        $result =  $this->adminsService->changePwd($request,$adminId);
        if($result['code'] == 1){
            flash('密码更改成功')->success()->important();
            $this->adminsService->logout();
            $request->session()->put('admin_id', null);
            return redirect()->route('login');
        }else{
            flash($result['msg'])->error()->important();
            return redirect()->route('admins.changePsw');
        }
    }
}
