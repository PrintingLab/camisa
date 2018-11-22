<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content='{{csrf_token()}}'>
  <title>Tshirts Quote - Printinglab.com</title>
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
    <div class="row">
      <div class="mx-auto">
        <img src="{!! asset('img/printing-lab-logo-new-york-nj.png') !!}">
    </div>
</div>
<h1>Calculate Your Price</h1>
</div>
</div>
<div class="container">
  <div class="col align-self-center">
    <label for="Searchproduct"><b>Search product: </b></label>
    <input  ng-model="templatefilter" type="" id="Searchproduct" name="" class="Search" placeholder="Search product">
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
    <div ng-show="serverstatus" class="col-sm-12" style="height: 60vh">
        <h1>Internal server error Please <a href="https://quotetshirts.printinglab.com/">try again</a></h1>
    </div>
    <div data-toggle="modal" data-target="#CalYourPrice" ng-repeat="item in styles | filter:templatefilter | startFrom:currentPage*pageSize | limitTo:pageSize" class="col-6 col-sm-4 col-md-3 col-lg-2 mdstyle" ng-click=loadstyles(item.styleID,item.styleImage,item.title,item.brandName,item.baseCategory,item.styleName) >
     <p style="text-align: center;border-bottom: 1px #8080803b solid;"><b>@{{item.styleName}}</b></p>
     <img src="https://www.ssactivewear.com/@{{item.styleImage}}" style="width: 100%">
     <p>Brand: @{{item.brandName}} <br> @{{item.title}}</p>
 </div>
 <button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1">
    Previous
</button>
@{{currentPage+1}}/@{{numberOfPages()}}
<button ng-disabled="currentPage >= data.length/pageSize - 1" ng-click="currentPage=currentPage+1">
    Next
</button>
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
        <div class="row " >
           <div class="col-md-2 col-sm-3 col-12">
            <img src="https://www.ssactivewear.com/@{{styleImg}}" style="width: 100%">
            <p hidden="" style="text-align: center;">@{{stylename}}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="row">
                <div class="col-md-12 rowcalculate">
                    <div  class="col-sm-12">
                        <label for="sltcategoty" class="col-form-label"><b>Category:</b></label>
                        <input id="sltcategoty" type="" name="" ng-model="sltcategoty" disabled>
                    </div>
                    <div  class="col-sm-12">
                        <label for="sltbrand" class="col-form-label"><b>Brand:</b></label>
                        <input id="sltbrand" type="" name="" ng-model="sltbrand" disabled>
                    </div>
                    <div  class="col-sm-12">
                        <label for="sltname" class="col-form-label"><b>Your Product:</b></label>
                        <input id="sltname" type="" name="" ng-model="sltname" disabled>
                    </div>
                </div>
            </div>
                <!-- <div class="col-md-6 rowcalculate">

                    <label class="col-sm-12 col-form-label"><b>@{{Pleasewalit}}</b></label>
                     <div  class="col-sm-12">
                       <div class="dropdown">
                          <button ng-disabled="selectvalid" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select a Color
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <input ng-model="colorfilter" type="" name="" class="Search2" placeholder="Search">
                            <a ng-repeat="item in products | filter:{sizeCode:4}" class="dropdown-item" href="" ng-click="loadproduct(item.casePrice,item.colorFrontImage,item.colorBackImage,item.colorSideImage,item.colorName,item.sizeName)"><img style="width: 15%" src="https://www.ssactivewear.com/@{{item.colorSwatchImage}}">@{{item.colorName}} - @{{item.sizeName}} </a>
                        </div>
                    </div>
                </div> 

            </div>-->
        </div>
        <div class="col-md-7 col-sm-12">
            <p style="padding: 0px;margin: 0px"><b>color:</b>@{{ClrNm}}</p>
            <div class="row">
                <div class="gridcolor col-md-1 col-2" ng-repeat="item in products | filter:{sizeCode:4}" ng-click="loadsize(tem.colorFrontImage,item.colorGroup,item.colorCode)">
                    <label style="color: @{{item.colorSwatchTextColor}}" >@{{item.colorName}}</label>
                    <img style="width: 100%" src="https://www.ssactivewear.com/@{{item.colorSwatchImage}}" >
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th  scope="col">color</th>
                  <th ng-click="loadproduct(item.casePrice,item.colorFrontImage,item.colorBackImage,item.colorSideImage,item.colorName,item.sizeName,item.colorGroup,item.colorCode)"  ng-repeat="item in products | filter:{colorGroup:ClrGroup,colorCode:ClrCode}">@{{item.sizeName}}</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Stock</th>
              <td ng-repeat="item in products | filter:{colorGroup:ClrGroup,colorCode:ClrCode}">@{{item.qty}}</td>
          </tr>
      </tbody>
  </table>
