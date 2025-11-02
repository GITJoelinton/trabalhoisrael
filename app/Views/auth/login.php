<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Entrar no sistema</h2>
<?php if (!empty($error)): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="/login.php">
    <label>Nome de usuário:<br><input type="text" name="username" required></label><br><br>
    <label>Senha:<br><input type="password" name="password" required></label><br><br>
    <button type="submit">Entrar</button>
</form>
<?php include __DIR__ . '/../layouts/footer.php'; ?>