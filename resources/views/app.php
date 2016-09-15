<!DOCTYPE html>
<html ng-app="TodoList">
<head>
    <title>TodoList</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="auth">
<div class="container-fluid" ng-controller="TodoListController">
    <div class="row">
        <aside class="col-sm-2">
            <ul class="row">
                <li ng-repeat="list in lists" ng-class="{active: list.id == currentList.id}">
                    <a ng-click="setCurrentList(list)"><i class="fa fa-list"></i> {{ list.name }}</a>
                    <div class="pull-right actions">
                        <button class="btn btn-danger btn-link" ng-click="DeleteListModal(list)"><i class="fa fa-trash-o"></i></button>
                    </div>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-12 bottom-nav">
                    <button class="btn btn-info btn-block" ng-click="ListModal()"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </aside>
        <section id="main" class="col-sm-10 col-sm-offset-2">
            <div ng-show="currentList.id">
                <form ng-submit="createItem()" id="createItemForm">
                    <div class="form-group">
                        <input type="text" ng-model="newItem" name="" class="form-control" id="" placeholder="Add item to '{{ currentList.name }}'" autofocus>
                    </div>
                </form>
                <ul class="items">
                    <li ng-repeat="item in currentList.items" ng-class="{completed: completed}">
                        <label>
                            <input type="checkbox" ng-model="completed" ng-change="completeItem(item)">
                            {{ item.text }}
                        </label>
                    </li>
                </ul>
            </div>
            <div ng-hide="currentList.id">
                <p>First create a list to get started.</p>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.18/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.3/ui-bootstrap-tpls.min.js"></script>
    <script src="/js/app.js"></script>
</div>
</body>
</html>
