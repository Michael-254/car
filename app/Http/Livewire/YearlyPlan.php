<?php

namespace App\Http\Livewire;

use App\Models\activity_in_site;
use App\Models\MonitoringActivity;
use App\Models\site_in_Week;
use App\Models\Weeks;
use Livewire\Component;

class YearlyPlan extends Component
{
    public $weekselected, $site, $week_name;
    public $show = 1;
    public $savedsite, $savedWeek, $site_in_weeks_id, $todos;
    public $individual;


    public function save()
    {
        $data = $this->validate([
            'site' => 'required',
            'weekselected' => 'required',
        ]);

        $savedData = site_in_Week::create([
            'week_name' => $this->week_name,
            'weeks_id' => $this->weekselected,
            'site' => $this->site,
        ]);
        $this->savedsite = $savedData->site;
        $this->savedWeek = $savedData->week_name;
        $this->site_in_weeks_id = $savedData->id;
        $this->show = 2;
    }

    public function updatedWeekselected($weekselected)
    {
        $selected = Weeks::where('id', $weekselected)->first();
        $this->week_name = $selected->week;
    }

    public function add()
    {
        $data =  $this->validate([
            'todos' => 'required',
        ]);

        $savedData2 = activity_in_site::create([
            'todos' => $this->todos,
            'site_in_weeks_id' => $this->site_in_weeks_id
        ]);

        $this->reset('todos');
        $this->individual = 1;
    }

    public function finish()
    {
        $this->reset();
        session()->flash('message', 'Plan Created.');
    }

    public function remove($id)
    {
        $item = activity_in_site::findorFail($id);
        $item->delete();
    }

    public function render()
    {
        if ($this->individual == 1) {
            return view('car.yearly-plan', [
                'Week_numbers' =>  Weeks::all(),
                'lists' =>  MonitoringActivity::all(),
                'individulActivities' => activity_in_site::where('site_in_weeks_id', '=', $this->site_in_weeks_id)->get(),
            ]);
        } else {
            return view('car.yearly-plan', [
                'Week_numbers' =>  Weeks::all(),
                'lists' =>  MonitoringActivity::all(),
            ]);
        }
    }
}
