<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Models\Type;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $reports = Report::withoutTrashed();

        if(!auth()->user()->is_admin){
            $reports = $reports->where('user_id', auth()->id());
        }

        $validator = Validator::make($request->all(), [
            'order' => ['nullable', 'string', 'in:asc,desc'],
            'sort' => ['nullable', 'string', 'in:id,description,status,created_at,updated_at'],
            'search' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        $validated = $validator->validated();

        if (isset($validated['search'])) {
            $reports = $reports
                ->where('status', 'LIKE', '%' . $validated['search'] . '%')
                ->orWhere('description', 'LIKE', '%' . $validated['search'] . '%');
        }

        if (isset($validated['sort'])) {
            $reports = $reports->orderBy($validated['sort'], $validated['order'] ?? 'asc');
        }

        $perPage = 100;
        $page = $request->get('page', 1);
        $reports = $reports->paginate($perPage, ['*'], 'page', $page);

        return $this->success(['reports'=>ReportResource::collection($reports)], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Report::class);
        }catch (\Exception $e){
            return $this->error('You are not authorized to create reports.', 403);
        }

        $validator = Validator::make($request->all(), [
            'type' => ['required', Rule::in(['POLISI', 'RUMAH SAKIT', 'PEMADAM KEBAKARAN'])],
            'description' => 'present',
            'image' => ['present', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10240'],
            'location'=> ['present','string'],
            'title'=> ['present','string'],
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 422);
        }

        $validated = $validator->validated();

        $validated['image_path'] = Storage::putFile('public/reports', $validated['image']);
        $validated['type_id'] = Type::where('name', $validated['type'])->first()->id;
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'PENDING';

        if ($report = Report::create($validated)) {
            return $this->success(['report'=>ReportResource::make($report)], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::withoutTrashed()->find($id);
        if(!$report){
            return $this->error('Not found', 404);
        }
        try {
            $this->authorize('view', $report);
        }catch (\Exception $e){
            return $this->error('You are not authorized to view this report.', 403);
        }
        return $this->success(['report'=>ReportResource::make($report)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Report::withoutTrashed()->find($id);
        if (!$report) {
            return $this->error('Not found', 404);
        }
        try {
            $this->authorize('update', $report);
        }catch (\Exception $e){
            return $this->error('You are not authorized to update this report.', 403);
        }
        $validator = Validator::make($request->all(), [
            'type' => ['filled', Rule::in(['POLISI', 'RUMAH SAKIT', 'PEMADAM KEBAKARAN'])],
            'description' => 'filled|string',
            'image' => ['filled', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10240'],
            'status' => [Rule::in(['PENDING', 'PROCESS', 'DONE'])],
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 422);
        }

        $validated_input = $validator->validated();
        if($validated_input['image']){
            if($report->image_path){
                Storage::delete($report->image_path);
            }
            $validated_input['image_path'] = Storage::putFile('public/reports', $validated_input['image']);
        }
        $validated = array_replace($report->toArray(), $validated_input);
        $validated['type_id'] = Type::where('name', $validated['type'])->first()->id;
        if ($report->update($validated)) {
            return $this->success(['report'=>ReportResource::make($report)], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::withoutTrashed()->find($id);
        if (!$report) {
            return $this->error('Not found', 404);
        }

        try {
            $this->authorize('delete', $report);
        }catch (\Exception $e){
            return $this->error('You are not authorized to delete this report.', 403);
        }

        $report->delete();
        return $this->success(null, 204);
    }
}
