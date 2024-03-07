<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;
use Toastr;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('index', Job::class)) {
            abort(403, 'Unauthorized action.');
        }
        if(auth()->user()->role === 'admin'){
            $jobs = Job::all();
        } else {
            $jobs = Job::where('user_id', auth()->user()->id)->get();
        }
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create', Job::class)) {
            abort(403, 'Unauthorized action.');
        }
        // if (!auth()->user()->can('jobs.create')) {
        //     dd('hi', auth()->user(), auth()->user()->can('jobs.create'));
        //     abort(403, 'Unauthorized action.');
        // }
        $job = new Job();
        $tags = Tag::all();
        return view('jobs.create', compact('job', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        if (!auth()->user()->can('store', Job::class)) {
            abort(403, 'Unauthorized action.');
        }

        try{
            $input = $request->only('title', 'post', 'description', 'ends_at', 'website', 'status', 'salary_min', 'salary_max', 'link', 'vacancy');
            $input['user_id'] = auth()->user()->id;
            DB::beginTransaction();
            $job = Job::create($input);

            $tags = $request->tags;
            $existingTags = Tag::whereIn('name', $tags)->pluck('name')->toArray();
            $newTags = array_diff($tags, $existingTags);
            $tagData = [];
            foreach ($newTags as $tagName) {
                $tagData[] = ['name' => $tagName];
            }
            if (!empty($tagData)) {
                Tag::insert($tagData);
            }
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $job->tags()->attach($tagIds);

            // Toastr::success('Job created successfully','Success');
            DB::commit();
            return redirect()->route('jobs.index');
        }catch (Exception $ex){
            DB::rollBack();
            // Toastr::warning('Job Create Failed');
            return redirect()->back()->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$ex->getMessage()]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        if (!auth()->user()->can('view', $job)) {
            abort(403, 'Unauthorized action.');
        }
        $selectedTags = $job->tags->pluck('name')->toArray();

        return view('jobs.view', compact('job', 'selectedTags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        if (!auth()->user()->can('update', $job)) {
            abort(403, 'Unauthorized action.');
        }

        $job = Job::find($id);
        // $tags = Tag::all();
        $tags = Tag::pluck('name')->toArray();
        $selectedTags = $job->tags->pluck('name')->toArray();
        return view('jobs.edit', compact('job', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        $job = Job::find($id);
        if (!auth()->user()->can('update', $job)) {
            abort(403, 'Unauthorized action.');
        }

        try{
            $input = $request->only('title', 'post', 'description', 'ends_at', 'website', 'status', 'salary_min', 'salary_max', 'link', 'vacancy');
            $input['user_id'] = auth()->user()->id;
            DB::beginTransaction();
            $job->update($input);

            $tags = $request->tags;
            $existingTags = Tag::whereIn('name', $tags)->pluck('name')->toArray();
            $newTags = array_diff($tags, $existingTags);
            $tagData = [];
            foreach ($newTags as $tagName) {
                $tagData[] = ['name' => $tagName];
            }
            if (!empty($tagData)) {
                Tag::insert($tagData);
            }
            $tagIds = Tag::whereIn('name', $tags)->pluck('id')->toArray();
            $job->tags()->sync($tagIds);

            // Toastr::success('Job updated successfully','Success');
            DB::commit();
            return redirect()->route('jobs.index');
        }catch (Exception $ex){
            DB::rollBack();
            // Toastr::warning('Job Update Failed');
            return redirect()->back()->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$ex->getMessage()]));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
        $job = Job::find($id);
        if (!auth()->user()->can('delete', $job)) {
            abort(403, 'Unauthorized action.');
        }

        $job = Job::find($id);
        $job->tags()->detach();
        $job->delete();
        Toastr::success('Job deleted successfully','Success');
        return [
            'msg' => 'success'
        ];
    }


    public function delete($id)
    {
        $job = Job::find($id);
        if (!auth()->user()->can('delete', $job)) {
            abort(403, 'Unauthorized action.');
        }

        try{
            DB::beginTransaction();
            // dd($jobs);
            $job->tags()->detach();
            $job->delete();
            // Toastr::success('Job deleted successfully','Success');
            DB::commit();
            return [
                'msg' => 'success'
            ];
            // return redirect()->route('jobs.index');
        }catch (Exception $ex){
            DB::rollBack();
            // Toastr::warning('Job Update Failed');
            return redirect()->back()->withErrors(new \Illuminate\Support\MessageBag(['catch_exception'=>$ex->getMessage()]));
        }
    }


    public function viewActiveJobs() 
    {
        $jobs = Job::where('status', '=', 'active')->get();
        return view('jobs.index', compact('jobs'));
    }
}
