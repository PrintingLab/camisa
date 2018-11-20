<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content='{{csrf_token()}}'>
  <title>Laravel</title>
  <!-- Fonts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{!! asset('js/angular.min.js') !!}"></script>
  <script data-require="ui-bootstrap@*" data-semver="0.12.1" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.min.js"></script>
  <!-- Styles -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script type="text/javascript" src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
</head>
<body ng-app="quotetshirt-v1">
    <div class="pageload" id="pageload"></div>
    <div ng-controller="quotetshirtcontroller">
        <div id="preloader">
            <div class="flexloader">
                <div class="loader"><i class="fa fa-cog fa-4x yellow"></i><i class="fa fa-cog fa-4x black"></i>
                </div>
            </div>
        </div>
        <div class="imghome">
            <div class="container">
                <div class="mx-auto">
                    <img src="{!! asset('img/printing-lab-logo-new-york-nj.png') !!}">
                </div>
                <h1>Calculate Your Price</h1>
            </div>
        </div>
        <div class="container">
         <div class="col align-self-center">
            <input  ng-model="templatefilter" type="" name="" class="Search">
            <i class="fas fa-search"></i>
        </div>
        <select hidden ng-model="category" ng-change="loadbaseCategory(this.category)">
            <option  ng-selected="@{{item.value == filterCondition.operator}}"
            ng-repeat="item in Categories"
            value="@{{item.name}}">
            @{{item.name}}
            <img src="https://www.ssactivewear.com/@{{item.image}}">
        </option>
    </select>
    <div class="row">
       @{{$scope.error}}
       <div data-toggle="modal" data-target="#CalYourPrice" ng-repeat="item in styles | filter:templatefilter" class="col-md-2 mdstyle" ng-click=loadstyles(item.styleID,item.styleImage,item.title,item.brandName,item.baseCategory,item.styleName) >
           <p style="text-align: center;border-bottom: 1px #8080803b solid;"><b>@{{item.styleName}}</b></p>
           <img src="https://www.ssactivewear.com/@{{item.styleImage}}" style="width: 100%">
           <p>Brand: @{{item.brandName}} <br> @{{item.title}}</p>
       </div>
   </div>
   <!-- Modal -->
   <div class="modal fade" id="CalYourPrice" tabindex="-1" role="dialog" aria-labelledby="CalYourPrice" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 style="text-align: center;">@{{sltbrand}} - @{{sltproduct}} - @{{sltname}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row rowcalculate" >
                <div class="col-md-4">
                    <label class="col-sm-12 col-form-label"><b>Category:</b></label>
                    <div  class="col-sm-12">
                        <input type="" name="" ng-model="sltcategoty" disabled>
                    </div>
                    <label class="col-sm-12 col-form-label"><b>Brand:</b></label>
                    <div  class="col-sm-12">
                        <input type="" name="" ng-model="sltbrand" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-sm-12 col-form-label"><b>Your Product:</b></label>
                    <div  class="col-sm-12">
                        <input type="" name="" ng-model="sltname" disabled>
                    </div>
                    <label class="col-sm-12 col-form-label"><b>@{{Pleasewalit}}</b></label>
                    <div  class="col-sm-12">
                     <div class="dropdown">
                      <button ng-disabled="selectvalid" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select a Color
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a ng-repeat="item in products" class="dropdown-item" href="" ng-click="loadproduct(item.casePrice,item.colorFrontImage,item.colorBackImage,item.colorSideImage)"><img style="width: 15%" src="https://www.ssactivewear.com/@{{item.colorFrontImage}}">@{{item.colorName}} - @{{item.sizeName}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="value">Price = $ @{{price}}</h1>
            </div>
        </div>
        <div class="col-md-4">
         <img src="https://www.ssactivewear.com/@{{styleImg}}" style="width: 100%">
         <div class="row">
             <div class="btn-group btn-group-toggle mx-auto" data-toggle="buttons">
              <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"> Radio
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option3" autocomplete="off"> Radio
            </label>
        </div>
    </div>
</div>
<div class="col-md-12">
    <label class="col-sm-4 col-form-label"><b>How many will you need?</b></label>
    <div  class="col-sm-8">
      <input type="number" name="" ng-model="quantity" min="1"  >
  </div>
</div>
<div class="col-md-12">
    <label class="col-sm-5 col-form-label"><b>How many ink colors are in your design?</b></label>
    <div  class="col-sm-3">
      <label> Front Side</label>
      <input type="number" ng-model="front_side" min="1" max="8" step="1">
  </div>
  <div  class="col-sm-3">
      <label> Back Side</label>
      <input type="number" ng-model="back_side" min="1" max="8" step="1">
  </div>
</div>
<div class="col-md-12">
   <input type="button" name="" value="Get Quote" ng-click="load()" >
</div>
</div>
</div>
</div>
<div class="modalfooter">
    <p>Pricing Tips:<br> Printing on colored garments will cost more than printing on white. <br> Colors count in screen-printing because each one requires a unique screen. Lower your price by designing with one or two colors per side.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
<script type="text/javascript" src="{!! asset('js/quotetshirts.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/pagination.min.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('css/quotetshirts.css') !!}"></link>
</html>
