    <h1><?= $title ?></h1>

    <?php if ($auth['check']): ?>
        <p>Bienvenido <?= htmlspecialchars($auth['user']['username']) ?></p>
        
    <p>Sabemos que usted tiene un nesecidades, para su buena suerte, aquí encontrara solucion a travez de esta app.</p>
    
    

    <?php else: ?>
        <p>Por favor <a href="/login">inicia sesión</a> para acceder al dashboard.</p>
    <?php endif; ?>

