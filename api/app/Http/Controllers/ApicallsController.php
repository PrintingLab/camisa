<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApicallsController extends Controller
{


  public function GetCalls(Request $request){
    $endpoint = $request->endpoint;
    $apiPath =  "https://api.ssactivewear.com/v2/".$endpoint;
    $returnformat= "?mediatype=json";
    $username = '72348';
    $password = '023f94c9-dd3f-4543-bfb5-ed82f0b2cbcc';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$apiPath);
    $headers = array(
      'Content-Type:text/html'
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $result = curl_exec($ch);
    curl_close($ch);
    return response()->json(['success'=>json_decode($result)]);
  }
  public function GetCategories(Request $request){
    $endpoint = "categories/";
    $apiPath =  "https://api.ssactivewear.com/v2/".$endpoint;
    $returnformat= "?mediatype=json";
    $username = '72348';
    $password = '023f94c9-dd3f-4543-bfb5-ed82f0b2cbcc';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$apiPath);
    $headers = array(
      'Content-Type:text/html'
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $result = curl_exec($ch);
    curl_close($ch);

    return response()->json(['success'=>json_decode($result)]);
  }

  public function callcotizar(Request $request){
    $result = DB::table('printing')->where('id', 1)->get();
    return response()->json(['success'=>json_decode($result)]);
  }

  public function callgetquote(Request $request){

    $price = $request->P;
    $quantity=$request->Q;
    $back_side=$request->back_side;
    $front_side=$request->front_side;

    if ($quantity<=12) {
      $bd_quantity=12;
    }else if($quantity>=13 && $quantity<=24){
      $bd_quantity=24;
    }else if($quantity>=25 && $quantity<=36){
      $bd_quantity=36;
    }else if($quantity>=37 && $quantity<=48){
      $bd_quantity=48;
    }else if($quantity>=49 && $quantity<=108){
      $bd_quantity=108;
    }else if($quantity>=109 && $quantity<=288){
      $bd_quantity=288;
    }else if($quantity>=289 && $quantity<=1010){
      $bd_quantity=1010;
    }else if($quantity>=1011 && $quantity<=3000){
      $bd_quantity=3000;
    }else if($quantity>=3001 && $quantity<=5000){
      $bd_quantity=5000;
    }




 // $consulta=DB::select("SELECT price FROM `printing` WHERE colors='' and quantity=$bd_quantity ");



return response()->json($back_side);


  }


}
