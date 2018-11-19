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

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>

    
</head>
<body ng-app="quotetshirt-v1">
    <div class="pageload" id="pageload"></div>
    <div class="row" ng-controller="quotetshirtcontroller">
        <div id="preloader">
         <div class="flexloader"><div class="loader"><i class="fa fa-cog fa-4x yellow"></i><i class="fa fa-cog fa-4x black"></i></div></div>
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
       <div data-toggle="modal" data-target="#CalYourPrice" ng-repeat="item in styles | filter:templatefilter" class="col-md-2" ng-click=loadstyles(item.styleID,item.styleImage,item.title,item.brandName,item.baseCategory,item.styleName) style="cursor: pointer;">
        <p><b>@{{item.styleName}}</b></p>
        <img src="https://www.ssactivewear.com/@{{item.styleImage}}" style="width: 100%">
        <p>@{{item.title}}</p>
        <p>@{{item.brandName}}</p>
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
            <div class="col-sm-12" >
                
            </div>
            <div class="col-md-4">
                <label class="col-sm-5 col-form-label"><b>Category:</b></label>
                <div  class="col-sm-12">
                    <input type="" name="" ng-model="sltcategoty" disabled>
                </div>
                <label class="col-sm-5 col-form-label"><b>Brand:</b></label>
                <div  class="col-sm-12">
                    <input type="" name="" ng-model="sltbrand" disabled>
                </div>
                
            </div>
            <div class="col-md-4">
                <label class="col-sm-5 col-form-label"><b>Your Product:</b></label>
                <div  class="col-sm-12">
                    <input type="" name="" ng-model="sltname" disabled>
                </div>
                <label class="col-sm-5 col-form-label"><b>Color:</b></label>
                <div  class="col-sm-12">
                    <select ng-model="product" ng-change="loadproduct(this.product)">
                        <option  
                        ng-repeat="item in products"
                        value="@{{item.casePrice}}">
                        @{{item.colorName}} - @{{item.sizeName}}
                    </option>
                </select>
            </div>
            <div class="col-md-12">
                <h1 class="value">Price = $ @{{price}}</h1>
            </div>
        </div>
        <div class="col-md-4">
         <img src="https://www.ssactivewear.com/@{{styleImg}}">
     </div>
 </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>

</div>
</body>
<script type="text/javascript" src="{!! asset('js/quotetshirts.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('css/quotetshirts.css') !!}"></link>
</html>
