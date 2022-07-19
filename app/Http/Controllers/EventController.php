<?php

namespace App\Http\Controllers;

use App\Abstracts\BaseController;
use App\Constants\Button;
use App\Constants\Event;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Repositories\Events;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    protected $repository = Events::class;
    protected $route = 'event';
    protected $view = 'event';
    protected $lang = 'event';
    protected $storeRequest = EventCreateRequest::class;
    protected $updateRequest = EventUpdateRequest::class;

    public function createPrepare(Request $request): array
    {
        return $request->only([
            'name'
        ]);
    }
    
    public function updatePrepare(Request $request): array
    {
        return $request->only([
            'name'
        ]);
    }

    public function store()
    {
        $req = $this->getStoreRequest();

        $request = $req::runFormRequest();

        $data = $this->createPrepare($request);

        $model = $this->repos->createModel($data);

        return redirect()->route("price.create")
                        ->with('success', trans('notification.create_success', ['model' => trans("{$this->getLang()}.title") . " #{$model->id}"]));
    }

    public function data()
    {
        $query = $this->repos->getQuery();

        $table = $this->prepareQueryTable($query);

        $statusBtnStyle = Button::map(Event::$STATUS_BTN_STYLE, Button::$OUTLINE_STYLE);

        $table->addColumn('lottery_status', function ($model) use ($statusBtnStyle) {
            $style = $statusBtnStyle[$model->lottery_status];
            $route = route('event.showPrice', ['id' => $model->id]);
            $name = Events::getStatusName($model->lottery_status);
            
            return view('components.btnCol', compact('style', 'route', 'name'));
        });

        $table = $this->regularColumnPush($table, $this->getRoute());

        return $this->makeDataTable($table, ['lottery_status']);
    }

    public function showPrice($id)
    {
        $event = $this->repos->firstOf('id', $id);

        return view('event.priceModal', compact('event'));
    }

    public function showPool($id)
    {
        $event = $this->repos->firstOf('id', $id);

        $members = $event->lotteryPool()->simplePaginate(15);
        
        $title = $event->name . ' # ' . __('event.pool');

        $backLink = view('components.linkCol', [
            'route' => route('event.showPrice', ['id' => $event->id]), 
            'name' => '< ' . __('event.lottery_history')
        ])->render();

        return view('event.memberModal', compact('title', 'members', 'backLink'));
    }

    public function lotteryCount($id)
    {   
        $event = $this->repos->firstOf('id', $id);

        return view('components.linkCol', [
            'route' => route('event.showPool', ['id' => $event->id]), 
            'name' => $event->lottery_pool_count
        ]);
    }
}
