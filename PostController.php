<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function dump;
use function optional;
use function view;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }




    public function postBlock(Request $request, $postId )   ///$request= "select  * from `posts` where `posts`.`post_id` = $postId limit 1";
    {

        $post = Post::findOrFail($postId);


        if (!$post) {
            return 'Post is not found';
        }

        $userAdmin = Auth::user();

        if (!$userAdmin || !$userAdmin->getIsAdmin()) {
            return 'Not authorised';
            
        }

        $post->setIsBlocked(1);
        $post->save();



        return 'Post is blocked';
    }

}
