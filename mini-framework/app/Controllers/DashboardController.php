<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;


class DashboardController extends Controller {
    public function index() {
      
        return $this->render('dashboard/index', [
            'title' => 'Dashboard',
            'username' => $this->auth->user()
        ]);
    }
    
    public function show($params = []) {
        if (!$this->auth->check()) {
            $this->redirect('/login');
        }

        return $this->render('dashboard/show', [
            'title' => 'Detalles de Usuario',
            'username' => $this->auth->user(),
            'userId' => $params['id'] ?? null
        ]);
    }

    public function renderUpdateUser() {

        if (!$this->auth->check()) {
            $this->redirect('/login');
        }

        return $this->render('dashboard/updateUser', [
            'title' => 'Actualizar Perfil',
            'username' => $this->auth->user()
        ]);
        
    }
        
    
    
}
