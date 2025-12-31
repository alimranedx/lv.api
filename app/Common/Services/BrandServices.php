<?php

namespace App\Common\Services;

use App\Common\Utility\ApiService;
use App\Common\Utility\Exception;
use App\Common\Validation\AppRequestValidation;
use App\Models\Brand;


class BrandServices
{
    public function store($input)
    {
        $status_code = '';
        $status_message = '';
        try {
            $validator = AppRequestValidation::validateBrandStoreRequest($input);
            if(!empty($validator['status_code'])){
                $status_code = $validator['status_code'];
                $status_message = $validator['status_message'];
            }
            if(empty($status_code)){
                $prepared_data = $this->prepareData($input);
                if(!empty($prepared_data)){
                    $brandObj = (new Brand())->storeData($prepared_data);
                    if(empty($brandObj)){
                        $status_code = ApiService::API_SERVICE_FAILED_CODE;
                        $status_message = 'Brand not created';
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
        $data['is_active'] = $input['is_active'] ?? Brand::STATUS_ACTIVE;
        return $data;
    }
    public function getBrandData()
    {
        return (new Brand())->getByfilters();
    }
    public function findBrandById($id)
    {
        return (new Brand())->findById($id);
    }
    public static function getAllStatus() : array
    {
        return [
            Brand::STATUS_ACTIVE => Brand::STATUS_ACTIVE_TEXT,
            Brand::STATUS_INACTIVE => Brand::STATUS_INACTIVE_TEXT
        ];
    }
    public function update($input, $id)
    {
        $status_code = '';
        $status_message = '';
        try {
            $validator = AppRequestValidation::validateBrandUpdateRequest($input, $id);
            if(!empty($validator['status_code'])){
                $status_code = $validator['status_code'];
                $status_message = $validator['status_message'];
            }
            if(empty($status_code)){
                $prepared_data = $this->prepareData($input);
                if(!empty($prepared_data)){
                    $brandObj = (new Brand())->updateById($id, $prepared_data);
                    if(empty($brandObj)){
                        $status_code = ApiService::API_SERVICE_FAILED_CODE;
                        $status_message = 'Brand not created';
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
            $brand = (new Brand())->deleteById($id);
            if(!empty($brand)){
                $status_code = ApiService::API_SERVICE_SUCCESS_CODE;
                $status_message = ApiService::API_SERVICE_STATUS_MESSAGE[$status_code];
            }else{
                $status_code = ApiService::API_SERVICE_FAILED_CODE;
                $status_message = 'Brand not created';
            }
        }catch (\Throwable $th){
            $status_code = ApiService::API_SERVICE_FAILED_CODE;
            $status_message = ApiService::DEFAULT_TRY_CATCH_ERROR_MESSAGE;
        }
        return [$status_code, $status_message];
    }
}
