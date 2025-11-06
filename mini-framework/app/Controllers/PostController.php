<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Post;
use App\Models\Categoria;
use App\Core\Auth;

class PostController extends Controller{

	 private $modelo;		

    public function __construct(){
		$this->modelo = new Post();
		parent::__construct();
	}


public function index($parm){

//	$datos = $this->modelo->all();
$pagina = $parm["pagina"]??1;

	$sql = "select u.username, c.name, p.title, p.content FROM Posts p JOIN
	 Categories c ON p.category_id = c.category_id JOIN Users u ON u.user_id = p.user_id
	  ORDER BY p.user_id, p.category_id";
//$sql = "";
	$datos = $this->modelo->sqlPaginado($sql, $pagina);
	$datos["baseUrl"] = "/post/paginar";
	$datos["titulo"] = "Todos los Post ingresados";

	$this->render("post/index", $datos );

}


public function renderMyPosts() {

    $postModel = new \App\Models\Post();
    $userId = $this->auth->user()['user_id'];

    // Traer todos los posts del usuario
    $userPosts = $postModel->executeRawQuery(
        "SELECT post_id, title FROM Posts WHERE user_id = ?",
        [$userId]
    );

    // Renderizar la vista y pasar los posts
    $this->render('post/myPosts', [
        'title' => 'Mis Posts', 
        'userPosts' => $userPosts
    ]);
}

public function renderNewPost(){
    
     $categoryModel = new \App\Models\Categoria();
    $categories = $categoryModel->all();

    // Pasar errores o mensajes de éxito (si existen)
    $errors = $this->session->get('errors') ?? [];
    $success = $this->session->get('success') ?? null;

    // Limpiamos los mensajes de sesión para que no se repitan
    $this->session->remove('errors');
    $this->session->remove('success');

    $this->render('post/newPost', [
        'categories' => $categories,
        'errors' => $errors,
        'success' => $success
    ]);
	}
public function createPost()
{
    $user_id = $this->auth->user()['user_id'];
    $category_id = $this->input('Category');
    $title = $this->input('title');
    $content = $this->input('content');

    $errors = $this->validate([
        'title'   => 'required|min:3',
        'content' => 'required|min:20',
        'Category' => 'required|numeric'
    ]);

    if (!empty($errors)) {
        $this->session->set('errors', $errors);
        return $this->redirect('/post/newPost');
    }

    $postModel = new \App\Models\Post();
    $postModel->create([
        'user_id' => $user_id,
        'category_id' => $category_id,
        'title' => $title,
        'content' => $content
    ]);

    $this->session->set('success', 'Has realizado un posteo exitosamente.');
    $this->redirect('/post/newPost');
}

public function renderDeletePost() {

    $postModel = new \App\Models\Post();
    $userId = $this->auth->user()['user_id'];

    // Traer todos los posts del usuario
    $userPosts = $postModel->executeRawQuery(
        "SELECT post_id, title FROM Posts WHERE user_id = ?",
        [$userId]
    );

    // Renderizar la vista y pasar los posts
    $this->render('post/deletePost', [
        'userPosts' => $userPosts
    ]);
}

  public function deletePost() {
        $post_id = $this->input('post_id');

        if (!$post_id) {
            $this->session->flash('error', 'Debes indicar un ID de post válido.');
            return $this->redirect('/post/deletePost');
        }

        $postModel = new Post();

        // Verificar que el post pertenece al usuario logueado
        $user_id = $this->auth->user()['user_id'];
        $post = $postModel->find(['post_id' => $post_id, 'user_id' => $user_id]);

        if (!$post) {
            $this->session->flash('error', 'Post no encontrado o no te pertenece.');
            return $this->redirect('/post/deletePost');
        }

        // Eliminar el post
        $deleted = $postModel->deleteByPostId($post_id);
        if ($deleted) {
            $this->session->flash('success', 'El post se eliminó correctamente.');
        } else {
            $this->session->flash('error', 'No se encontró el post o no se pudo eliminar.');
        }
        $this->redirect('/post/deletePost');
    }

}
