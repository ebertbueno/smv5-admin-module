<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Menu;
use App\User;
use Modules\Petition\Entities\Category;
use Modules\Petition\Entities\Petition;
use Modules\Petition\Entities\Signature;
use Modules\Admin\Entities\Account;
use Input, Validator, Auth, Mail, Config;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // novas petições
        $featured = Petition::orderBy('id', 'desc')->take(10)->get();
        $petitions = Petition::has('signature','>' , 1000)->take(10)->get();
        $categories = Category::lists('name', 'id');
        //
        return View('site.index', compact('petitions', 'featured', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($id)
    {
        //
        $petitions = Petition::with('category')
                        ->where('title', 'like' , '%'.$id.'%' )
                        ->orWhere('tags', 'like', '%'.$id.'%')
                        ->orWhere('declaration', 'like', '% '.$id.' %')
                        ->get();
      
        return View('site.search', compact('petitions'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendContact()
    {
        //
        $input = Input::all();
        $validation = Validator::make($input, [
            '_token'=>'required'
        ]);
      
        if( $validation->passes() )
        { 
            Mail::send('emails.default', array(
              'title_lang' => trans('email.contact.title'),
              'message_lang' => trans('email.contact.message', [
                  'name' =>$input['name'],
                  'email'=>$input['email'],
                  'city' =>$input['city'],
                  'message'=>$input['message']
                ]),
            ), 
            function($message) use ($input)
            {
                $message->from( $input['email'], $input['name'] );
                $message->to( config('mail.from.address'), config('mail.from.name') )->subject( trans('email.contact.title') );
            });
          
            return redirect('contact')->withMessage( trans('layout.alert_success') );
        }
        
        return back()->withMessage( trans('layout.alert_error') );
    }

    
}
