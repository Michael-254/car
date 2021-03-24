<?php

namespace App\Http\Livewire;

use App\Models\Audits;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class HODResponse extends Component
{
    use WithPagination;

    public $Selectedsite;
    public $search = "";
    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department;
    public $clause, $files, $status, $nonconformance, $report_id;
    public $solutions;
    public $cause, $proposed_solution, $proposed_date, $received;
    public $decision, $HODcomment;

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
        $this->data = 1;
    }

    public function back()
    {
        $this->reset('data','received');
    }

    public function update()
    {
        $this->received->update(['status' => $this->decision, 'hod_date' => Carbon::now()->toDateString(), 
        'comment' => $this->HODcomment,'hod_id' => auth()->id()]);
        $this->reset(['decision','HODcomment','received','data']);
        session()->flash('message', 'Updated and sent to Auditee and Initiator');
    }

    public function answers()
    {
        $validatedDate = $this->validate([
            'cause' => 'required',
            'proposed_solution' => 'required',
            'proposed_date' => 'required',
        ]);
        if ($this->report_id) {
            $store = audits::find($this->report_id);
            $store->responses()->Create([
                'cause' => $this->cause,
                'proposed_solution' => $this->proposed_solution,
                'proposed_date' => $this->proposed_date,
                'owner' => 'HOD',
            ]);
            session()->flash('message', 'response updated.Add another if you wish to');
            $this->cause = "";
            $this->proposed_solution = "";
            $this->proposed_date = "";
        }
    }

    public function render()
    {
        return view('livewire.h-o-d-response', [
            'conformances' => Audits::where([['department', '=', $this->Selectedsite], ['status', '=', 'Auditee responded']])
                ->when($this->search != '', function ($query) {
                    $query->where('auditee', 'like', '%' . $this->search . '%')
                        ->orwhere('number', 'like', '%' . $this->search . '%')
                        ->orwhere('date', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(10),
        ]);
    }
}
