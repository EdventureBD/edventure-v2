<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    // use HasFactory;


    public function saveData($input, $model_id = null)
    {
        if (empty($model_id)) {
            $model = $this->create($input);
            $model = $model->fresh();
        } else {
            $model = $this->updateOrCreate(['id' => $model_id], $input);
            $model->save();
        }
        return $model;
    }

    // public function getData($opt = null)
    // {

    //     $data = !empty($opt) ? $this->where($opt) : $this;
    //     $data = !empty(request()->sort) ? $data->orderBy('id', request()->sort) : $data;
    //     // $data = !empty(request()->brand_id) ? $data->where('brand_id', request()->sort) : $data;
    //     return $data->latest()->get();
    // }

    public function getById($id)
    {
        // $data = $this->findOrFail($id);

        $data = $this->where('id', $id)->first();
        return $data;
    }

    public function getByName($name)
    {
        $data = $this->where('name', $name)->first();
        return $data;
    }
}
