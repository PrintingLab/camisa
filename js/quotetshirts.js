var quotetshirtsApp = angular.module('quotetshirt-v1', []);

quotetshirtsApp.controller('quotetshirtcontroller',function($scope,$http){
	$scope.Categories=[]
	$scope.styles=[]
	$scope.products=[]
	$scope.price=0.0
	$scope.product="Select a Color"
	$scope.loadcategories = function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'enpoints',
			type:'post',
			//data: {endpoint:'categories/'},
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
		          error:function(){
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
		          		$scope.$apply()

		          	}
		          },
		          error:function(){
		          }
		      })

	}
	$scope.loadproduct = function (pc) {
		//prepro es el Precio del product
		$scope.price=pc
		console.log($scope.price)
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});
		$.ajax({
			url:'cotizar',
			type:'post',
			data: {P:$scope.price},
		          //processData: false,
		          success:function(data){
		          	console.log(data.success);
		          	if (data.success=='null') {
		          		$scope.error="Not found"
		          	}else{
		          		console.log(data.success)
		          	}
		          },
		          error:function(){
		          }
		      })
	}

$scope.load=function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name=_token]').attr('content')
		}
	});
	$.ajax({
		url:'getquote',
		type:'post',
		data: {P:$scope.price,Q:$scope.quantity,Bs:$scope.back_side,Fs:$scope.front_side},
						//processData: false,
						success:function(data){
console.log(data)

						},
						error:function(){
						}
				})

}


	$scope.init = function(){
		$scope.loadcategories()
	}()

});
