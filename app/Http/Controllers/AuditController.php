<?php

namespace App\Http\Controllers;

use App\Models\activity_in_site;
use App\Models\Audits;
use App\Models\Checklist;
use App\Models\Image;
use App\Models\Response;
use App\Models\User;
use App\Models\WeeklyPlan;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function taskresponse(Request $request)
    {

        $userPlan = WeeklyPlan::where('id', '=', $request->selected)->first();

        $userPlan->update(['inspected' => 'yes', 'findings' => $request->finding]);
        if (in_array('not conforming', $request->state, true)) {
            $userPlan->update(['findings' => 'not conforming']);
        } else {
            $userPlan->update(['findings' => 'conforming', 'task_completed' => true]);
        }

        foreach ($request->title as $key => $title) {
            $taskresponse = Checklist::create([
                'weekly_plans_id' => $request->selected, 'title' => $title,
                'checkbox' => $request->checkbox[$key], 'comment' => $request->comment[$key], 'state' => $request->state[$key]
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
        abort_unless($nonConformance->status == 'pending' || $nonConformance->status == 'HOD declined', 403, 'NOT ALLOWED TO EDIT');

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
        $nonConformance->update(['auditee' => $auditee,  'status' => 'pending']);

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

    public function Forestry()
    {

        $Selectedsite = 'Forestry';
        return view('car.HOD_Response', compact('Selectedsite'));
    }


    public function Operations()
    {

        $Selectedsite = 'Operations';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function HR()
    {

        $Selectedsite = 'HR';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function IT()
    {

        $Selectedsite = 'IT';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function Communications()
    {

        $Selectedsite = 'Communications';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function Miti_Magazine()
    {

        $Selectedsite = 'Miti Magazine';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function Accounts()
    {

        $Selectedsite = 'Accounts';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function ME()
    {

        $Selectedsite = 'ME';
        return view('car.HOD_Response', compact('Selectedsite'));
    }

    public function followUp()
    {
        return view('car.follow');
    }

    public function file($id)
    {
        $image = Image::find($id);
        $filename = $image->file;
        $path = storage_path('app/public/images/' . $filename);
        return response()->file($path);
    }
}
