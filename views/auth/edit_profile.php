<?php $this->layout('layouts/main', ['title' => 'Atualizar Perfil']) ?>

<?php $this->start('body') ?>
    <h2>Atualizar Nome de Usuário e Senha</h2>
    <form method="post" action="/profile/update">
        <label>Novo Nome de Usuário<br>
            <input name="username" value="<?= $this->e($username) ?>" required>
            <?php if (!empty($errors['username'])): ?><div class="error"><?= $this->e($errors['username']) ?></div><?php endif; ?>
        </label><br><br>

        <label>Nova Senha (Mínimo 6 caracteres)<br>
            <input name="senha" type="password" required>
            <?php if (!empty($errors['senha'])): ?><div class="error"><?= $this->e($errors['senha']) ?></div><?php endif; ?>
        </label><br><br>

        <?= \App\Core\Csrf::input() ?>
        <button type="submit">Atualizar Perfil</button>
    </form>
    <p><a href="/dashboard">Voltar para o Dashboard</a></p>
<?php $this->stop() ?>