<?php 
namespace App\Controllers;
use App\Core\Controller;
use App\Models\User;

class UpdateUserController extends Controller {
     public function updateUser() {
        // Obtener usuario actual desde la sesión
        $user = $this->auth->user();
        $userId = $user['user_id'];

        // Obtener datos del formulario (POST)
        $newEmail = $_POST['email'] ?? null;
        $newName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $passwordConfirm = $_POST['password_confirm'] ?? null;

        // Validaciones básicas
        if (!$newEmail || !$newName) {
            $this->session->flash('error', 'Email y nombre son obligatorios.');
            return $this->redirect('/updateUser');
        }

        if ($password && $password !== $passwordConfirm) {
            $this->session->flash('error', 'Las contraseñas no coinciden.');
            return $this->redirect('/updateUser');
        }

        // Preparar datos a actualizar
        $data = [
            'email' => $newEmail,
            'username'  => $newName
        ];

        // Si el usuario puso contraseña, actualizarla
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Actualizar usuario en la base de datos
        $userModel = new User();
        $userModel->updateUser($userId, $data);

        // Actualizar sesión con datos actualizados
        $updatedUser = $userModel->findById($userId);
        $this->auth->setUser($updatedUser); // o setUser() si lo agregás

        // Mensaje de éxito y redirección
        $this->session->flash('success', 'Tu perfil ha sido actualizado correctamente.');
        return $this->redirect('/home');
    }
}
?>