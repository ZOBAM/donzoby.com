<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Data_plan;
use Auth;

class DataPlanController extends Controller
{
    public $data_plans_per_page = 10;
    public $related_data_plans = [];

    public function get_related_plans($plan){
        if(count($plan)>0){
            foreach($plan as $data_plan){
                $data_plan->volume = $this->format_values($data_plan->volume, 'volume',false);
                $data_plan->validity = $this->format_values($data_plan->validity, 'validity');
                $this->get_related_plans[] = $data_plan;
            }
        }
    }//end get_related_plans
    private function format_values($data, $type, $full_unit_name = true){
        if($type == "volume"){
            if(!$full_unit_name){
                return ($data<1024)? $data.'MB' : round(($data/1024),2).'GB';
            }
            return ($data<1024)? $data.'MB (Megabytes)' : round(($data/1024),2).'GB (Gigabytes) ';
        }
        if($type == "validity"){
            return ($data<24)? $data.'hrs' : ceil($data/24).'days';
        }
    }//end format_values
    //programmatically generate a description diff from inputted one
    private function get_desc($data_plan_object,$single_obj = false){
        foreach($data_plan_object as $obj){
            $obj->data_plan_desc = "This data plan from <strong> ".ucwords($obj->provider)."</strong> offers you ".$this->format_values($obj->volume,'volume')." for <strong>₦$obj->price </strong>and will last for <strong>".$this->format_values($obj->validity,'validity') ."</strong>.";
        }
        return $data_plan_object;
    }//end get desc

