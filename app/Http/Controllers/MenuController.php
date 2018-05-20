<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Http\Resources\Menu as MenuResource;
use Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus=Menu::paginate(20);
        return MenuResource::collection($menus);
    }
    public function one($id)
    {
        $menu=Menu::find($id);
        return new MenuResource($menu); 
    }
    public function store(Request $request)
    {
        
        $validate=Validator::make($request->all(),[
            'title' => 'required|max:15',
            'link' => 'required'
        ]);

        if($validate->fails())
        {
            return response()->json([
                'result' => false,
                'message' => 'validation failed'
            ]);
        }
        
        $parent_id=null;
        $order=100;
       if($request->parent_id !="null")
       {
           
          $parent_id = $request->parent_id;
       }
       if($request->order !="null")
       {
           $order=$request->order;
       } 
       
        if($request->id ==null)
        {
           $menu=Menu::create([
              'title' => $request->title,
              'parent_id' => $parent_id,
              'link' => $request->link,
              'order' => $order
           ]);
           return response()->json([
               'result' => true,
               'id' => $menu->id
           ]);
        }
        else
        {
          //update
          $menu=Menu::find($request->id);
          if($menu)
          {
            $menu->update([

              'title' => $request->title,
              'parent_id' => $parent_id,
              'link' => $request->link,
              'order' => $order
          ]);
          return response()->json([
               'result' => true,
               'id' => $menu->id
           ]);
          }
          else
          {
              return response()->json([
                'result' => false
            ]);
          }
          
        }



    }
    public function delete(Request $request,$id)
    {
        //delete the menu Item

        $menu=Menu::find($id);
        if($menu)
        {
            $menu->delete();
        }
               
         return response()->json([
             'result' => true,
             'message' => 'stay happy'
         ]);

    }
}
