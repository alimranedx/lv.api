<?php

namespace App\Common\Services;

use App\Common\Utility\ApiService;
use App\Common\Utility\Exception;
use App\Common\Validation\AppRequestValidation;
use App\Models\Product;


class ProductServices
{
    public function store($input)
    {
        $status_code = '';
        $status_message = '';
        try {
            $validator = AppRequestValidation::validateProductStoreRequest($input);
            if(!empty($validator['status_code'])){
                $status_code = $validator['status_code'];
                $status_message = $validator['status_code'];
            }
            if(empty($status_code)){
                $prepared_data = $this->prepareData($input);
                if(!empty($prepared_data)){
                    $ProductObj = (new Product())->storeData($prepared_data);
                    if(empty($ProductObj)){
                        $status_code = ApiService::API_SERVICE_FAILED_CODE;
                        $status_message = 'Product not created';
                    }else{
                        $status_code = ApiService::API_SERVICE_SUCCESS_CODE;
                        $status_message = ApiService::API_SERVICE_STATUS_MESSAGE[$status_code];
                    }
                }
            }
        }catch (\Throwable $th){
            $status_code = ApiService::API_SERVICE_FAILED_CODE;
            $status_message = ApiService::DEFAULT_TRY_CATCH_ERROR_MESSAGE;
        }
        return [$status_code, $status_message];
    }
    public function prepareData($input)
    {
        $data = [];
        $data['name'] = $input['name'] ?? '';
        $data['slug'] = $input['slug'] ?? '';
        $data['is_active'] = $input['is_active'] ?? Product::STATUS_ACTIVE;
        return $data;
    }
    public function getProductData()
    {
        return (new Product())->getByfilters();
    }
    public function findProductById($id)
    {
        return (new Product())->findById($id);
    }
    public static function getAllStatus() : array
    {
        return [
            Product::STATUS_ACTIVE => Product::STATUS_ACTIVE_TEXT,
            Product::STATUS_INACTIVE => Product::STATUS_INACTIVE_TEXT
        ];
    }
    public function update($input, $id)
    {
        $status_code = '';
        $status_message = '';
        try {
            $validator = AppRequestValidation::validateProductUpdateRequest($input, $id);
            if(!empty($validator['status_code'])){
                $status_code = $validator['status_code'];
                $status_message = $validator['status_code'];
            }
            if(empty($status_code)){
                $prepared_data = $this->prepareData($input);
                if(!empty($prepared_data)){
                    $ProductObj = (new Product())->updateById($id, $prepared_data);
                    if(empty($ProductObj)){
                        $status_code = ApiService::API_SERVICE_FAILED_CODE;
                        $status_message = 'Product not created';
                    }else{
                        $status_code = ApiService::API_SERVICE_SUCCESS_CODE;
                        $status_message = ApiService::API_SERVICE_STATUS_MESSAGE[$status_code];
                    }
                }
            }
        }catch (\Throwable $th){
            $status_code = ApiService::API_SERVICE_FAILED_CODE;
            $status_message = ApiService::DEFAULT_TRY_CATCH_ERROR_MESSAGE;
        }
        return [$status_code, $status_message];
    }
    Public function delete($id)
    {
        $status_code = '';
        $status_message = '';
        try {
            $Product = (new Product())->deleteById($id);
            if(!empty($Product)){
                $status_code = ApiService::API_SERVICE_SUCCESS_CODE;
                $status_message = ApiService::API_SERVICE_STATUS_MESSAGE[$status_code];
            }else{
                $status_code = ApiService::API_SERVICE_FAILED_CODE;
                $status_message = 'Product not created';
            }
        }catch (\Throwable $th){
            $status_code = ApiService::API_SERVICE_FAILED_CODE;
            $status_message = ApiService::DEFAULT_TRY_CATCH_ERROR_MESSAGE;
        }
        return [$status_code, $status_message];
    }
}
