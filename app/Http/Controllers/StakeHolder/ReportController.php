<?php

namespace App\Http\Controllers\StakeHolder;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\StakeHolder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::where('type_id',auth()->user()->stakeholder->type_id)->orderBy('status')->get();
        return view('stakeholder.reports.index',compact('reports'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        $this->authorize('view', $report);
        return view('stakeholder.reports.show',compact('report',));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::withoutTrashed()->findOrFail($id);
        $validatedData = $request->validate([
            'status' => 'required|in:DENIED,PROCESS,COMPLETED',
            'action' => 'string|max:255',
        ]);
        $validatedData['stakeholder_id'] = auth()->user()->stakeholder_id;
        $report->update($validatedData);
        return redirect()->route('stakeholder.reports.index')->with('toast_success','Report updated successfully');
    }

}
