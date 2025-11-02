<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Sistema</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
<header>
  <h1>Sistema</h1>
  <nav>
    <?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>
    <?php if (!empty($_SESSION['user_name'])): ?>
      <span>Olá, <?= htmlspecialchars($_SESSION['user_name']) ?></span> | <a href="/logout.php">Sair</a>
    <?php endif; ?>
  </nav>
</header>
<hr>
