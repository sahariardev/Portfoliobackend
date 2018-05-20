<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Slot;
use App\Schedule;
use  App\Http\Resources\Slot as SlotResource;
use Validator;
use App\Mail\mymail;
use App\Mail\AppointmentRequest;
class AppointmentController extends Controller
{
  
  public function isAvailable($slots,$date)
  {
      $slots=explode(",",$slots);
      for($c=0;$c<sizeof($slots);$c++)
      {
          $s= Slot::whereHas('Schedule',function($query) use ($date){
                  $query->where('date',$date);  
          })->where('points',$slots[$c])->get();
          if(sizeof($s)!=0 || $slots[$c]<0 || $slots[$c]>47)
          {
              return false;
          }
      }
      return true;
  }
    public function appointments(Request $request )
    {
        
          $date = $request->date; 
          $slots= Slot::whereHas('Schedule',function($query) use ($date){
                  $query->where('date',$date);  
          })->get();
          
          return SlotResource::collection($slots);
    }
     public function store(Request $request)
     {

                 $validate=Validator::make($request->all(),[
                        'date' => 'required|date',
                        'slot'  =>'required',
                        'detail'=> 'required|max:200',
                        'email' => 'required'

                ]);

                    if(!$validate->fails())
                    {
                        
                        //first check is slot available or not 
                        //store them in the database
                    $date = $request->date;
                    
                    
                    if($this->isAvailable($request->slot,$date))
                    
                    {
                        
                        $schedule=Schedule::create([

                            'date'   => $date,
                            'email'  => $request->email,
                            'name'   => $request->name,
                            'detail' =>$request->detail,
                            'status' => $request->status
                            
                        ]);
                
                        $slots=explode(",",$request->slot);
                        for($c=0;$c<sizeof($slots);$c++)
                        {
                            $slot= Slot::whereHas('Schedule',function($query) use ($date){
                            $query->where('date',$date);  
                            })->where('points',$slots[$c])->get();

                            if(sizeof($slot)==0 && $slots[$c]>=0 && $slots[$c]<=47)
                            {
                                //save it
                                $oneSlot=Slot::create([
                                    'schedule_id' =>$schedule->id,
                                    'points' => $slots[$c]
                                ]);

                            }  
                        }
                        
                        //return success messgage
                        Mail::to(env('USER_MAIL_ADDR'),'rifatsahariar@gmail.com')
                             ->send(new AppointmentRequest($schedule->email));

                        return response()->json([
                            'created' => true,
                            'id' => $schedule->id
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'created' => "La La la",
                            
                        ]);
                    }
                    
                }
                else
                {
                    return response()->json([
                            'created' => false,
                            
                        ]);
                }

            
            }

        public function confirm($id,Request $request)
        {
            
           $schedule=Schedule::find($id);
           if($schedule!=null)
           {
            $schedule->update([
                'status' => 1
            ]);

           
           Mail::to($schedule->email)
                   ->send(new mymail('Confirmed'));

            return response()->json([
                'confirmed' => true
            ]);
           }
           else
           {
               return response()->json([
                'confirmed' => false
            ]);
           }
           //send mail to the user

           

        }
        public function delete($id, Request $request)
        {
            $schedule=Schedule::find($id);
            //send mail before deleting it;
            if($schedule !=null)
            {
                Slot::where('schedule_id',$id)->delete();
                $schedule->delete();
                return response()->json([
                'deleted' => true
            ]);
            }
            else
            {
                return response()->json([
                'deleted' => false
            ]);
            }  

            //send mail to the user
            


        }     
}
