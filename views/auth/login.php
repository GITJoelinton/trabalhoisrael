<?php $this->layout('layouts/main', ['title' => 'Login']) ?>

<?php $this->start('body') ?>

<?php if (($this->e($success ?? '') === 'registered')): ?>
    <p class="success">Cadastro realizado com sucesso! Faça login abaixo.</p>
<?php endif; ?>

<?php if (!empty($errors['login'])): ?>
    <p class="error"><?= $this->e($errors['login']) ?></p>
<?php endif; ?>

<form method="post" action="/login/auth">
    <label>Email<br>
        <input name="email" value="<?= $this->e($old['email'] ?? '') ?>" required>
    </label><br><br>

    <label>Senha<br>
        <input name="senha" type="password" required>
        <?php if (!empty($errors['senha'])): ?>
            <div class="error"><?= $this->e($errors['senha']) ?></div>
        <?php endif; ?>
    </label><br><br>

    <?= \App\Core\Csrf::input() ?>
    <button type="submit">Entrar</button>
</form>

<p>Ainda não tem conta? <a href="/register">Cadastre-se</a></p>

<?php $this->stop() ?>
