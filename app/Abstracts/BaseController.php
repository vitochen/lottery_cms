<?php

namespace App\Abstracts;

use App\Traits\BaseDatatable;
use Illuminate\Http\Request;

abstract class BaseController
{
    use BaseDatatable;

    protected $repos;
    protected $repository;
    protected $route;
    protected $view;
    protected $lang;

    protected $storeRequest;
    protected $updateRequest;

    abstract public function createPrepare(Request $request): array;

    abstract public function updatePrepare(Request $request): array;

    public function getRopository()
    {
        if (!$this->repository)
            throw new RuntimeException('$repos setting is missing');

        return $this->repository;
    }

    public function getRoute()
    {
        if (!$this->route)
            throw new RuntimeException('$route setting is missing');

        return $this->route;
    }

    public function getView()
    {
        if (!$this->view)
            throw new RuntimeException('$view setting is missing');

        return $this->view;
    }

    public function getLang()
    {
        if (!$this->lang)
            throw new RuntimeException('$lang setting is missing');

        return $this->lang;
    }

    public function getStoreRequest()
    {
        if (!$this->storeRequest)
            throw new RuntimeException('$storeRequest setting is missing');

        return $this->storeRequest;
    }

    public function getUpdateRequest()
    {
        if (!$this->updateRequest)
            throw new RuntimeException('$updateRequest setting is missing');

        return $this->updateRequest;
    }

    private function initial()
    {
        $r = $this->getRopository();
        $this->repos = new $r;
    }

    public function __construct()
    {
        $this->initial();
    }

    public function index()
    {
        return view("{$this->getView()}.index");
    }

    public function data()
    {
        $query = $this->repos->getQuery();

        $table = $this->prepareQueryTable($query);

        $table = $this->regularColumnPush($table, $this->getRoute());

        return $this->makeDataTable($table);
    }

    public function show($id)
    {
        $model = $this->repos->firstOf('id', $id);

        return view("{$this->getView()}.show", compact('model'));
    }

    public function create()
    {
        return view("{$this->getView()}.create");
    }

    public function store()
    {
        $req = $this->getStoreRequest();

        $request = $req::runFormRequest();

        $data = $this->createPrepare($request);

        $model = $this->repos->createModel($data);

        return redirect()->route("{$this->getRoute()}.index")->with('success', trans('notification.create_success', ['model' => trans("{$this->getLang()}.title") . " #{$model->id}"]));
    }

    public function edit($id)
    {
        $model = $this->repos->firstOf('id', $id);

        return view("{$this->getView()}.edit", compact('model'));
    }

    public function update($id)
    {
        $req = $this->getUpdateRequest();

        $request = $req::runFormRequest();

        $data = $this->updatePrepare($request);

        $model = $this->repos->updateModel($id, $data);

        return redirect()->route("{$this->getRoute()}.index")->with('success', trans('notification.update_success', ['model' => trans("{$this->getLang()}.title") . " #{$model->id}"]));
    }

    public function delete($id)
    {
        $confirmRoute = route("{$this->getRoute()}.delete", $id);

        return view('components.deleteModal', compact('confirmRoute'));
    }

    public function destroy($id)
    {
        $model = $this->repos->deleteModel($id);

        return redirect()->route("{$this->getRoute()}.index")->with('success', trans('notification.delete_success', ['model' => trans("{$this->getLang()}.title") . " #{$model->id}"]));
    }
}
