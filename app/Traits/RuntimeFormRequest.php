<?php

namespace App\Traits;


use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

trait RuntimeFormRequest
{
    public static function runFormRequest() {
        $request = self::initFormRequest();

        $request->validated();

        return $request;
    }

    public static function initFormRequest()
    {
        $myRequest = self::createFrom(request(), new self());

        $myRequest->setContainer(app())->setRedirector(app()->make(Redirector::class));

        $myRequest->setValidator(Validator::make($myRequest->all(), $myRequest->rules()));

        return $myRequest;
    }
}