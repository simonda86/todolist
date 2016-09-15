var app = angular.module('TodoList', ['ui.bootstrap']);

app.controller('TodoListController', function($scope, $http, $modal){

    $http.get('/api/v1/lists').then(function(response){
        $scope.lists = response.data;
        $scope.setCurrentList($scope.lists[0]);
    });

    $scope.setCurrentList = function(list) {

        if(list === false) list = $scope.lists[0];

        if(typeof(list) === 'undefined')
        {
            $scope.currentList = false;
            return;
        }

        $scope.currentList = list;
        $http.get('/api/v1/lists/' + list.id + '/items').then(function(response){
            if(response.status == 200)
            {
                $scope.currentList.items = response.data;
            }
        });

    };

    $scope.createItem = function() {

        var item = $scope.newItem,
            list = $scope.currentList;

        $scope.newItem = '';

        $http.post('/api/v1/lists/' + list.id + '/items', {text: item}).then(function(response){
            if(response.status == 200)
            {
                if(typeof(list.items) == 'undefined') list.items = [];
                list.items.push(response.data);
            }
        });
    };

    $scope.completeItem = function(item) {

        var list = $scope.currentList;

        $http.post('/api/v1/lists/' + item.list_id +'/items/' + item.id + '/complete').then(function(response){
            if(response.status == 200)
            {
                list.items.splice(list.items.indexOf(item),1);
            }
        });
    };

    $scope.ListModal = function() {

        var modalInstance = $modal.open({
            templateUrl: 'templates/ListModal.html',
            controller: 'ListModalController'
        });

        modalInstance.result.then(function(list){
            $scope.lists.push(list);
            $scope.currentList = list;
        });

    };

    $scope.DeleteListModal = function(list) {

        var modalInstance = $modal.open({
            templateUrl: 'templates/ConfirmationModal.html',
            controller: 'ConfirmationModal',
            resolve: {
                title: function () {
                    return 'Are you sure you want to delete?';
                },
                body: function () {
                    return 'This will also delete all items in "' + list.name + '"';
                },
                data: function() {
                    return list;
                }
            }
        });

        modalInstance.result.then(function(data){
            $http.delete('/api/v1/lists/' + data.id).then(function(response){
                if(response.status == 200)
                {
                    $scope.lists.splice($scope.lists.indexOf(data),1);
                    if(data.id == $scope.currentList.id) $scope.setCurrentList(false);
                }
            });
        });

    };

});

app.controller('ListModalController', function($scope, $http, $modalInstance){

    $scope.name = '';
    $scope.errors = [];

    $scope.ok = function(){
        $http.post('/api/v1/lists', {name: $scope.name}).then(function(response){
            if(response.status == 200)
            {
                $modalInstance.close(response.data);
            }
        },function(response){
            if(response.status == 422)
            {
                // Display validation errors
                $scope.errors = response.data.name;
            }
        });
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

});

app.controller('ConfirmationModal', function($scope, $modalInstance, title, body, data){

    $scope.title = title;
    $scope.body = body;

    $scope.ok = function(){
        $modalInstance.close(data);
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

});