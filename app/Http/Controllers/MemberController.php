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
}
