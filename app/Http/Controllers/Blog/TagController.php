<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\isEmpty;
use function React\Promise\Stream\first;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$tags = Tag::with('posts')->orderByDesc('id')->get();
        //return $tags;
        if ($request->ajax()) {
            $tags = Tag::with('posts')->orderByDesc('id')->get();
            return Datatables::of($tags)
                ->addIndexColumn()

                ->addColumn('define_times', function ($row) {
                    // Tag use: How many times used into Post Section
                    return $row->posts->count();
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'tags';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'tag';
                    $details    = false;
                    return view('common.action_btn', compact(['id', 'module', 'details', 'user_name', 'row']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('blog.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|min:3|max:100',
        ]);

        $data = new Tag();
        $data->name         = $request->name;
        $data->description  = $request->description;
        $data->slug         = Str::slug($request->name);
        $data->status       = ($request->status == 'on') ? 1 : 0;
        $data->save();

        notify()->success("Tag Created Successfully", "Success");
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('blog.tag.edit', compact('tag'));
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
        $request->validate([
            'name' => 'required|unique:tags,name,'.$id.'|min:3|max:100',
        ]);

        $data = Tag::findOrFail($id);
        $data->name         = $request->name;
        $data->description  = $request->description;
        $data->slug         = Str::slug($request->name);
        $data->status       = ($request->status == 'on') ? 1 : 0;
        $data->save();

        notify()->success("Tag Updated Successfully", "Success");
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Tag::with('posts')->findOrFail($id);

        // Tag not deleted, When use into another post section
        if(!$deleted->posts->isEmpty()){
            notify()->warning("Already Use into Post Section", "warning");
            return back();
        }

        // Tag deleted
        if($deleted){
            $deleted->delete();
            notify()->success("Tag Deleted Successfully", "success");
        }else{
            notify()->warning("Tag Not Deleted", "warning");
        }

        return back();
    }
}
