<?php

namespace App\Http\Livewire;

use App\Models\Checklist;
use App\Models\MAchild;
use App\Models\User;
use App\Models\WeeklyPlan;
use App\Models\Weeks;
use App\Models\YearlyActivity;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AssignedTasks extends Component
{
    use WithPagination;
    public $load = 6;
    public $taskresponse = false;
    public $selectedActivity,$selectedChild,$selectedId;
    public $action;
    public $modal = false;

    public function loadMore()
    {
        $this->load += 6;
    }

    public function back()
    {
        $this->reset();
    }

    public function respond($id){
       $this->taskresponse = true;
       $response = WeeklyPlan::findorFail($id);
       $this->selectedId = $response->id;
       $this->selectedActivity = $response->activityParent->MonitoringActivities->list;
       $this->action = MAchild::where('monitoring_activities_id','=',$response->activityParent->MonitoringActivities->id)->get();
    }

    public function viewTask($id){
        $response = WeeklyPlan::findorFail($id);
        $this->action = Checklist::where('weekly_plans_id','=',$id)->get();
        $this->modal = true;
    }

    public function render()
    {
        return view('car.assigned-tasks', [
            'activities' => WeeklyPlan::where('user_id', '=', auth()->user()->id)
                ->take($this->load)
                ->latest()
                ->get(),
        ]);
    }
}