</div>
<div class="col-md-12">
    <form name="QuoteForm" ng-model="QuotjkkeForm">
        <div class="row Howuneed">
            <div class="mx-auto">
                <label ><b>How many will you need?</b></label>
                <input ng-disabled="selectvalid" type="number"  name="" ng-model="quantity" min="1"   max="5000" required="" placeholder="#">
            </div>
        </div>
        <div class="col-md-12 Howinkuneed">
            <div class="row">
                <div class="col-md-6">
                   <label for="_sides" ><b>How many ink colors are in your design?</b></label>
               </div>
               <label for="">front_side
                <input type="checkbox" ng-model="front_side" name="" value="">
            </label>
            <label for="">back_side
                <input type="checkbox" ng-model="back_side" name="" value="">
            </label>
            <div  class="col-md-3">
                <label> lado 1</label>
                <input ng-disabled="selectvalid" type="number" ng-model="location_1" min="0" max="8" step="1" >
            </div>
            <div  class="col-md-3">
                <label> lado 2</label>
                <input ng-disabled="selectvalid" type="number" ng-model="location_2" min="0" max="8" step="1" >
            </div>
            <div  class="col-md-3">
                <label> lado 3</label>
                <input ng-disabled="selectvalid" type="number" ng-model="location_3" min="0" max="8" step="1" >
            </div>
            <div  class="col-md-3">
                <label> lado 4</label>
                <input ng-disabled="selectvalid" type="number" ng-model="location_4" min="0" max="8" step="1" >
            </div>
            <div  class="col-md-3">
                <label> lado 5</label>
                <input ng-disabled="selectvalid" type="number" ng-model="location_5" min="0" max="8" step="1" >
            </div>
            <div class="col-md-12 col-check_side" ng-show="front_side == back_side">
                <label for="check_side"><b>The design is the same for both sides?</b></label>
                <input id="check_side"  aria-label="Checkbox for following text input" class="check_side" type="checkbox" ng-model="check_side" name="" value="" >
            </div>
        </div>
    </div>
    <div class="col-md-12 btnQuote">
       <input ng-disabled="btnQuotevalid" type="submit" name="" id="btnQuote" value="Get Quote" ng-click="load()" >
       <label for="btnQuote" class="value">Price = &nbsp &nbsp &nbsp<b>@{{preciototal}}</b></label>
   </div>
</form>
</div>

</div>
</div>
<div ng-show="btnQuotevalid" class="alert alert-danger" role="alert">
  Please select a color
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
<div class="container-fluid bg-primary py-3">
  <div class="container">
    <div class="row py-3">
      <div class="col-md-9">
        <a href="https://printinglab.com/" target="_blank">
          <img style="width: 220px" src="{!! asset('img/printing-lab-logo-new-york-nj.png') !!}">
      </a>
  </div>
  <div class="col-md-3">
    <div class="d-inline-block" style="float: right;">
      <div class="bg-circle-outline d-inline-block">
        <a href="https://www.facebook.com/PrintingLab" target="_blank" class="text-white"><i class="fab fa-facebook-f"></i>
        </a>
    </div>
    <div class="bg-circle-outline d-inline-block">
        <a href="https://www.instagram.com/printinglab/" target="_blank" class="text-white">
          <i class="fab fa-instagram"></i></a>
      </div>
      <div class="bg-circle-outline d-inline-block">
          <a href="https://www.youtube.com/channel/UCXmJgr5ynTbf1oNEM6r6I7g" target="_blank" class="text-white">
            <i class="fab fa-youtube"></i></a>
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
