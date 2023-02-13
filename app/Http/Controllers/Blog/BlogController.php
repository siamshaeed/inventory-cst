<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post, $option = null, $slug = null)
    {
        // search request
        $search = $request->search;

        // option means category or tag parameter pass from url
        $relation = ($option == 'category') ? 'categories' : 'tags';

        if(is_null($slug)){
            $posts = $post->with(['user', 'categories', 'tags'])
                ->where('status', true)
                ->Where('title', 'LIKE', "%{$search}%")
                ->orderByDesc('id')
                ->get();
        }else{
            $posts = $post->with(['user', 'categories', 'tags'])
                ->where('status', true)
                ->WhereRelation($relation, 'slug', $slug)
                ->Where('title', 'LIKE', "%{$search}%")
                ->orderByDesc('id')
                ->get();
        }
        //return $posts;


        $categories     = Category::withCount('posts')->where('status', true)->get();
        $tags           = Tag::with('posts')->where('status', true)->get();
        $recent_posts   = $post->where('status', true)->orderBy('id', 'desc')->limit(6)->get();

        $route_name = Route::current()->getName();
        return view('frontend.blog.post.index', compact('posts', 'categories', 'tags', 'recent_posts', 'route_name'));
    }

    /**
     * Details Blog Post View
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function details($slug, Post $post)
    {
        $post = $post->with([
            'user', 'categories', 'tags',
            'comments' => function($query){
                $query->with('user');
            }])
            ->whereSlug($slug)
            ->withCount('comments')
            ->first();
        //return $post;

        $categories     = Category::withCount('posts')->where('status', true)->get();
        $tags           = Tag::with('posts')->where('status', true)->get();
        $recent_posts   = $post->where('status', true)->orderBy('id', 'desc')->limit(6)->get();

        $route_name = Route::current()->getName();
        return view('frontend.blog.post.index', compact('post', 'categories', 'tags', 'recent_posts', 'route_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comment $comment)
    {
        //dd($request->all());

        if(!isset(auth()->user()->id)){
            notify()->warning("Please, Login First to Comment !", "Warning");
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'post_id'   => 'required',
            'comment'   => 'required|min:2',
        ]);

        if($validator->fails()){
            notify()->warning("Please, Write Your Comment !", "warning");
            return redirect()->back();
            /*return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);*/
        }else{
            //--data save
            $comment->post_id   = $request->post_id;
            $comment->user_id   = auth()->user()->id;
            $comment->text      = $request->comment;
            $comment->save();

            notify()->success("Comment Posted", "Success");
            return redirect()->back();

            /*return response()->json([
                'status ' => 200,
                'success' => 'Successfully Comment Posted',
            ]);*/
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
