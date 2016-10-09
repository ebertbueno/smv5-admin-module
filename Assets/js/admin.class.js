angular.module('app', ['datatables'])

  .constant('API_URL', $('base').attr('href') )

  .config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }])
  
  .controller('PageController', function($scope, $http, DTOptionsBuilder, DTColumnBuilder, $compile, API_URL) 
	{
			var form = {level:"1", language:"en", status:"1"};
			$scope.form = form;
			$scope.levels = [ {id:"1", name:"Admin"},{id:"2",name:"Visitor"} ];
			$scope.allstatus = [ {id:"1", name:"Ativo"},{id:"0",name:"Inativo"} ];
			$scope.languages = [ {id:"en", name:"English"},{id:"pt",name:"Português"} ];

			$scope.dtColumns = [
						DTColumnBuilder.newColumn('0').withTitle('ID'),
						DTColumnBuilder.newColumn('1').withTitle('First name'),
						DTColumnBuilder.newColumn('2').withTitle('Last name'),
						DTColumnBuilder.newColumn('3').withTitle('Email'),
						DTColumnBuilder.newColumn('4').withTitle('Level'),
						DTColumnBuilder.newColumn('5').withTitle('Language'),
						DTColumnBuilder.newColumn('6').withTitle('Status'),
						DTColumnBuilder.newColumn(7).withTitle(''),
				];

			$scope.dtInstance = {};

			$scope.dtOptions = DTOptionsBuilder.newOptions()
						.withOption('ajax', {
						 url: API_URL + '/admin/users',
						 type: 'GET'
				})
				.withDataProp('data')
				.withOption('processing', true)
				.withOption('serverSide', true)
				.withOption('createdRow', function(row) {
					$compile(angular.element(row).contents())($scope);
				});		
				
				$scope.reload = function (){
						$scope.dtInstance.reloadData();
				}

			//show modal form
			$scope.toggle = function(modalstate, id) 
			{
				$scope.modalstate = modalstate;
			  	$scope.form.id = id;
				delete $scope.error;delete $scope.status;
				$scope.form = angular.copy(form);

				if(modalstate == 'edit')
				{
					$http.get( API_URL+'/admin/users/' + id)
						.success(function(response) {
								  $scope.form = response;
						});
				}
				if(modalstate == 'delete')
				{
					$('#deleteModal').modal('show');
				}
				else
				{
					$('#myModal').modal('show');
				}
			}

			$scope.save = function(modalstate, id, token) 
			{
					var url = API_URL + "/admin/users";
					$scope.form._token = token;
					$scope.form._method = "POST";

					//append employee id to the URL if the form is in edit mode
					if (modalstate === 'edit'){
							url += "/" +id;
							$scope.form._method = "PATCH";
					}

					$http({
							method: 'POST',
							url: url,
							data: $.param($scope.form),
							headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).success(function(response) 
					{
							$scope.status = {type:'success', 'message':response.message};
							$("#myModal").modal('hide');
  					  $scope.reload();
					}).error(function(response) 
					{
							$scope.status = {type:'error', 'message':response.message};
							$scope.error = response.error;
					});
			}

			$scope.delete = function( id )
			{
				$http({
					method:'DELETE',
					url: API_URL + '/admin/users/'+ id
				}).success(function(response){
					$scope.status = {type:'success', 'message':response.message};
					$('#deleteModal').modal('hide');
					$scope.reload();
				}).error(function(response){
					alert(response.message);
				});
			}
	
	});