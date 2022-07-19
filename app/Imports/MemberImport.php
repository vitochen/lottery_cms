<?php

namespace App\Imports;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToCollection,SkipsOnError,SkipsOnFailure, WithHeadingRow, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    private $event;

    public function __construct($event_id)
    {
        $this->event = Event::find($event_id);
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.name' => ['required', 'string'],
        ], [
            '*.name.required' => 'The Name field is required in file.'
        ])->validate();

        foreach ($rows as $row) {
            $member = Member::create([
                'name' => $row['name'],
            ]);

            $this->event->memberPool()->attach($member);
        }

        $this->event->save();
    }

    public function batchSize(): int
    {
        return 500;
    }
}
