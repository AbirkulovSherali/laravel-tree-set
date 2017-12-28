<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Posts;
use App\Models\Comments;

class PostsController extends Controller
{
    public function __construct(){
        View::share('link', 'posts');
    }

    public function list(Request $request){
        $posts = Posts::all()->toArray();

        if($request->isMethod('post')){

            $this->validate($request, [
                'title' => 'required|unique:posts',
                'body' => 'required'
            ], [
                'title.required' => 'Это поле должно быть заполнено!',
                'title.unique' => 'Заголовок не должен повторяться в базе!',
                'body.required' => 'Это поле должно быть заполнено!'
            ]);

            Posts::create([
                'title' => $request->title,
                'body' => $request->body
            ]);

            return redirect('/posts');
        }

        return view('posts/list', [
            'posts' => $posts
        ]);
    }

    public function view(Request $request, $id){
        $post = Posts::find($id);
        $comments = Comments::where(['post_id' => $id])->withDepth()->with(['user:id,name'])->get()->toTree();

        if($request->isMethod('post')){
            if($request->reply) {
                $this->validate($request, [
                    'reply.user_id' => 'required',
                    'reply.text' => 'required',
                    'reply.post_id' => 'required',
                    'reply.parent_id' => 'required'
                ]);

                Comments::create([
                    'user_id' => $request->reply['user_id'],
                    'text' => $request->reply['text'],
                    'post_id' => $request->reply['post_id'],
                    'parent_id' => $request->reply['parent_id']
                ]);

                return redirect("/post/{$request->reply['post_id']}");
            } else {
                $this->validate($request, [
                    'user_id' => 'required',
                    'text' => 'required',
                    'post_id' => 'required',
                ]);

                Comments::create([
                    'user_id' => $request->user_id,
                    'text' => $request->text,
                    'post_id' => $request->post_id,
                    'parent_id' => $request->parent_id
                ]);

                return redirect("/post/{$request->post_id}");
            }
        }

        return view('posts/view', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

}
