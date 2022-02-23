<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StakeHolder;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $stakeHolders = StakeHolder::withoutTrashed()->get();
        return view('admin.users.show', compact('user','stakeHolders'));
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
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'stakeholder_id' => 'integer|nullable|exists:stake_holders,id',
        ]);
        $validatedData['is_admin'] = $request->has('is_admin') ?? 0;
        $validatedData['is_stakeholder'] = $validatedData['stakeholder_id'] ?? 0;
        $user->update($validatedData);
        return redirect()->route('admin.users.show', $user->id)->with('toast_success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('toast_success', 'User deleted successfully');
    }
}
