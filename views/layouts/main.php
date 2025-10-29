<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->e($title ?? 'Sistema de Login MVC') ?></title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 32px; }
    header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
    nav a { margin-right: 12px; }
    .error { color: #b30000; font-size: 14px; }
    .success { color: #008000; font-size: 14px; }
    input, button { padding:8px; margin-top: 4px; }
  </style>
</head>
<body>
  <header>
    <h1><?= $this->e($title ?? 'Sistema de Login') ?></h1>
    <nav>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/dashboard">Dashboard</a>
            <a href="/logout">Sair</a>
        <?php else: ?>
            <a href="/login">Login</a>
            <a href="/register">Cadastrar</a>
        <?php endif; ?>
    </nav>
  </header>
  
  <?= $this->section('body') ?>

</body>
</html>