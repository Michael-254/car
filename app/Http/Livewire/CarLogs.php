<?php

namespace App\Http\Livewire;

use App\Models\Audits;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CarLogs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department;
    public $clause, $files, $status, $nonconformance, $report_id;
    public $solutions;
    public $cause, $proposed_solution, $proposed_date, $received;
    public $decision, $HODcomment;
    public $hodName;
    public $assigned_to, $date_to_monitor;
    public $search, $filterAuditor, $filterAuditee, $filterSite;
    public $followName, $followDate, $EndfollowDate, $mt_comment;
    public $followUpdateData, $new_date;

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
        $this->mt_comment = $this->received->mt_comment;
        $this->followUpdateData = $this->received->sayings;
        $this->data = 1;
    }

    public function back()
    {
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate([
            'mt_comment' => 'required',
        ]);

        $this->received->update([
            'mt_comment' => $this->mt_comment,
        ]);
        $this->reset();
        session()->flash('message', 'Assigned');
    }

    public function change()
    {
        $validated = $this->validate([
            'new_date' => 'required',
        ]);

        $this->received->update([
            'followup_end_date' => $this->new_date,
        ]);
        $this->reset();
        session()->flash('message', 'Date Updated');
    }

    public function render()
    {
        return view('car.car-logs', [
            'conformances' => Audits::where('status', '!=', 'closed')
                ->when($this->search != '', function ($query) {
                    $query->where('number', 'like', '%' . $this->search . '%')
                        ->orwhere('date', 'like', '%' . $this->search . '%')
                        ->orwhere('status', 'like', '%' . $this->search . '%');
                })
                ->when($this->filterAuditor != '', function ($query) {
                    $query->Where('auditor', 'like', '%' . $this->filterAuditor . '%');
                })
                ->when($this->filterAuditee != '', function ($query) {
                    $query->Where('auditee', 'like', '%' . $this->filterAuditee . '%');
                })
                ->when($this->filterSite != '', function ($query) {
                    $query->Where('site', 'like', '%' . $this->filterSite . '%');
                })
                ->latest()
                ->paginate(9),
            'Users' => User::all(),
        ]);
    }
}
