<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Meu Perfil</h2>
<?php if (!empty($error)): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php if (!empty($success)): ?><div class="success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<table class="profile-table">
<tr><th>Nome:</th><td><?= htmlspecialchars($user['name']) ?></td></tr>
<tr><th>Nome de usuário:</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
<tr><th>Email:</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
<tr><th>Tipo:</th><td><?= htmlspecialchars($user['profile_id']) ?></td></tr>
<tr><th>Criado em:</th><td><?= htmlspecialchars($user['created_at']) ?></td></tr>
</table>

<h3>Alterar senha</h3>
<form method="post" action="/perfil.php?action=change_password" onsubmit="return confirm('Confirma alteração de senha?')">
    <label>Senha atual:<br><input type="password" name="current_password" required></label><br><br>
    <label>Nova senha:<br><input type="password" name="new_password" required></label><br><br>
    <label>Confirmar nova senha:<br><input type="password" name="confirm_password" required></label><br><br>
    <button type="submit">Alterar senha</button>
</form>

<h3>Excluir minha conta</h3>
<p>Para excluir sua conta digite seu nome de usuário e senha atual:</p>
<form method="post" action="/perfil.php?action=delete" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')">
    <label>Nome de usuário:<br><input type="text" name="confirm_username" required></label><br><br>
    <label>Senha:<br><input type="password" name="confirm_password" required></label><br><br>
    <button type="submit">Excluir minha conta</button>
</form>

<p><a href="/">Voltar ao painel</a></p>
<?php include __DIR__ . '/../layouts/footer.php'; ?>