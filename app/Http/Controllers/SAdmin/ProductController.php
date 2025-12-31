<?php

namespace App\Http\Controllers\SAdmin;

use App\Common\Services\BrandServices;
use App\Common\Services\ProductServices;
use App\Common\Utility\ApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'module_title' => 'Product',
            'page_title' => 'List',
        ];
        $data['productData'] = (new ProductServices())->getProductData();
        return view('s_admin.product.index', $data);
    }
    public function add(Request $request)
    {
        $data = [
            'module_title' => 'Product',
            'page_title' => 'Add',
        ];
        if($request->isMethod('POST')) {
            list($status_code, $status_message) = (new ProductServices())->store($request->all());
            $flash_messagge = $status_message;
            $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
            return redirect()->back()->with($flash_type, $flash_messagge);

        }
        $data['brands'] = (new BrandServices())->getBrandData();
        return view('s_admin.product.add', $data);
    }

    public function edit($id)
    {
        $data = [
            'module_title' => 'Brand',
            'page_title' => 'edit',
        ];
        $data['brands'] = (new BrandServices())->getBrandData();
        $data['productObj'] = (new ProductServices())->findProductById($id);
        return view('s_admin.product.edit', $data);
    }
    public function update(Request $request,$id)
    {
        list($status_code, $status_message) = (new ProductServices())->update($request->all(), $id);
        $flash_messagge = $status_message;
        $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
        return redirect()->back()->with($flash_type, $flash_messagge);
    }
    public function delete($id)
    {
        list($status_code, $status_message) = (new ProductServices())->delete($id);
        $flash_messagge = $status_message;
        $flash_type = $status_code == ApiService::API_SERVICE_SUCCESS_CODE ? 'success' : 'error';
        return redirect()->back()->with($flash_type, $flash_messagge);
    }
}
