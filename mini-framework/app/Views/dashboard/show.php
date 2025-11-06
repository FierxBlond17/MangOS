    <h1><?= $title?></h1>
    <p>ID de usuario: <?= $username['user_id'] ?? 'N/A' ?></p>
    <p>Nombre: <?= htmlspecialchars($username['username']) ?></p>
    <p>Email: <?= htmlspecialchars($username['email']) ?></p>

    <p><a href="/post/misPosts">Mis Posts</a></p>
    <a href="/updateUser">Actualizar mi cuenta</a>
    <p><a href="/removeUser"> Eliminar mi cuenta</a></p>
    <p><a href="/dashboard">← Volver al dashboard</a></p>
    
