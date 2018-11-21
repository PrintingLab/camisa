var quotetshirtsApp = angular.module('quotetshirt-v1', []);
quotetshirtsApp.filter('startFrom', function() {
	return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});
quotetshirtsApp.controller('quotetshirtcontroller',function($scope,$http){
	$scope.serverstatus=false
	$scope.Categories=[]
	$scope.templatefilter="5000"
	$scope.styles=[]
	$scope.products=[]
	$scope.price=0.0
	$scope.product="Select a Color"
	$scope.Pleasewalit="Color: "
	$scope.selectvalid=true
	$scope.preciototal='$'+0
	$scope.back_side=0
	$scope.front_side=1
	$scope.check_side=false
	$scope.btnQuotevalid=true
	$scope.currentPage = 0;
	$scope.pageSize = 12;
	$scope.ClrGroup=79
	$scope.ClrCode=0
	$scope.numberOfPages=function(){
		return Math.ceil($scope.styles.length/$scope.pageSize);                
	}

	$scope.loadcategories = function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'enpoints',
			type:'post',
			//data: {endpoint:'styles'},
			data: {endpoint:'styles?Search=T-Shirts'},
		          //processData: false,
		          success:function(data){
		          	console.log(data.success);
		          	//$scope.Categories=data.success
		          	$scope.styles=data.success
		          	$scope.$apply()
		          	$("#pageload").hide();
		          	$("#preloader").hide();

		          },
		          error:function(error){
		          	$("#pageload").hide();
		          	$("#preloader").hide();
		          	console.log(error.statusText)
		          	$scope.serverstatus=true
		          	$scope.$apply()
		          }
		      })
	};
	$scope.loadbaseCategory = function (i) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'enpoints',
			type:'post',
			data: {endpoint:'styles?Search='+i+',Gildan'},
		          //processData: false,
		          success:function(data){
		          	console.log(data.success);
		          	if (data.success=='null') {
		          		$scope.error="Not found"
		          		$scope.$apply()
		          	}else{
		          		$scope.styles=data.success
		          		$scope.$apply()
		          	}

		          },
		          error:function(){
		          }
		      })
	};
	$scope.loadstyles = function (i,img,tlt,brn,cat,stl) {
		$scope.styleImg=img
		$scope.sltbrand=brn
		$scope.sltcategoty=cat
		$scope.sltproduct=tlt
		$scope.sltname=stl
		$scope.price=0.0
		$scope.preciototal='$'+0
		$scope.Pleasewalit="Please walit..."
		$scope.btnQuotevalid=true
		$scope.stylename=""
		$scope.quantity=""
		console.log($scope.styleImg)
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'enpoints',
			type:'post',
			data: {endpoint:'products/?style='+i},
		          //processData: false,
		          success:function(data){
		          	console.log(data.success);
		          	if (data.success=='null') {
		          		$scope.error="Not found"
		          		$scope.$apply()
		          	}else{
		          		$scope.products=data.success
		          		$scope.Pleasewalit="Color: "
		          		$scope.selectvalid=false
		          		$scope.$apply()

		          	}
		          },
		          error:function(){
		          }
		      })

	}
	$scope.loadsize = function (img,colorGp,colorCd) {
		$scope.ClrGroup=colorGp
		$scope.ClrCode=colorCd
	}

	$scope.loadproduct = function (pc,img,imgB,imgS,coloN,sizeN,colorGp,colorCd) {
		//prepro es el Precio del product
		console.log(colorCd)
		$scope.ClrGroup=colorGp
		$scope.ClrCode=colorCd
		$scope.ClrNm=coloN
		$scope.price=pc
		$scope.styleImg=img
		$scope.stylename=coloN+" - "+sizeN+" $"+pc
		$scope.load()
		$scope.btnQuotevalid=false
		// console.log($scope.price)
		// $.ajaxSetup({
		// 	headers: {
		// 		'X-CSRF-Token': $('meta[name=_token]').attr('content')
		// 	}
		// });
		// $.ajax({
		// 	url:'cotizar',
		// 	type:'post',
		// 	data: {P:$scope.price},
		//           //processData: false,
		//           success:function(data){
		//           	console.log(data.success);
		//           	if (data.success=='null') {
		//           		$scope.error="Not found"
		//           	}else{
		//           		console.log(data.success)
		//           	}
		//           },
		//           error:function(){
		//           }
		//       })
	}

	$scope.load=function(){
		console.log($scope.QuoteForm.$valid)
		if ($scope.QuoteForm.$valid) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				}
			});
			$.ajax({
				url:'getquote',
				type:'post',
				data: {P:$scope.price,Q:$scope.quantity, B:$scope.back_side, F:$scope.front_side, C:$scope.check_side},
						//processData: false,
						success:function(data){

							$scope.preciototal='$ '+data.success;
							$scope.preciototalBD=data.success;
							$scope.$apply()
							console.log($scope.preciototal);
							$scope.Savequote()
						},
						error:function(){
						}
					})
			$scope.error=false
		}else{
			$scope.error=true
		}

		

	}


	$scope.Savequote=function(){
		console.log($scope.sltbrand+' - '+$scope.sltproduct+' - '+$scope.sltname+' - '+$scope.stylename)
		var prod= $scope.sltbrand+' - '+$scope.sltproduct+' - '+$scope.sltname+' - '+$scope.stylename
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'savequote',
			type:'post',
			data: {np:prod,P:$scope.preciototalBD,Q:$scope.quantity, B:$scope.back_side, F:$scope.front_side,},
						//processData: false,
						success:function(data){
							console.log(data.success);
						},
						error:function(){
						}
					})

	}

	$scope.init = function(){
		$scope.loadcategories()
	}()

});
