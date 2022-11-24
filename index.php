<?php require_once($_SERVER['DOCUMENT_ROOT'].'/router/router.php');
$route = new Route();
$route->add("/","home.php");
$route->add("/browse","webshop/browse.php");
$route->add("/search/{term}","webshop/search.php");
$route->add("/product/{id}/{productname}","webshop/index.php");
$route->add("/admin/products/edit/{id}/{productname}","admin/products/edit/index.php");
$route->add("/admin/moderate/{id}/","admin/users/index.php");
$route->notFound("404.php");
?>