<?php

namespace App\Http\Controllers\Admin\Ports;

use App\Http\Requests\Admin\PortRequest;
use App\Http\Response\ResponseJson;
use App\Models\Port;
use App\Repositories\V1\PortsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortsController extends Controller
{

    use ResponseJson;
    protected $portsRepository;
    public function __construct(PortsRepository $portsRepository)
    {
        $this->portsRepository = $portsRepository;
    }

    public function index(Request $request, Port $port)
    {
        $name = $request->input('name');
        $portsList = $port->where(function ($query) use ($name) {
            if (!empty($name)) {
                $query->where('name', 'like', $name);
            }
        })
            ->orderby('created_at', 'desc')
            ->paginate(2);
        return view('admin.ports.index', compact('portsList', 'name'));
    }


    public function addPost(PortRequest $request)
    {
        $data = $request->all();
        $result = $this->portsRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }
}
