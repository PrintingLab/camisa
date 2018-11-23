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
	//$scope.preciototal='$'+0
	$scope.location_1=1
	$scope.location_2=0
	$scope.location_3=0
	$scope.location_4=0
	$scope.location_5=0
	$scope.front_side=true
	$scope.back_side=false
	$scope.btnQuotevalid=true
	$scope.currentPage = 0;
	$scope.pageSize = 12;
	$scope.ClrGroup=79
	$scope.ClrCode=0
	$scope.maxlocation=8
	$scope.showquantity=true
	$scope.numberOfPages=function(){
		return Math.ceil($scope.styles.length/$scope.pageSize);                
	}

	$scope.valquantity = function() {
		if ($scope.quantity<12) {
			$scope.showquantity=false
			console.log("menor "+$scope.quantity)
		}else{
			$scope.showquantity=true
			console.log("mayor "+$scope.quantity)
		}
		if ($scope.quantity > $scope.Clritemqty) {
			alert("You are trying to order more than we have in stock.")
			$scope.quantity=$scope.Clritemqty
		}
		if ($scope.quantity<23) {
			$scope.maxlocation=6
		}else if($scope.quantity>=24 && $scope.quantity<=35){
			$scope.maxlocation=7;
		}else if($scope.quantity>35){
			$scope.maxlocation=8;
		}

	}

	$scope.checkboxlocation = function() {
		if ($scope.location_1==0 && $scope.location_2==0 && $scope.location_3==0 && $scope.location_4==0 && $scope.location_5==0) {
			alert("Select at least one location")
			$scope.location_1=1
		}else{
		}

	}

	$scope.checkboxside = function() {
		if ($scope.front_side==false && $scope.back_side==false) {
			$scope.front_side=true
		}

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
	$scope.loadsize = function (img,colorGp,colorCd,coloN) {
		$scope.ClrGroup=colorGp
		$scope.ClrCode=colorCd
		$scope.styleImg=img
		$scope.ClrNm=coloN
		console.log($scope.styleImg)
	}

	$scope.loadproduct = function (pc,img,imgB,imgS,coloN,sizeN,colorGp,colorCd,itemqty,sku) {
		//prepro es el Precio del product
		$(".thead-dark th").removeClass("theaddarkth")

		$scope.quantity=""
		$scope.ClrGroup=colorGp
		$scope.Clritemqty=itemqty
		$scope.ClrCode=colorCd
		$scope.price=pc
		$scope.stylename=coloN+" - "+sizeN+" $"+pc
		$("#"+sku).addClass("theaddarkth")
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
		$scope.preciototal=""
		//console.log($scope.QuoteForm.$valid)
		//console.log($scope.price)
		if ($scope.QuoteForm.$valid) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				}
			});
			$.ajax({
				url:'getquote',
				type:'post',
				data: {P:$scope.price,Q:$scope.quantity,L1:$scope.location_1,L2:$scope.location_2,L3:$scope.location_3,L4:$scope.location_4,L5:$scope.location_5,B:$scope.back_side,F:$scope.front_side},
				//processData: false,
				success:function(data){
					$scope.preciototal='$'+data.uno.toFixed(2)+' each / $'+data.total+' total'
					$scope.preciototaleach='$ '+data.uno;
					$scope.preciototalBD=data.total;
					
					$scope.$apply()
					console.log(data);
					//$scope.Savequote()
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
