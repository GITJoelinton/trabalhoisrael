<?php $this->layout('layouts/main', ['title' => 'Cadastro de Usuário']) ?>

<?php $this->start('body') ?>

    <?php if (($this->e($success ?? '') === 'registered')): ?>
        <p class="success">Cadastro realizado com sucesso! Faça login abaixo.</p>
    <?php endif; ?>

    <?php if (!empty($errors['nome'])): ?><div class="error"><?= $this->e($errors['nome']) ?></div><?php endif; ?>
    <?php if (!empty($errors['email'])): ?><div class="error"><?= $this->e($errors['email']) ?></div><?php endif; ?>
    <?php if (!empty($errors['senha'])): ?><div class="error"><?= $this->e($errors['senha']) ?></div><?php endif; ?>

    <form method="post" action="/register/create">
        <label>Nome<br>
            <input name="nome" value="<?= $this->e($old['nome'] ?? '') ?>" required>
        </label><br><br>

        <label>Email<br>
            <input name="email" value="<?= $this->e($old['email'] ?? '') ?>" required>
        </label><br><br>

        <label>Senha<br>
            <input name="senha" type="password" required>
        </label><br><br>

        <?= \App\Core\Csrf::input() ?>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem conta? <a href="/login">Faça Login</a></p>

<?php $this->stop() ?>
