<?php

namespace App\Http\Livewire;

use App\Models\Report;
use App\Models\User;
use App\Models\audits;
use App\Models\Checklist;
use App\Models\images;
use App\Models\WeeklyPlan;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Nonconformance extends Component
{
  use WithFileUploads;

  public $unique;
  public $auditee;
  public $auditeeN;
  public $site;
  public $department;
  public $number;
  public $date;
  public $auditor;
  public $clause;
  public $checkbox;
  public $report;
  public $file, $selectedTask;

  protected $rules = [
    'date' => 'required',
    'number' => 'required',
    'auditor' => 'required',
    'auditeeN' => 'required',
    'site' => 'required',
    'department' => 'required',
    'clause' => 'required',
    'checkbox' => 'required',
    'report' => 'required',
    'file' => 'nullable|max:1024'
  ];

  public function updatedAuditee($auditee)
  {
    if (!is_null($auditee)) {
      $selected = User::where('id', $auditee)->first();
      $this->site =  $selected->site;
      $this->auditeeN =  $selected->name;
      $this->department =  $selected->department;
      $this->unique = rand(10, 10000);
      $this->number =  $this->unique;
    }
  }

  public function save()
  {
    $this->validate();
    $results = auth()->user()->audits()->create([
      'date' => $this->date,
      'number' => $this->number,
      'auditor' => $this->auditor,
      'auditee' => $this->auditeeN,
      'site' => $this->site,
      'department' => $this->department,
      'clause' => $this->clause,
      'checkbox' => $this->checkbox,
      'report' => $this->report,
      'response_id' => $this->auditee,
      'checklist_id' => $this->selectedTask,
    ]);

    if ($this->file != '') {
      $name = md5($this->file . microtime()) . '.' . $this->file->extension();
      $this->file->storeAs('public/images', $name);
      $results->images()->Create([
        'file' => $name,
      ]);
    }

    Checklist::findOrFail($this->selectedTask)->update(['car' => true]);
    session()->flash('message', 'Nonconformance Created.');
    return redirect()->to('/My-Tasks');
  }

  public function render()
  {
    return view('livewire.nonconformance', [
      'users' =>  User::all(),
      $this->auditor = auth()->user()->name,
      $this->date = Carbon::now()->toDateString(),
    ]);
  }
}
