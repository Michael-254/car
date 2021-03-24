<?php

namespace App\Http\Livewire;

use App\Mail\Followup;
use App\Models\Audits;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class AssignRole extends Component
{
    use WithPagination;

    public $search = "";
    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department;
    public $clause, $files, $status, $nonconformance, $report_id;
    public $solutions;
    public $cause, $proposed_solution, $proposed_date, $received;
    public $decision, $HODcomment;
    public $hodName;
    public $assigned_to,$date_to_monitor,$date_to_end_monitor;

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
        $this->hodName = $this->received->HODs->name;
        $this->HODcomment = $this->received->comment;
        $this->data = 1;
    }

    public function back()
    {
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate([
            'date_to_monitor' => 'required',
            'date_to_end_monitor' => 'required|after:date_to_monitor',
            'assigned_to' => 'required',
        ]);

        $this->received->update(['status' => 'follow up', 'followup_date' => $this->date_to_monitor,
                                 'followup_end_date' => $this->date_to_end_monitor,'followup_id' => $this->assigned_to]);
       
        $follower = User::findOrFail($this->assigned_to);                         
        Mail::to($follower->email)->send(new Followup($follower, auth()->user()));
        $this->reset();
        session()->flash('message', 'Assigned');
    }

    public function render()
    {
        return view('car.assign-role', [
            'conformances' => Audits::where('status', '=', 'HOD approved')
                ->when($this->search != '', function ($query) {
                    $query->where('auditee', 'like', '%' . $this->search . '%')
                        ->orwhere('number', 'like', '%' . $this->search . '%')
                        ->orwhere('date', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(10),
            'users' => User::all(),
        ]);
    }
}
