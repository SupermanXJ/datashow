<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DataShow</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<!-- STYLES -->
    <link type="text/css" rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">

	<style>

        .container {
            display: inline-block;
            width: 33%;
            height: 350px;
        }

	</style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding-left: 1rem; padding-right: 1rem;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DataShow</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">首页</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="搜索" aria-label="搜索">
                <button class="btn btn-outline-light" type="submit" style="white-space: nowrap;">搜索</button>
            </form>
        </div>
    </div>
</nav>

<div class="top-header" style="margin: 0 auto; max-width: 1600px; padding: 1rem 1.75rem 1.75rem 1.75rem;">
    <div id="container1" class="container" ></div>
    <div id="container2" class="container" ></div>
    <div id="container3" class="container" ></div>
</div>


<!-- SCRIPTS -->
<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/node_modules/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/node_modules/highcharts/themes/dark-unica.js"></script>
<script type="text/javascript" src="/datashow/js/all.js"></script>
<script type="text/javascript" src="/datashow/js/index.js"></script>

</body>
</html>
