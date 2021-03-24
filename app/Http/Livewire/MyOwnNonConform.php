<?php

namespace App\Http\Livewire;

use App\Models\Audits;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MyOwnNonConform extends Component
{
    use WithPagination;

    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department;
    public $clause, $files, $status, $nonconformance, $report_id;
    public $solutions;
    public $cause, $proposed_solution, $proposed_date, $received;
    public $decision, $HODcomment;
    public $hodName;
    public $assigned_to, $date_to_monitor;
    public $followName, $followDate, $EndfollowDate;
    public $followUpdateData, $ClosedDate;

    public function respond($id)
    {
        $this->received = audits::where('id', $id)->first();
        $this->dateMade = $this->received->date;
        $this->number = $this->received->number;
        $this->checkbox = $this->received->checkbox;
        $this->auditor = $this->received->creator->name;
        $this->auditee = $this->received->auditee;
        $this->site = $this->received->site;
        $this->department = $this->received->department;
        $this->clause = $this->received->clause;
        $this->status = $this->received->status;
        $this->nonconformance = $this->received->report;
        $this->report_id = $this->received->id;
        $this->files = $this->received->images;
        $this->solutions = $this->received->responses;
        $this->hodName = $this->received->hod_id;
        $this->HODcomment = $this->received->comment;
        $this->followName = $this->received->followup_id;
        $this->followDate = $this->received->followup_date;
        $this->EndfollowDate = $this->received->followup_end_date;
        $this->followUpdateData = $this->received->sayings;
        $this->ClosedDate = $this->received->updated_at;
        $this->data = 1;
    }

    public function back()
    {
        $this->reset();
    }


    public function render()
    {
        return view('car.my-own-non-conform', [
            'conformances' => Audits::where('response_id','=',auth()->id())
                ->latest()
                ->paginate(10),
            'Users' => User::all(),
        ]);
    }
}
