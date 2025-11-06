<?php
/**
 * Definición de rutas de la aplicación
 * Formato: $router->addRoute(método, ruta, controlador@método, [middleware])
 */

use App\Middleware\AuthMiddleware;

// Rutas públicas
$router->addRoute("POST","/apicategorias", "ApiController@index");
$router->addRoute("GET","/apicategorias", "ApiController@index");
$router->addRoute("GET","/products/pagina/:pagina", "ProductsController@todosPaginas");
$router->addRoute("GET","/products", "ProductsController@index", [AuthMiddleware::class]);
$router->addRoute("GET", "/", "HomeController@index");
$router->addRoute("GET", "/login", "AuthController@showLogin");
$router->addRoute("POST", "/login", "AuthController@login");
$router->addRoute("GET", "/logout", "AuthController@logout");
$router->addRoute("GET", "/register", "AuthController@showRegister");
$router->addRoute("POST", "/register", "AuthController@register");

$router->addRoute("GET", "/categoria", "CategoriaController@index");

$router->addRoute("GET", "/post", "PostController@index");
$router->addRoute("GET", "/post/paginar/:pagina", "PostController@index",[AuthMiddleware::class]);
//$router->addRoute("GET", "/usuarios", "UsuariosController@index");

// Rutas protegidas por middleware de autenticación
$router->addRoute("GET", "/dashboard", "DashboardController@index", [AuthMiddleware::class]);
$router->addRoute("GET", "/dashboard/:id", "DashboardController@show", [AuthMiddleware::class]);
$router->addRoute("GET", "/profile", "ProfileController@index", [AuthMiddleware::class]);
$router->addRoute("POST", "/profile", "ProfileController@update", [AuthMiddleware::class]);
$router->addRoute("GET", "/removeUser", "DeleteUser@removeUser", [AuthMiddleware::class]);
$router->addRoute("POST", "/updateUser", "UpdateUserController@updateUser", [AuthMiddleware::class]);
$router->addRoute("GET", "/updateUser", "DashboardController@renderUpdateUser", [AuthMiddleware::class]);
$router->addRoute("GET", "/post/misPosts", "PostController@renderMyPosts", [AuthMiddleware::class]);
$router->addRoute("GET", "/post/newPost", "PostController@renderNewPost", [AuthMiddleware::class]);
$router->addRoute("POST", "/post/createPost", "PostController@createPost", [AuthMiddleware::class]);
$router->addRoute("GET", "/post/deletePost", "PostController@renderDeletePost", [AuthMiddleware::class]);
$router->addRoute("POST", "/post/deletePost", "PostController@deletePost", [AuthMiddleware::class]);
