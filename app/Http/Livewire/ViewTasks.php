<?php

namespace App\Http\Livewire;

use App\Models\MAchild;
use App\Models\User;
use App\Models\WeeklyPlan;
use Livewire\Component;
use Livewire\WithPagination;

class ViewTasks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $taskview = false;
    public $selectedActivity,$selectedId;
    public $action,$response,$comment;
    public $search,$filterName,$filterSite;

    public function view($id)
    {
        $this->taskview = true;
        $this->response = WeeklyPlan::findorFail($id);
        $this->selectedId = $this->response->id;
        $this->comment = $this->response->comment;
        $this->selectedActivity = $this->response->activityParent->MonitoringActivities->list;
    }

    public function back(){
        $this->reset();
    }

    public function comment(){
        $this->validate([
           'comment' => 'required'
        ]);
        WeeklyPlan::findorFail($this->selectedId)->update(['comment'=> $this->comment]);
        $this->reset();
        session()->flash('message', 'Comment Added.');
    }
    public function render()
    {
        return view('car.view-tasks', [
            'tasks' => WeeklyPlan::latest()
            ->when($this->search != '', function($query) {
                $query->Where('findings', 'like', '%'.$this->search.'%')
                ->Orwhere('date', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterName != '', function($query) {
                $query->Where('user_id', 'like', '%'.$this->filterName.'%');
            })
            ->when($this->filterSite != '', function($query) {
                $query->Where('site', 'like', '%'.$this->filterSite.'%');
            })
            ->paginate(8),
            'Users' => User::all(),
        ]);
    }
}
