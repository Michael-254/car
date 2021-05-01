<?php

namespace App\Http\Livewire;

use App\Mail\NewNonConformance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;

use Livewire\Component;

class NonIdNonconformance extends Component
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
  public $file;
  public $auditeeMail;

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
      $this->auditeeMail =  $selected->email;
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
    ]);

    if ($this->file != '') {
      $name = $this->file->getClientOriginalName();
      $moved = $this->file->storeAs('public/images', $name);
      $done = $results->images()->Create([
        'file' => $name,
      ]);

      if ($moved && $done) {
        Mail::to($this->auditeeMail)->send(new NewNonConformance($this->auditeeN, auth()->user()));
        session()->flash('message', 'Nonconformance Created.');
        return redirect()->to('/Auditee-Response');
      }
    } else {
      Mail::to($this->auditeeMail)->send(new NewNonConformance($this->auditeeN, auth()->user()));
      session()->flash('message', 'Nonconformance Created.');
      return redirect()->to('/Auditee-Response');
    }

  }


  public function render()
  {
    return view('car.non-id-nonconformance', [
      'users' =>  User::where('auditee', true)->get(),
      $this->auditor = auth()->user()->name,
      $this->date = Carbon::now()->toDateString(),
    ]);
  }
}
