<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\User;

class DeleteUser extends Controller{
    public function removeUser() {
    $user = $this->auth->user();
    $userId = $user['user_id'];

    // Eliminar el usuario de la base de datos
    $userModel = new User();
    $userModel->deleteById($userId);

    // Cerrar sesión del usuario
    $this->auth->logout();

    // Redirigir a la página de inicio con un mensaje
    $this->session->flash('success', 'Tu cuenta ha sido eliminada correctamente.');
    $this->redirect('/');
}
}

?>
