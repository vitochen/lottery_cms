<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait BaseDatatable {
    protected function prepareQueryTable($query) {
        return datatables()->eloquent($query);
    }

    protected function prepareDataTable($collection) {
        return datatables()->of($collection);
    }

    protected function regularColumnPush($table, $routeName) {
        if (Route::has($routeName . '.show'))
            $table = $table->addColumn('info_col', function ($model) use ($routeName) {
                $name = $model->name ?? $model->id;
                $id = $model->id;

                return view('components.infoCol', compact('routeName', 'name', 'id'));
            });

        if (Route::has($routeName . '.edit'))
            $table = $table->addColumn('edit_col', function ($model) use ($routeName) {
                $id = $model->id;

                return view('components.editCol', compact('routeName', 'id'));
            });

        if (Route::has($routeName . '.delete'))
            $table = $table->addColumn('del_col', function ($model) use ($routeName) {
                $id = $model->id;

                return view('components.delCol', compact('routeName', 'id'));
            });

        return $table;
    }

    protected function makeDataTable($table, $customRawCols = [])
    {
        $raw = array_merge(['info_col', 'edit_col', 'del_col'], $customRawCols);

        return $table->rawColumns($raw)->make(true);
    }
}