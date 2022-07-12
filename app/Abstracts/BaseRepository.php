<?php

namespace App\Abstracts;

use Illuminate\Support\Str;

abstract class BaseRepository {

    protected $model;

    public function getModel() {
        return $this->model ?? 'App\models\\' . Str::singular(class_basename($this));
    }

    public function firstOf($key, $value)
    {
        $m = $this->getModel();
        return $m::where($key, $value)->first();
    }

    public function createModel($data)
    {
        $m = $this->getModel();
        return $m::create($data);
    }

    public function updateModel($id, $data)
    {
        $m = $this->getModel();

        $model = $m::find($id);

        if(!$model){
            return abort(404);
        }

        $model->fill($data);

        $model->save();

        return $model;
    }

    public function deleteModel($id)
    {
        $m = $this->getModel();

        $model = $m::find($id);

        if(!$model){
            return abort(404);
        }

        $model->delete();

        return $model;
    }
}