<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{

    public function __construct()
    {
        // in case not logged-in user trying to create or edit (unauthenticated)
        $this->middleware("auth")->except(['show', 'homepage']);
    }

    public function homepage(Request $req) {
        $posts = Post::all();
        if($req->has("search_keyword"))
        {
            $pattern = $req->get("search_keyword");

            // searching for matched (username || category || title || body)
            $matched_posts = Post::whereHas("User", fn($query) => $query->where("name", "LIKE", "%$pattern%"))->
            orwhereHas("Categories", fn($query) => $query->where("category", "LIKE", "%$pattern%"))->
            orWhere("title", "LIKE", "%$pattern%")->
            orWhere("body", "LIKE", "%$pattern%")->
            get();

            $posts = $matched_posts;
        }
        return view('homepage')->with("posts", $posts);
    }

    public function show(int $post_id) {
        $post = Post::find($post_id);
        return (!$post) ? 
        redirect("/")->with("message", "The post you are trying to access doesn't exist!") : 
        view("posts.post")->with("passedPost", $post);
    }

    public function userPosts() {
        // no need to check if there is a current logged-in user
        // as the middleware does
        $user_id = Auth::id();
        $posts = Post::where('user_id', $user_id)->get();
        return view('posts.myposts')->with("posts", $posts);
    }

    public function create(Request $req) {
        $post = $req->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
            'body' => 'required'
        ],[
            'image.max' => 'The image must not be greater than 2 mb.'
        ]);
        $post["user_id"] = Auth::id();

        // generating unique img name to avoid overlapping of similar img names
        $newImgName = time() . '-' . Auth::user()["email"] . '.' . $req->image->extension();
        $newImgPath = $req->image->move(public_path('uploads'), $newImgName);

        $post["image"] = $newImgName;
        Post::create($post);
        return redirect('/')->with("message", "Post Created Successfully.");
    }

    public function edit(Request $req) {
        $post_exist = Post::find($req->post_id);
        if(!$post_exist)
            return redirect("/")->with("message", "The post you are trying to access doesn't exist!");
        // in case user changed post_id input form to another post id he doesn't own
        if($post_exist->user_id != Auth::id())
            return abort(403); // Forbidden
        
        $post = $req->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'mimes:jpg,png,jpeg|max:2048',
            'body' => 'required'
        ],[
            'image.max' => 'The image must not be greater than 2 mb.'
        ]);
        $img = $post_exist->image;
        // if user entered an image input
        if($req->image)
        {
            $img = time() . '-' . Auth::user()["email"] . '.' . $req->image->extension();
            $newImgPath = $req->image->move(public_path('uploads'), $img);
        }
        $post_exist->update([
            'title' => $req->title,
            'image' => $img,
            'body' => $req->body,
            'updated_at' => now()
        ]);
        return redirect('post/'.$req->post_id)->with("message", "Post updated successfully.");
    }

    public function delete(Request $req) {
        $post = Post::find($req->post_id);
        if(!$post)
            return redirect("/")->with("message", "The post you are trying to access doesn't exist!");
        // in case user changed post_id input form to another post id he doesn't own
        if($post->user_id != Auth::id())
            return abort(403); // Forbidden
        $post->delete();
        return redirect('/')->with("message", "Post deleted successfully.");
    }
}
