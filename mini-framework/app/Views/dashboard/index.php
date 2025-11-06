   <h1><?= $title?></h1>
    <p>Bienvenido <?= htmlspecialchars($username['username']) ?>.</p>
    
    <p><a href="/dashboard/<?= $username['user_id'] ?>">Ver detalles de mi perfil</a></p>

