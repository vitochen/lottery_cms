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

    public function data()
    {
        $query = $this->repos->getQuery();

        $table = $this->prepareQueryTable($query);

        $statusBtnStyle = Button::map(Event::$STATUS_BTN_STYLE, Button::$OUTLINE_STYLE);

        $table->addColumn('lottery_status', function ($model) use ($statusBtnStyle) {
            $style = $statusBtnStyle[$model->lottery_status];
            $route = route('home');
            $name = Events::getStatusName($model->lottery_status);
            
            return view('components.btnCol', compact('style', 'route', 'name'));
        });

        $table = $this->regularColumnPush($table, $this->getRoute());

        return $this->makeDataTable($table, ['lottery_status']);
    }
}
