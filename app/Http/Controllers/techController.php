<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Technology as TechResource; 
use App\Technology;
use Validator;

class techController extends Controller
{
    public function index()
    {
        $technologies=Technology::paginate(12);
        return TechResource::collection($technologies);

    }

    public function getOne($id)
    {
        $technology=Technology::find($id);
        if($technology != null)
        {
           return new TechResource($technology);
        }
    }
    public function store(Request $request)
    {

        
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'detail' => 'required',
        ]);
      
        if(!$validate->fails())
        {
            if($request->id ==null)
            {
           
                $technology=Technology::create([
                    'title'=>$request->title,
                    'detail' => $request->detail
                ]);

                return response()->json([
                'id' => $technology->id,
                'message' => 'success'
                ]);
            }
            else
            {
                $technology=Technology::find($request->id);
                $technology->update([
                    'title'=>$request->title,
                    'detail' => $request->detail
                ]);

                return response()->json([
                'id' => $technology->id,
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
          $tech=Technology::find($id);
          if($tech != null)
          {

            $tech->delete();  

           return response()->json([
           'message' => 'deleted' ]);

          }

           
      }

}
