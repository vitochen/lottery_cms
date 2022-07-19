<?php

namespace App\Http\Controllers;

use App\Http\Requests\MamberImportRequest;
use App\Imports\MemberImport;
use App\Models\Event;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function create($id)
    {
        $event = Event::find($id);
        $sampleFilePath = resource_path('pool_import_sample.xlsx');

        return view('event-member.create', compact('event', 'sampleFilePath'));
    }

    public function import(MamberImportRequest $request)
    {
        $file = $request->file('file');

        $import = new MemberImport($request->get('event_id'));
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route("event.index")->with('success', trans('notification.create_success', ['model' => trans("event.title") . " #{$request->get('event_id')}"]));
        return back()->withStatus('Successful');
    }
}
