<?php

namespace App\Http\Controllers;

use App\Abstracts\BaseController;
use App\Http\Requests\MemberCreateRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Repositories\Members;
use Illuminate\Http\Request;

class MemberController extends BaseController
{
    protected $repository = Members::class;
    protected $route = 'member';
    protected $view = 'member';
    protected $lang = 'member';
    protected $storeRequest = MemberCreateRequest::class;
    protected $updateRequest = MemberUpdateRequest::class;

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

        $table->addColumn('joined_event_count', function ($model) {
            $route = route('member.showEvent', ['id' => $model->id]);
            $name = $model->joiningEvent->count();
            
            if( $name == 0)
                return $name;
            else
                return view('components.linkCol', compact('route', 'name'));
        });

        $table->addColumn('winned_price_count', function ($model) {
            $route = route('member.showPrices', ['id' => $model->id]);
            $name = $model->prices->count();
            
            if( $name == 0)
                return $name;
            else
                return view('components.linkCol', compact('route', 'name'));
        });

        return $this->makeDataTable($table, ['joined_event_count', 'winned_price_count']);
    }

    public function showEvent($id)
    {
        $member = $this->repos->firstOf('id', $id);

        $events = $member->joiningEvent()->simplePaginate(15);

        $title = $member->name . ' # ' . __('member.joined_event');

        return view('member.eventModal', compact('title', 'events'));
    }

    public function showPrices($id)
    {
        $member = $this->repos->firstOf('id', $id);

        $prices = $member->prices()->simplePaginate(15);

        $title = $member->name . ' # ' . __('member.winned_price');

        return view('member.priceModal', compact('title', 'prices'));
    }
}
