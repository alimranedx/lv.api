<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'is_active'];
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
}
