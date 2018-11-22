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

    $lado_1=$request->L1;
    $lado_2=$request->L2;
    $lado_3=$request->L3;
    $lado_4=$request->L4;
    $lado_5=$request->L5;

    $front_side=$request->F;
    $back_side=$request->B;

    if ($quantity<12) {
      $bd_quantity=0;
    }else if($quantity>=12 && $quantity<=23){
      $bd_quantity=12;
    }else if($quantity>=24 && $quantity<=35){
      $bd_quantity=24;
    }else if($quantity>=36 && $quantity<=47){
      $bd_quantity=36;
    }else if($quantity==48){
      $bd_quantity=48;
    }elseif ($quantity>=49 && $quantity<=108) {
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


    if ($bd_quantity==0) {
      //impresion interna
      if ($quantity>=1&&$quantity<=5) {
        if ($front_side=='true' && $back_side=='true') {
          $price_total=(55+(2*$price));
          $price_total=$price_total*$quantity;
        }else if(($front_side=='true'&&$back_side=='false')||($front_side=='false'&&$back_side=='true')){
          $price_total=(45+(2*$price));
          $price_total=$price_total*$quantity;
        }
      }else{
        if ($front_side=='true' && $back_side=='true') {
          $price_total=(45+(2*$price));
          $price_total=$price_total*$quantity;
        }else if(($front_side=='true'&&$back_side=='false')||($front_side=='false'&&$back_side=='true')){
          $price_total=(35+(2*$price));
          $price_total=$price_total*$quantity;
        }
      }
      $price_individual=$price_total/$quantity;
      return response()->json(['total'=>json_decode($price_total),'uno'=>json_decode($price_individual)]);
    }else{
      //impresion externa

      if ($lado_1==0) {
        $consulta1=0;
      }else {
        $consulta1=DB::select("SELECT price FROM `printing` WHERE colors=$lado_1 and quantity=$bd_quantity ");
        $consulta1=$consulta1[0]->price;
      }
      if ($lado_2==0) {
        $consulta2=0;
      }else{
        $consulta2=DB::select("SELECT price FROM `printing` WHERE colors=$lado_2 and quantity=$bd_quantity ");
        $consulta2=$consulta2[0]->price;
      }
      if ($lado_3==0) {
        $consulta3=0;
      }else{
        $consulta3=DB::select("SELECT price FROM `printing` WHERE colors=$lado_3 and quantity=$bd_quantity ");
        $consulta3=$consulta3[0]->price;
      }
      if ($lado_4==0) {
        $consulta4=0;
      }else{
        $consulta4=DB::select("SELECT price FROM `printing` WHERE colors=$lado_4 and quantity=$bd_quantity ");
        $consulta4=$consulta4[0]->price;
      }
      if ($lado_5==0) {
        $consulta5=0;
      }else {
        $consulta5=DB::select("SELECT price FROM `printing` WHERE colors=$lado_5 and quantity=$bd_quantity ");
        $consulta5=$consulta5[0]->price;
      }

      $price_total=(($consulta1*$quantity)+($consulta2*$quantity)+($consulta3*$quantity)+($consulta4*$quantity)+($consulta5*$quantity)+($price*$quantity));
      $planchas=(($lado_1*10)+($lado_2*10)+($lado_3*10)+($lado_4*10)+($lado_5*10));
      $price_total=($price_total+$planchas)*2;
      $price_individual=$price_total/$quantity;
      return response()->json(['total'=>json_decode($price_total),'uno'=>json_decode($price_individual)]);



      /*
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
}
*/

}






}


}
