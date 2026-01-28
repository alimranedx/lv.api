<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'image'];
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE_TEXT = 'Active';
    const STATUS_INACTIVE_TEXT = 'Inactive';
    public function storeData($data)
    {
        return self::query()->create($data);
    }
    public function getByfilters($filters = [])
    {
        return self::query()->get();
    }
    public function findById($id)
    {
        return self::query()->find($id);
    }
    public function updateById($id, $data)
    {
        return self::query()->where('id',$id)->update($data);
    }
    public function deleteById($id)
    {
        return self::query()->where('id',$id)->delete();
    }
    public function getByfilterData($filters = [])
    {
         return self::query()
         ->when(!empty($filters['is_active']), function ($query) use ($filters) {          
             $query->where('is_active', $filters['is_active']);
         })
         ->when(!empty($filters['name']), function ($query) use ($filters) {
             $query->where('name', 'like', '%' . $filters['name'] . '%');
         })
         ->get();
    }
}
