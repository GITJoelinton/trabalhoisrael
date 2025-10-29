<?php $this->layout('layouts/main', ['title' => 'Dashboard']) ?>

<?php $this->start('body') ?>
    <h2>Bem-vindo, <?= $this->e($username ?? 'Usuário') ?>!</h2>
    
    <?php 
    
    if (isset($_GET['success']) && $_GET['success'] === 'updated'): 
    ?>
        <p class="success"> Seu perfil foi atualizado com sucesso.</p>
    <?php endif; ?>

    <p>Este é o seu painel de controle simples.</p>

    <h3>Opções do Usuário:</h3>
    <ul>
        <li><a href="/profile/edit">Atualizar Nome de Usuário e Senha</a></li>
        <li>
            <form method="POST" action="/profile/delete" style="display:inline;">
                <button type="submit" onclick="return confirm('Tem certeza que deseja DELETAR permanentemente sua conta? Esta ação é irreversível.')" style="color: red; background: none; border: none; cursor: pointer; padding: 0;">Excluir Conta</button>
            </form>
        </li>
    </ul>

    <p><a href="/logout">Sair do Sistema</a></p>
<?php $this->stop() ?>