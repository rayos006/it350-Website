<!DOCTYPE html>
<?php
session_start();
if($_SESSION["admin"] != 1){
        echo "You are not authorized to view this page! Please contact your Administrator to request access.";
        header("HTTP/1.1 401 Unauthorized");
        exit;
	}
require("header.php");
require("nav.php");
?>
<html>
	<head>
		<title>DB Admin</title>
	</head>
	<body>
	 <div class="ui raised container segment">
	 <h2>Status: </h2>
	 <div class="row">
	 <i class="circle green icon"></i>
	 MySQL
	 </div>
	 <div class="row">
	 <i class="circle green icon"></i>
	 MongoDB
	 </div>
	 <div class="row">
	 <i class="circle red icon"></i>
	 ElasticSearch
	 </div>
	</div>

	<div class="ui raised container segment">
	 <h2>BackUps: </h2>
	 <button class="ui button" onclick="alert('Backup ran for MySQL')">MySQL</button>
	 <button class="ui button" onclick="alert('Backup ran for MongoDB')">MongoDB</button>
	 <button class="ui button" onclick="alert('Backup did not run for ElasticSearch')">Elastic Search</button>
	</div>

	<div class="ui raised container segment">
	 <h2>Usage: </h2>
	<div class="ui raised container segment">
	<h2>MongoDB: </h2>
	<p id="MongoUsage"></p>
	</div>
	<div class="ui raised container segment">
	<h2>MySQL: </h2>
	<p id="MySQLUsage"></p>
	</div>
	<div class="ui raised container segment">
	<h2>ElasticSearch: </h2>
	<p id="ElasticSearchUsage"></p>
	</div>
	</div>

	<div class="ui raised container segment">
	 <h2>Elastic Search: </h2>
	 <p>Click the buttons to search elasticsearch:</p>
	<button class="ui button" onclick="elasticSearch1()">#1</button>
	<button class="ui button" onclick="elasticSearch2()">#2</button>
	<button class="ui button" onclick="elasticSearch3()">#3</button>
	</div>
	</body>
	<script>
	$(document).ready(function () {
		getMongoInfo()
		getMySQLInfo()
		getElasticSearchInfo()
	})
	</script>
</html> 
