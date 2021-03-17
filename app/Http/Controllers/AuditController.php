<?php

namespace App\Http\Controllers;

use App\Models\activity_in_site;
use App\Models\Audits;
use App\Models\Checklist;
use App\Models\Response;
use App\Models\User;
use App\Models\WeeklyPlan;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function taskresponse(Request $request)
    {
        $request->validate([
            'finding' => 'required'
        ]);

        $userPlan = WeeklyPlan::where('id', '=', $request->selected)->first();

        $userPlan->update(['inspected' => 'yes', 'findings' => $request->finding]);
        if ($request->finding == 'conforming') {
            $userPlan->update(['task_completed' => true]);
        } else {
            $userPlan->update(['task_completed' => false]);
        }

        foreach ($request->title as $key => $title) {
            $taskresponse = Checklist::create([
                'weekly_plans_id' => $request->selected, 'title' => $title,
                'checkbox' => $request->checkbox[$key], 'comment' => $request->comment[$key]
            ]);
        }

        $site_activity = activity_in_site::where('id', '=', $userPlan->activity_in_sites_id);
        $site_activity->update(['checked' => true]);

        return back()->with('message', 'Task Completed');
    }

    public function nonconformance($id)
    {
        $selectedTask = $id;
        return view('car.newNonconformance', compact('selectedTask'));
    }

    public function edit($id)
    {
        $nonConformance = Audits::findOrFail($id);
        $users = User::all();
        return view('car.edit', compact('nonConformance', 'users'));
    }

    public function update(Request $request, Audits $nonConformance)
    {
        abort_unless($nonConformance->status == 'pending', 403,'NOT ALLOWED TO EDIT');

        $data = $request->validate([
            'response_id' => 'required',
            'site' => 'required',
            'department' => 'required',
            'clause' => 'required',
            'checkbox' => 'required',
            'report' => 'required',
        ]);

        $updating = $nonConformance->update($data);
        $auditee = User::findOrFail($request->response_id)->name;
        $nonConformance->update(['auditee' => $auditee]);

        if ($request->solutionId) {
            foreach ($request->solutionId as $key => $solutionId) {
                $solution = Response::findorFail($solutionId);
                $solution->update([
                    'cause' => $request->cause[$key], 'proposed_solution' => $request->proposed_solution[$key],
                    'proposed_date' => $request->proposed_date[$key]
                ]);
            }
        }

        return redirect('/Auditee-Response')->with('message', 'Updated');
    }
}
