<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        $settings=Home::find(1);
        $data=explode(',',$settings->description);
        //home page id
        //title of pages
        //title of portfolio items
        //title of blog
        if(sizeof($data)<4)
        {
            return response()->json([
                'result' => $data
            ]);
        }
        return response()->json([
            'result' => true,
            'home' => $data[0],
            'page' => $this->encode($data[1]),
            'portfolio' => $this->encode($data[2]),
            'blog' => $this->encode($data[3])
        ]);
    }
    public function update(Request $request)
    {
         $validator=Validator::make($request->all(),[
             'home' => 'required',
             'page' => 'required',
             'portfolio' => 'required',
             'blog' => 'required'
         ]);
         if($validator->fails())
         {
             return response()->json([
                 'result' => false
             ]);
         }
         
          
         $data=$request->home.","
         .$this->decode($request->page).','
         .$this->decode($request->portfolio).","
         .$this->decode($request->blog);
         
         
         $home=Home::find(1);
         $home->update([
             'description' => $data
         ]);
         return response()->json([
             'result' => true
         ]);  
    }
    public function decode($data)
    {
       if($data == "true")
       {
         return "1";
       }
       else if($data == "false")
       {
           return "0";
       }
    }
    public function encode($data)
    {
        if($data == "1")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
