<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTentativasLoginTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('tentativas_login', ['id' => true, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'signed' => false]);
        $table->addColumn('username', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('ip_address', 'string', ['limit' => 45, 'null' => true])
              ->addColumn('tentativa_em', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addIndex(['username'], ['name' => 'idx_username_tentativa'])
              ->addIndex(['ip_address'], ['name' => 'idx_ip_tentativa'])
              ->create();
    }
}