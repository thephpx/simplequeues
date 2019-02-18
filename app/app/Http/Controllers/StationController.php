<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Station;

class StationController extends Controller
{
    public function index()
    {
        return 'Station API: '.rand();
    }

    public function create(Request $request)
    {
        $outcome = false;
        $response = [];

        $input = $request->all();

        try{
            $station = new Station;

            if(!empty($station)){
                foreach($input as $key => $value)
                {
                    $station->{$key} = $value;
                }

                $outcome = (bool) $station->save();
                $response = $station->toArray();
            }

        } catch(ErrorException $e){
            $outcome = false;
        } 

        return Response()->json(['status'=>$outcome, 'response'=>$response]);
    }

    public function read($id=null)
    {
        $outcome = false;
        $response = array();

        try{
            $station = Station::find($id);

            if(!empty($station->id)){
                $outcome = (bool) $station;
                $response = $station->toArray();    
            }        
        } catch(ErrorException $e){
            $outcome = false;
        } 

        return Response()->json(['status'=>$outcome, 'response'=>$response]);
    }

    public function update($id=null, Request $request)
    {
        $outcome = false;

        $input = $request->all();

        try{
            $station = Station::find($id);

            if(!empty($station->id)){
                foreach($input as $key => $value)
                {
                    $station->{$key} = $value;
                }

                $outcome = $station->save();
            } 

        } catch(ErrorException $e){
            $outcome = false;
        } 

        return Response()->json(['status'=>$outcome]);
    }

    public function delete($id=null)
    {
        $outcome = false;

        try{

            $station = Station::find($id);

            if(!empty($station->id)){
                $station->status = 'deleted';
                $outcome = $station->save();
            }       

        } catch(ErrorException $e){
            $outcome = false;
        }        

        return Response()->json(['status'=>$outcome]);
    }
}