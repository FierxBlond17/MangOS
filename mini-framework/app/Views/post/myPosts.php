<h1><?=$title?></h1>
<?php if (empty($userPosts)): ?>
    <p>No tenés publicaciones aún.</p>
<?php else: ?>
    <ul>
        <?php foreach ($userPosts as $post): ?>
            <li>
                <strong>ID:</strong> <?= $post['post_id'] ?> |
                <strong>Título:</strong> <?= htmlspecialchars($post['title']) ?>
            </li>

            <p><a href="/post/deletePost">eliminar post</a></p>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<p><a href="/dashboard">← Volver al dashboard</a></p>