    public function store(Request $request,$create = false,$id = false){
        $this->validate($request, [
            'provider' => 'required|string|max:10|min:3',
            'title' => 'required|string|max:240|min:12',
            'volume' => 'numeric|required|min:10|max:2048000',
            'price' => 'numeric|required|min:20|max:500000',
            'bonus_all' => 'numeric|min:0|max:20480|nullable',
            'bonus_new_sim' => 'numeric|min:0|max:20480|nullable',
            'validity' => 'numeric|required|min:1|max:8760',
            'use_period' => 'string|required|min:5|max:7',
            'how_to_sub' => 'string|required|min:5|max:240',
            'description' => 'string|min:5|max:940|nullable',
        ]);
        //return $request;
        if($create == "create"){
            $data_plan = new Data_plan;
            $response_msg['info'] = "Data Plan Saved: $request->title";
        }
        else {
            $data_plan = Data_plan::where('id',$id)->first();
            $response_msg['info'] = "Data Plan Updated: $request->title";
        }
        $data_plan->provider = $request->provider;
        $data_plan->title = $request->title;
        $data_plan->volume = $request->volume;
        $data_plan->price = $request->price;
        $data_plan->bonus_all = $request->bonus_all;
        $data_plan->bonus_new_sim = $request->bonus_new_sim;
        $data_plan->validity = $request->validity;
        $data_plan->use_period = $request->use_period;
        $data_plan->how_to_sub = $request->how_to_sub;
        $data_plan->description = $request->description;
        $data_plan->creator = Auth::id();
        if($data_plan->save()){
            $response_msg['data_plan'] = $data_plan;
           return $response_msg;
        }
    }//end store
    public function create($id = false){
        $data_plans_count = count(Data_plan::get());
        //$data_plans_per_page = 5;
        if($id && is_numeric($id)){
            if(Data_plan::destroy($id)){
                return response()->json([
                    'msg' => 'Data Plan Successfully Deleted',
                    'per_page' => $this->data_plans_per_page,
                    'data_plans_count'=> $data_plans_count - 1
                ]);
               // return "Data Plan Successfully Deleted";
            }
        }
        else{
            $data_plans = Data_plan::orderBy('created_at','desc')->get();
            return $data_plans;
        }
    }
    public function index(Request $request, $id = false, $topic = false){
        $view = "courses.data-plans";
        if(is_numeric($id)){
            $data_plan = Data_plan::where('id',$id)->first();
            $data_plan->timestamps = false;//prevent updating of time stamps
            //check ip address of my computer & email of logged in user and only add counts if visit is not from the developer
            //adding this email aspect will make it possible for me to login from any other device and hits won't be incremented
            $developer_email = (isset(Auth::user()->email))? Auth::user()->email : false;
            if ($_SERVER['REMOTE_ADDR'] != "197.211.61.117" && $_SERVER['REMOTE_ADDR'] != "102.89.1.21" && $_SERVER['REMOTE_ADDR'] != "197.211.61.133" && $_SERVER['REMOTE_ADDR'] != "141.0.13.181" && $developer_email != "upc4you@gmail.com") {
                $data_plan->hits = ++$data_plan->hits; $data_plan->save();
            }
            $data_plan->volume = $this->format_values($data_plan->volume,'volume');
            $data_plan->bonus_new_sim = $this->format_values($data_plan->bonus_new_sim,'volume');
            $data_plan->bonus_all = $this->format_values($data_plan->bonus_all,'volume');
            $data_plan->validity = $this->format_values($data_plan->validity,'validity');
            $title = $data_plan->title;
            //get related data plans
            $this->get_related_plans(Data_plan::where('price','<',$data_plan->price)->where('provider',$data_plan->provider)->orderBy('price','DESC')->take(2)->get());
            $this->get_related_plans(Data_plan::where('price','>',$data_plan->price)->where('provider',$data_plan->provider)->orderBy('price','ASC')->take(2)->get());
            $this->get_related_plans(Data_plan::where('price','<',$data_plan->price)->where('provider','!=',$data_plan->provider)->orderBy('price','DESC')->take(1)->get());
            $this->get_related_plans(Data_plan::where('price','>',$data_plan->price)->where('provider','!=',$data_plan->provider)->orderBy('price','ASC')->take(1)->get());
            $related = $this->get_related_plans;
            return view($view,compact('data_plan','title','related'));
        }
        else{//no specific id and therefore list out data plans
            $lower_price_limit = 350;//5h based on the average earning of a Nigerian
            $upper_price_limit = 5000;//5k based on the average earning of a Nigerian
            $data_plans;
            //handle preferences from link parameters
            if(isset($_GET['ng'])){
                $name = $request->name;
            $response = [
                  [
                    "type"=> "Overnight",
                    "price"=> 25.99
                  ],
                  [
                    "type"=> "2-Day",
                    "price"=> 9.99
                  ],
                  [
                    "type"=> "Postal",
                    "price"=> 2.99
                  ],
                  [
                    "type"=> "$name Posted from the Server",
                    "price"=> 1.99
                  ]
                ];
                /* $response =  [1, 2, 3]; */

                return response($response);
            }
			if(isset($_GET['ngx'])){
			$response =	[
				  [
					"type"=> "Overnight",
					"price"=> 26.99
				  ],
				  [
					"type"=> "2-Day",
					"price"=> 9.99
				  ],
				  [
					"type"=> "Postal",
					"price"=> 2.99
				  ],
                  [
                    "type"=> "This is coming from the Server",
                    "price"=> 1.99
                  ]
				];
				/* $response =	[1, 2, 3]; */

				return response($response)
				 ->header('Access-Control-Allow-Origin', 'http://localhost:4200')
				->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
				/*->header('Access-Control-Allow-Headers', 'Content-Type') */;
			}
            if (isset($_GET['validity']) || isset($_GET['volume']) || isset($_GET['provider'] )) {
                if(isset($_GET['validity']) && is_numeric($_GET['validity'])){
                    $validity = $_GET['validity'];
                    $data_plans =
                    $this->get_desc(Data_plan::where('validity',$validity)->orderBy('price','asc')->get());
                    $sub_heading = "Data Plans With ".$this->format_values($validity,'validity')." Validity Period";
                }
                if(isset($_GET['volume'])  && is_numeric($_GET['volume'])){
                    $volume = $_GET['volume'];
                    $data_plans = $this->get_desc(Data_plan::where('volume',$volume)->orderBy('price','asc')->get());
                    $sub_heading = $this->format_values($volume,'volume')." Data Plans";
                }
                if(isset($_GET['provider'])){
                    $provider = $_GET['provider'];
                    $data_plans = $this->get_desc(Data_plan::where('provider',$provider)->orderBy('price','asc')->get());
                    $sub_heading = "Data Plans from $provider";
                }
                //$data_plans = Data_plan::where()
                return view($view,compact('data_plans','sub_heading'));
            }
            //hot data plans
            $data_plans['hot'] =
            $this->get_desc(
                Data_plan::whereBetween('price',[$lower_price_limit,$upper_price_limit])->orderBy('price','asc')->paginate($this->data_plans_per_page)
            );
            if(count($data_plans['hot'])){
                //$data_plans['hot'] = $this->get_desc($data_plans['hot']);//get auto generated description
                foreach($data_plans['hot'] as $data_plan){
                    //$data_plan->data_plan_desc = $this->get_desc($data_plan);
                    $data_plan->link_title = str_replace(' ','-',$data_plan->title);
                }
            }
            //data plans by their validity period
            $data_plans['validity'] = Data_plan::select('validity')->groupBy('validity')->get();
            foreach($data_plans['validity'] as $validity){
                $validity->data_plan_count = count(Data_plan::where('validity',$validity->validity)->get());
                $validity->link_validity = $this->format_values($validity->validity,'validity');
            }
            //data plans by providers
            $data_plans['providers'] = Data_plan::select('provider')->groupBy('provider')->get();
            foreach($data_plans['providers'] as $provider){
                $provider->data_plan_count = count(Data_plan::where('provider',$provider->provider)->get());
            }
            //data plans by volume
            $data_plans['volume'] = Data_plan::select('volume')->groupBy('volume')->get();
            foreach($data_plans['volume'] as $volume){
                $volume->data_plan_count = count(Data_plan::where('volume',$volume->volume)->get());
                $volume->link_volume = $this->format_values($volume->volume,'volume');
            }
            return view($view,compact('data_plans'));
        }
    }//end index
}
