<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Gallery;
use App\Http\Resources\Portfolio as PortfolioResource;
use App\Technology;

use Validator;
class portfolioController extends Controller
{
    


    public function index()
    {
        
        $portfolios=Portfolio::paginate(12);
        return PortfolioResource::collection($portfolios);
        

    }
    public function portfolio($id)
    {
        $portfolio=Portfolio::find($id);
          if($portfolio != null)
          {
            return new PortfolioResource($portfolio);
          }

    }
    public function store(Request $request)
    {

        
        $validate = Validator::make($request->all(), [
            
            'title' => 'required',
            'order' => 'numeric',
            'gallery_id' => 'numeric',
            'type' => 'numeric'
        ]);
      
        if(!$validate->fails())
        {
            $gallery=Gallery::find($request->gallery_id);
                
                if($gallery==null)
                {
                    $gallery_id=null;

                }
                else
                {
                    
                    $gallery_id=$gallery->id;
                }

            if($request->id ==null)
            {
                
           
                $portfolio=Portfolio::create([
                    'title'=>$request->title,
                    'order' => $request->order,
                    'video_link' => $request->video_link,
                    'details' => $request->details,
                    'type' => $request->type,
                    'coverImage_link' => $request->coverImage_link,
                    'detailImage_link' => $request->detailImage_link,
                    'gallery_id' => $gallery_id
                ]);

                //attaching the technology
                $tech=explode(",",$request->technologies);
                for($c=0;$c<sizeof($tech);$c++)
                {
                    $tech=Technology::find($tech[$c]);
                    if($tech != null)
                    {
                        $portfolio->technologies()->attach($tech->id);
                    } 
                }


                return response()->json([
                'id' => $portfolio->id,
                'message' => 'success'
                ]);
            }
            else
            {
                $portfolio=Portfolio::find($request->id);
                $portfolio->update([
                    'title'=>$request->title,
                    'order' => $request->order,
                    'video_link' => $request->video_link,
                    'details' => $request->details,
                    'type' => $request->type,
                    'coverImage_link' => $request->coverImage_link,
                    'detailImage_link' => $request->detailImage_link,
                    'gallery_id' => $gallery_id
                ]);
                $portfolio->technologies()->detach();
                 
                $tech=explode(",",$request->technologies);
                for($c=0;$c<sizeof($tech);$c++)
                {
                    $tech=Technology::find($tech[$c]);
                    if($tech != null)
                    {
                        $portfolio->technologies()->attach($tech->id);
                    } 
                }

                return response()->json([
                'id' => $portfolio->id,
                'message' => 'success'
                ]);

            }

        }
        else
        {
            
           return response()->json([
             'id' => 'failed',
            'message' => 'Failed'
        ]);

        }
      }

      public function delete($id,Request $request)
      {
          $portfolio=Portfolio::find($id);
          if($portfolio != null)
          {

            $portfolio->delete();  

           return response()->json([
           'message' => 'deleted' ]);

          }

           
      }


}
