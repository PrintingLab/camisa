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
}
