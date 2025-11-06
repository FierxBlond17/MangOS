<?php

namespace App\Models;
use App\Core\Model;

class Post extends Model {

    public function __construct() {
        $this->table = "Posts";       // nombre real de la tabla en tu DB
        $this->primaryKey = "post_id"; // clave primaria
        parent::__construct();         // llama al constructor del Model base
    }

    public function deleteByPostId($post_id){
    $sql = "DELETE FROM {$this->table} WHERE post_id = ?";
    $stmt = $this->db->query($sql, [$post_id]);
    return $stmt->rowCount();  // devuelve la cantidad de filas afectadas
    }
}
