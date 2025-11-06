<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'Users';
	protected $primaryKey = "user_id";

    //busca en la base de datos un usuario por su email
    public function findByEmail($email) {
        $query = $this->db->query(
            "SELECT * FROM {$this->table} WHERE email = ? LIMIT 1", 
            [$email]
        );
        return $query->fetch();
    }

    //busca en la base de datos un usuario por su ID
    public function findById($userId) {
    $query = $this->db->query(
        "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ? LIMIT 1",
        [$userId]
    );
    return $query->fetch();
}
    // Elimina un usuario por su ID
    public function deleteById($userId) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $this->db->query($sql, [$userId]);
    }

    //Actualiza los datos de un usuario
    public function updateUser($userId, $data) { 
        $setParts = [];
        $params = [];
        foreach ($data as $column => $value) {
            $setParts[] = "{$column} = ?";
            $params[] = $value;
        }
        $params[] = $userId; // Agregar el ID del usuario al final de los parámetros

        $sql = "UPDATE {$this->table} SET " . implode(", ", $setParts) . " WHERE {$this->primaryKey} = ?";
        $this->db->query($sql, $params);
    }
}
