<h2>Tus publicaciones</h2>

<?php if (empty($userPosts)): ?>
    <p>No tenés publicaciones aún.</p>
<?php else: ?>
    <ul>
        <?php foreach ($userPosts as $post): ?>
            <li>
                <strong>ID:</strong> <?= $post['post_id'] ?> |
                <strong>Título:</strong> <?= htmlspecialchars($post['title']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/post/deletePost" method="POST">
    <label for="post_id">ID de posteo a eliminar:</label>
    <input type="number" name="post_id" id="post_id" required>

    <button type="submit">Eliminar post</button>
</form>