<?php

namespace App\Http\Livewire;

use App\Models\activity_in_site;
use App\Models\MonitoringActivity;
use App\Models\User;
use App\Models\WeeklyPlan;
use App\Models\Weeks;
use Livewire\Component;
use Livewire\WithPagination;

class ViewYearPlan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'Bootstrap';
    public $current;
    public $newActivity;
    public $assign = false;
    public $activity_in_sites_id, $user_id, $date, $site;

    public function selected($id)
    {
        $this->reset('assign');
        $this->current = $id;
    }


    public function remove($id)
    {
        $this->reset('assign');
        $activity = activity_in_site::findorFail($id);
        $activity->userplan()->delete();
        $activity->delete();
        session()->flash('message', 'Deleted.');
    }

    public function addNew()
    {
        $this->reset('assign');
        $data = $this->validate([
            'newActivity' => 'required',
        ]);
        activity_in_site::create([
            'site_in_weeks_id' => $this->current,
            'todos' => $this->newActivity
        ]);
        $this->reset('newActivity');

        session()->flash('message', 'New one added.');
    }

    public function assign($id)
    {
        $this->assign = true;
        $this->activity_in_sites_id = $id;
    }

    public function assignTask()
    {
        $plan = $this->validate([
            'user_id' => 'required',
            'date' => 'required',
        ]);

        $this->site = User::findOrFail($this->user_id)->site;

        $UserWeeklyPlan = WeeklyPlan::where('activity_in_sites_id', '=', $this->activity_in_sites_id)->first();

        if ($UserWeeklyPlan != '') {
            $UserWeeklyPlan->update($plan + [
                'activity_in_sites_id' => $this->activity_in_sites_id,
                'site' => $this->site
            ]);
        } else {
            WeeklyPlan::Create($plan + [
                'activity_in_sites_id' => $this->activity_in_sites_id,
                'site' => $this->site
            ]);
        }

        $this->reset(['user_id', 'date', 'assign', 'activity_in_sites_id', 'site']);
    }

    public function Unassign($id)
    {
        $task = WeeklyPlan::where('activity_in_sites_id', '=', $id)->first();
        $task->checks()->delete();
        $task->delete();
        $task = activity_in_site::findOrFail($id)->update(['checked' => false]);
    }



    public function render()
    {
        if ($this->current != "") {
            return view('CAR.view-year-plan', [
                'plans' => Weeks::paginate(7),
                'todos' => activity_in_site::where('site_in_weeks_id', '=', $this->current)->get(),
                'lists' => MonitoringActivity::all(),
                'Users' => User::all(),
            ]);
        } else {
            return view('CAR.view-year-plan', [
                'plans' => Weeks::paginate(7),
                'lists' => MonitoringActivity::all(),
            ]);
        }
    }
}
