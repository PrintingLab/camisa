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
    $front_side=$request->F;
    $back_side=$request->B;
    $checkbox=$request->C;

    if ($quantity<12) {
      $bd_quantity=12;
    }else if($quantity>=13 && $quantity<=23){
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


    if ($front_side>0 && $back_side==0) {

      $consulta=DB::select("SELECT price FROM `printing` WHERE colors=$front_side and quantity=$bd_quantity ");
      $price_total=(($consulta[0]->price*$quantity)+($price*$quantity));
      $price_total=$price_total+($front_side*10);
      $price_total=$price_total*2;
      return response()->json(['success'=>json_decode($price_total)]);

    }else if($front_side==0 && $back_side>0){

      $consulta=DB::select("SELECT price FROM `printing` WHERE colors=$back_side and quantity=$bd_quantity ");

      $price_total=(($consulta[0]->price*$quantity)+($price*$quantity));
      $price_total=$price_total+($back_side*10);
      $price_total=$price_total*2;
      return response()->json(['success'=>json_decode($price_total)]);

    }else {

      $consulta=DB::select("SELECT price FROM `printing` WHERE colors=$front_side and quantity=$bd_quantity ");
      $consulta2=DB::select("SELECT price FROM `printing` WHERE colors=$back_side and quantity=$bd_quantity ");


      if ( ($front_side==$back_side) && $checkbox=='true') {
        $price_total=(($consulta[0]->price*$quantity)+($consulta2[0]->price*$quantity)+($price*$quantity));
        $price_total=$price_total+($front_side*10);
        $price_total=$price_total*2;


return response()->json(['success'=>json_decode($price_total)]);
      }else{
        $price_total=(($consulta[0]->price*$quantity)+($consulta2[0]->price*$quantity)+($price*$quantity));
        $price_total=$price_total+(($front_side*10)+($back_side*10));
        $price_total=$price_total*2;

        return response()->json(['success'=>json_decode($price_total)]);
      }


//return response()->json(['success'=>json_decode($price_total)]);

    }








  }


}
