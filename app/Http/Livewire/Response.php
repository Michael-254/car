<?php

namespace App\Http\Livewire;

use App\Models\audits;
use App\Models\Response as ModelsResponse;
use Livewire\Component;
use Livewire\WithPagination;

class Response extends Component
{
    use WithPagination;

    public $search = "";
    public $data = 0;
    public $dateMade, $number, $checkbox, $auditor, $auditee, $site, $department, $clause, $files, $status, $nonconformance,$report_id;
    public $solutions;
    public $cause,$proposed_solution,$proposed_date;

    public function respond($id)
    {
        $received = audits::where('id', $id)->first();
        $this->dateMade = $received->date;
        $this->number = $received->number;
        $this->checkbox = $received->checkbox;
        $this->auditor = $received->creator->name;
        $this->auditee = $received->auditee;
        $this->site = $received->site;
        $this->department = $received->department;
        $this->clause = $received->clause;
        $this->status = $received->status;
        $this->nonconformance = $received->report;
        $this->report_id = $received->id;
        $this->files = $received->images;
        $this->solutions = $received->responses;
        $this->data = 1;
    }

    public function back()
    {
        $this->reset();
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
