<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StakeHolder;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StakeHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stakeHolders = StakeHolder::withoutTrashed()->with('type')->get();
        return view('admin.stakeholders.index', compact('stakeHolders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.stakeholders.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => ['required',Rule::in([1,2,3])],
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);
        $stakeHolder = StakeHolder::create($validated);
        return redirect()->route('admin.stakeholders.index')->with('toast_success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StakeHolder  $stakeHolder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stakeHolder = StakeHolder::findOrFail($id);
        $types = Type::all();
        return view('admin.stakeholders.edit',compact('stakeHolder','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StakeHolder  $stakeHolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StakeHolder $stakeHolder)
    {
        $validated = $request->validate([
            'type_id' => ['required',Rule::in([1,2,3])],
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);
        $stakeHolder->update($validated);
        return redirect()->route('admin.stakeholders.index')->with('toast_success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StakeHolder  $stakeHolder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stakeHolder = StakeHolder::findOrFail($id);
        $stakeHolder->delete();
        return redirect()->route('admin.stakeholders.index')->with('toast_success','Data berhasil dihapus');
    }
}
