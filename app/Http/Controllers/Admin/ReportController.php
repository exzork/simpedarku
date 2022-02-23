<?php

namespace App\Http\Controllers\Admin;

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
        $reports = Report::withoutTrashed()->with(['user','type'])->orderBy('status')->get();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::withoutTrashed()->findOrFail($id);
        $stakeHolders = StakeHolder::withoutTrashed()->where('type_id', $report->type_id)->get();
        return view('admin.reports.show', compact('report','stakeHolders'));
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
            'stakeholder_id' => 'required|exists:stake_holders,id',
        ]);
        $report->update($validatedData);
        return redirect()->route('admin.reports.index')->with('toast_success', 'Report updated successfully');
    }
}
