<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use function dump;
use function optional;
use function view;





class CreaterPostController extends Controller
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


    public function AddPost(Request $request, $userId)
    {
        

         $rules  = [
            'heading' => 'required|string|max:255|nullable',
            'form_content' => 'required|string|max:8192|nullable'
         ];
         
         ///////////////////////////////////////////////////////////////////
         $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return 

            "<div class='alert alert-danger'>
             <p> Неверно заполнены поля </p>
             </div>";
        } 
        else 
        {
            $validateDat = $request->all();
            $mytime =Carbon::now()->toDateTimeString();
         
         $newPost = new Post;
         $newPost->setIsBlocked(0);
         $newPost->setIsDollar(0);
         $newPost->setIsRouble(0);
         $newPost->setIsUah(0);
         $newPost->setIsEuro(0);
         $newPost->setUserPosterId($userId);
         $newPost->setCreatedAt($mytime);
         $newPost->setContent($validateDat['form_content']);
         $newPost->setTitle($validateDat['heading']);
         $newPost->save();
         return  "Объявление успешно добавлено";

        }
        //////////////////////////////////////////////////////////////////////


         //return 'объявление добавлено';
    }
}
?>