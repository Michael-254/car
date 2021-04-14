<?php

namespace App\Http\Livewire;

use App\Models\MAchild;
use App\Models\MonitoringActivity;
use Livewire\Component;
use Livewire\WithPagination;

class AddMonitoringactivity extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $list, $sons;
    public $listId, $listName;
    public $show = 1;
    public $individual,$modal;
    public $NewlyCreate;

    public function addActivity()
    {
        
        $validatedData = $this->validate([
            'list' => 'required|min:6',
        ]);

        $created = MonitoringActivity::create($validatedData);

        $this->listId = $created;
        $this->NewlyCreate = $created->id;
        $this->show = 2;
    }

    public function addsons()
    {
        $validatedData = $this->validate([
            'sons' => 'required|min:6',
        ],
        [
            'sons.required' => 'checklist item required'
        ]);

        $created = MAchild::create($validatedData + ['monitoring_activities_id' => $this->listId->id]);
        $this->individual = 1;
        $this->reset('sons');
    }

    public function delete($id)
    {
        $activity = MonitoringActivity::findorFail($id);
        $activity->mysons()->delete();
        $activity->delete();
        session()->flash('message', 'Activity to Monitor Deleted.');
    }

    public function remove($id)
    {
        $activity = MAchild::findorFail($id);
        $activity->delete();
    }

    public function details($id)
    {
        $this->NewlyCreate = $id;
        $this->modal = 1;
    }

    public function newSon()
    {
        $validatedData = $this->validate([
            'sons' => 'required|min:6',
        ],
        [
            'sons.required' => 'checklist item required'
        ]);

        $created = MAchild::create($validatedData + ['monitoring_activities_id' => $this->NewlyCreate]);
        $this->reset();
        session()->flash('message', 'Saved.');
    }

    public function finish()
    {
        $this->reset();
        session()->flash('message', 'Activity to Monitor added.');
    }

    public function render()
    {
        if ($this->NewlyCreate != "") {
            return view('car.add-monitoringactivity', [
                'childs' =>  MAchild::where('monitoring_activities_id', '=', $this->NewlyCreate)->get(),
                'activities' =>  MonitoringActivity::latest()->paginate(5),
            ]);
        } else {
            return view('car.add-monitoringactivity', [
                'activities' =>  MonitoringActivity::latest()->paginate(5),
            ]);
        }
    }
}
