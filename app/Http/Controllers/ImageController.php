<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Resources\Image as ImageResource;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Image::paginate(12);
        return ImageResource::collection($images);

    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $fileName = rand(1, 999) . $file->getClientOriginalName();
        $filePath ="uploads/images/" . date("Y") . '/' . date("m") . "/" . $fileName;
        $destinationPath=storage_path()."/app/public/uploads/images/" . date("Y") . '/' . date("m");
        
        $file->move($destinationPath, $fileName);

        //Store the Image 
        //return Imgae url
        $savedImage=Image :: create([
          'url' => $filePath

        ]);
          
         return response()->json([
             'Id' => $savedImage->id,
             'url' => $savedImage->url,
             'ext' =>$extension
]); 
        
    }

    public function delete($id,Request $request)
    {
        $image=Image::find($id);
        if($image !=null)
        {
           // delete the image 


           unlink(storage_path('app/public/'.$image->url));
           $image->delete();
          
           return response()->json([
             'message' => 'deleted' ]);

        }
        
    }
}
