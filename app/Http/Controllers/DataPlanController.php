<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Data_plan;
use Auth;

class DataPlanController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'provider' => 'required|string|max:10|min:3',
            'plan_title' => 'required|string|max:240|min:17',
            'volume' => 'numeric|required|min:10|max:163840',
            'data_price' => 'numeric|required|min:25|max:50000',
            'bonus_all' => 'numeric|min:5|max:20480|nullable',
            'bonus_new_sim' => 'numeric|min:5|max:20480|nullable',
            'validity' => 'numeric|required|min:1|max:8760',
            'use_period' => 'string|required|min:5|max:7',
            'how_to_sub' => 'string|required|min:5|max:240',
            'description' => 'string|min:5|max:240|nullable',
        ]);
        $data_plan = new Data_plan;
        $data_plan->provider = $request->provider;
        $data_plan->title = $request->plan_title;
        $data_plan->volume = $request->volume;
        $data_plan->price = $request->data_price;
        $data_plan->bonus_all = $request->bonus_all;
        $data_plan->bonus_new_sim = $request->bonus_new_sim;
        $data_plan->validity = $request->validity;
        $data_plan->use_period = $request->use_period;
        $data_plan->how_to_sub = $request->how_to_sub;
        $data_plan->description = $request->description;
        $data_plan->creator = Auth::id();
        if($data_plan->save()){
           return "You have successfully save $data_plan->title"; 
        }
    }//end store
    public function create($id = false){
        if($id && is_numeric($id)){
            if(Data_plan::destroy($id)){
                return "Data Plan Successfully Deleted";
            }
        }
        else{
            $data_plans = Data_plan::orderBy('created_at','desc')->paginate(5);
            return $data_plans;
        }
    }
    public function index($id = false, $topic = false){
        return "connected!";
    }
}
