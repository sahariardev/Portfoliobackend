<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Http\Resources\Gallery as GalleryResource;
use Validator;
class SliderController extends Controller
{
    public function index()
    {
        //show all
        $galleries=Gallery::paginate(12);
        return GalleryResource::collection($galleries);

    }
    public function slider($id)
    {
        $gallery=Gallery::find($id);
          if($gallery != null)
          {
            return new GalleryResource($gallery);
          }

    }
    public function store(Request $request)
    {

        
        $validate = Validator::make($request->all(), [
            'images' => 'required',
            'details' => 'required',
        ]);
      
        if(!$validate->fails())
        {
            if($request->id ==null)
            {
           
                $gallery=Gallery::create([
                    'images'=>$request->images,
                    'details' => $request->details
                ]);

                return response()->json([
                'id' => $gallery->id,
                'message' => 'success'
                ]);
            }
            else
            {
                $gallery=Gallery::find($request->id);
                $gallery->update([
                    'images'=>$request->images,
                    'details' => $request->details
                ]);

                return response()->json([
                'id' => $gallery->id,
                'message' => 'success'
                ]);

            }

        }
        else
        {
           return response()->json([
           
            'message' => 'Failed'
        ]);

        }
      }

      public function delete($id,Request $request)
      {
          $gallery=Gallery::find($id);
          if($gallery != null)
          {

            $gallery->delete();  

           return response()->json([
           'message' => 'deleted' ]);

          }

           
      }
}
