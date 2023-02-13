<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Carbon\Carbon;
use Illuminate\Cache\TagSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $posts = Post::orderByDesc('id')->get();
        if ($request->ajax()) {
            $posts = Post::orderByDesc('id')->get();
            return Datatables::of($posts)
                ->addIndexColumn()

                // image column
                ->addColumn('define_image', function ($row) {
                    $image = asset('storage/posts/'.$row->image);
                    return view('blog.post.post_image', compact(['image']));
                })

                // title, add link
                ->addColumn('define_title', function ($row) {
                    $title  = $row->title;
                    $slug   = $row->slug;
                    return view('blog.post.post_title', compact('title', 'slug'));
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'posts';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('define_user_name', function ($row) {
                    return auth()->user($row->user_id)->name;
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    $id         = $row->id;
                    $user_name  = 'ddd';
                    $module     = 'post';
                    $details    = false;
                    return view('common.action_btn_post', compact(['id', 'module', 'details', 'user_name', 'row']));
                })

                ->rawColumns(['action'])
                ->toJson();
        }

        return view('blog.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', true)->get();
        $tags       = Tag::where('status', true)->get();
        return view('blog.post.create', compact('categories', 'tags'));
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
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'         => 'required|unique:posts|min:3|max:250',
            'category_id'   => 'required',
            'tag_id'        => 'required',
        ]);

        $post = new Post();
        $post->user_id      = auth()->user()->id;
        $post->title        = $request->title;
        $post->short_desc   = $request->short_desc;
        $post->long_desc    = $request->long_desc;
        $post->slug         = Str::slug($request->title);

        if($request->has('image')){
            $image      = $request->image;
            $image_name = time().'.'.$image->extension();
            $image->storeAs('posts', $image_name);
            $post->image = $image_name;
        }

        $post->status       = ($request->status == 'on') ? 1 : 0;
        $post->save();

        // category id attach into pivot table
        $category = Category::find($request->category_id);
        $post->categories()->attach($category);

        // tag id attach into pivot table
        $tags = Tag::find($request->tag_id);
        $post->tags()->attach($tags);

        notify()->success("Post Created Successfully", "Success");
        return redirect()->route('post.index');
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
        $post       = Post::with('categories', 'tags')->findOrFail($id);
        $categories = Category::where('status', true)->get();
        $tags       = Tag::where('status', true)->get();
        return view('blog.post.edit', compact('post', 'categories', 'tags'));
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
            'title'         => 'required|unique:posts,title,'.$id.'|min:3|max:250',
            'category_id'   => 'required',
            'tag_id'        => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->user_id      = auth()->user()->id;
        $post->title        = $request->title;
        $post->short_desc   = $request->short_desc;
        $post->long_desc    = $request->long_desc;
        $post->slug         = Str::slug($request->title);

        if($request->has('image')){
            // delete previous image from Storage Directory
            if($post->image != "blank_post_image.jpg"){
                Storage::delete('posts/'.$post->image);
            }

            // insert new image into Storage Directory
            $image      = $request->image;
            $image_name = time().'.'.$image->extension();
            $image->storeAs('posts', $image_name);
            $post->image = $image_name;
        }

        $post->status       = ($request->status == 'on') ? 1 : 0;
        $post->save();


        // category detach or delete previous category for this post
        $post->categories()->detach($post->categories);
        // tag detach or delete previous tag for this post
        $post->tags()->detach($post->tags);


        // category id attach or save into this post
        $category = Category::find($request->category_id);
        $post->categories()->attach($category);

        // tag id attach or save into this post
        $tags = Tag::find($request->tag_id);
        $post->tags()->attach($tags);

        notify()->success("Post Updated Successfully", "Success");
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Post::findOrFail($id);
        if($deleted){

            // category id detach from pivot table
            $category = Category::find([3,4]);
            $deleted->categories()->detach($category);

            // tag id detach from pivot table
            $tags = Tag::find([1,2]);
            $deleted->tags()->detach($tags);

            $deleted->delete();
            notify()->success("Deleted Successfully", "success");
        }else{
            notify()->warning("Data Not Deleted", "warning");
        }

        return back();
    }
}
