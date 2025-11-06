<h1>Crear un nuevo post</h1>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="formContainer">
    <form action="/post/createPost" method="POST">
        <label for="Category">Elige una categoría:</label>
        <select id="Category" name="Category" required>
            <option value="">-- Selecciona una categoría --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat['category_id']) ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="title">Título:</label>
        <textarea id="title" name="title" rows="2" cols="50" required></textarea>

        <label for="content">Descripción:</label>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea>

        <input type="submit" value="Crear Post">
    </form>
</div>