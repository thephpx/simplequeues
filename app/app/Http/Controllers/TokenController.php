<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Token;
use App\Models\Station;

class TokenController extends Controller
{
    public function index()
    {
        return 'Token API: '.rand();
    }

    public function cors(){
        return Response('OK',200);
    }

    private function generate($station_id=null)
    {
        $timestamp = date('U', strtotime(date("Y-m-d").' 00:00:01'));

        $token = Token::where('created_at','>=',$timestamp)->where('station_id','=',$station_id)->get()->count();

        if(empty($token)){
            return 1;
        }

        return $token + 1;
    }

    public function create(Request $request)
    {
        $outcome = false;
        $response = [];

        $input = $request->json()->all();

        try{
        
            $validator = Validator::make($input, ['station_id'=>'required']);

            if($validator->passes() == false){
                $outcome = false;                
                $response = $validator->errors()->all();
            }else{

                $token = new Token;

                if(!empty($token)){
                    foreach($input as $key => $value)
                    {
                        $token->{$key} = $value;
                    }

                    $token->token = $this->generate($input['station_id']);

                    $outcome = (bool) $token->save();
                    $response = $token->toArray();
                }

            }

        } catch(ErrorException $e){
            $outcome = false;
        }

        return Response()->json(['status'=>$outcome, 'response'=>$response]);
    }

    public function request(Request $request)
    {
        $timestamp = date('U', strtotime(date("Y-m-d").' 00:00:01'));

        $input = $request->json()->all();

        $validator = Validator::make($input, ['station_id'=>'required','agent_id'=>'required']);

        if($validator->passes() == false){
            $outcome = false;                
            $response = $validator->errors()->all();
        }else{

            $token = Token::where('created_at','>=',$timestamp)
                        ->where('station_id','=',$input['station_id'])
                        ->where('status','=','pending')
                        ->orderBy('id','asc')
                        ->first();
            
            $token->agent_id = $input['agent_id'];

            $token->save();

            $response = $token->toArray();
        }

        return Response()->json(['status'=>true, 'response'=>$response]);
    }

    public function byagent($agent_id=null)
    {
        $timestamp = date('U', strtotime(date("Y-m-d").' 00:00:01'));

        $token = Token::where('created_at','>=',$timestamp)
                        ->where('agent_id','=',$agent_id)
                        ->where('status','=','pending')->get();

        $response = $token->toArray();

        return Response()->json(['status'=>true, 'response'=>$response]);
    }

    public function bystation($station_id=null)
    {
        $timestamp = date('U', strtotime(date("Y-m-d").' 00:00:01'));

        $token = Token::where('created_at','>=',$timestamp)
                        ->where('station_id','=',$station_id)
                        ->where('status','=','pending')->get();

        $response = $token->toArray();

        return Response()->json(['status'=>true, 'response'=>$response]);
    }

    public function read($id=null)
    {
        $outcome = false;
        $response = array();

        try{
            $token = Token::find($id);

            if(!empty($token->id)){
                $outcome = (bool) $token;
                $response = $token->toArray();    
            }        
        } catch(ErrorException $e){
            $outcome = false;
        } 

        return Response()->json(['status'=>$outcome, 'response'=>$response]);
    }

    public function update($id=null, Request $request)
    {
        $outcome = false;

        $input = $request->json()->all();

        try{
            $token = Token::find($id);

            if(!empty($token->id)){
                foreach($input as $key => $value)
                {
                    if(!in_array($key,['_method'])){
                        $token->{$key} = $value;
                    }
                }

                $outcome = (bool) $token->save();
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

            $token = Token::find($id);

            if(!empty($token->id)){
                $token->status = 'deleted';
                $outcome = $token->save();
            }       

        } catch(ErrorException $e){
            $outcome = false;
        }        

        return Response()->json(['status'=>$outcome]);
    }
}