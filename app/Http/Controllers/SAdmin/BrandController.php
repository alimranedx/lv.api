<?php

namespace App\Http\Controllers\SAdmin;

use App\Common\Services\BrandServices;
use App\Common\Utility\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data = [
            'module_title' => 'Brand',
            'page_title' => 'List',
        ];
        $data['brandData'] = (new BrandServices())->getBrandData();
        return view('s_admin.brand.index', $data);
    }
    public function add(Request $request)
    {
        $data = [
            'module_title' => 'Brand',
            'page_title' => 'Add',
        ];
        if($request->isMethod('POST')) {
            list($status_code, $status_message) = (new BrandServices())->store($request->all());
            $flash_messagge = $status_message;
            $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
            return redirect()->back()->with($flash_type, $flash_messagge);

        }
        return view('s_admin.brand.add', $data);
    }

    public function edit($id)
    {
        $data = [
            'module_title' => 'Brand',
            'page_title' => 'edit',
        ];
        $data['brandObj'] = (new BrandServices())->findBrandById($id);
        return view('s_admin.brand.edit', $data);
    }
    public function update(Request $request,$id)
    {
        list($status_code, $status_message) = (new BrandServices())->update($request->all(), $id);
        $flash_messagge = $status_message;
        $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
        return redirect()->back()->with($flash_type, $flash_messagge);
    }
    public function delete($id)
    {
        list($status_code, $status_message) = (new BrandServices())->delete($id);
        $flash_messagge = $status_message;
        $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
        return redirect()->back()->with($flash_type, $flash_messagge);
    }
}
