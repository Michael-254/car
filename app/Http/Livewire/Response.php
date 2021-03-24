<?php

namespace App\Http\Livewire;

use App\Mail\HODNotify;
use App\Models\audits;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Response extends Component
{
    use WithPagination;

    public $search = "";
    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department;
    public $clause, $files, $status, $nonconformance, $report_id;
    public $solutions;
    public $cause, $proposed_solution, $proposed_date, $received, $hodName, $HODcomment;
    public $followName, $followDate, $EndfollowDate;
    public $followUpdateData, $HODMail, $respondent;

    public function respond($id)
    {
        $this->received = audits::where('id', $id)->first();
        $this->dateMade = $this->received->date;
        $this->number = $this->received->number;
        $this->respondent = $this->received->response_id;
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
        $this->data = 1;
    }

    public function back()
    {
        $this->reset();
    }

    public function update()
    {
        $this->received->update(['status' => 'Auditee responded', 'response_date' => Carbon::now()->toDateString()]);
        $this->HODMail = User::findOrFail($this->respondent)->HOD;
        Mail::to($this->HODMail)->send(new HODNotify($this->HODMail, $this->auditee));
        $this->reset();
        session()->flash('message', 'Updated and sent to HOD');
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
                'owner' => 'auditee',
            ]);
            session()->flash('message', 'response updated.Add another if you wish to');
            $this->cause = "";
            $this->proposed_solution = "";
            $this->proposed_date = "";
        }
    }


    public function render()
    {
        return view('car.response', [
            'conformances' => audits::where('user_id', '=', auth()->id())
                ->when($this->search != '', function ($query) {
                    $query->where('auditee', 'like', '%' . $this->search . '%')
                        ->orwhere('number', 'like', '%' . $this->search . '%')
                        ->orwhere('date', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(10)
        ]);
    }
}
