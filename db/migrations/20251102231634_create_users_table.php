<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users', ['id' => true, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'signed' => false]);
        $table->addColumn('username', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('nome_completo', 'string', ['limit' => 150, 'null' => true])
              ->addColumn('email', 'string', ['limit' => 150, 'null' => true])
              ->addColumn('perfil_id', 'integer', ['default' => 1, 'null' => false, 'signed' => false])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addIndex(['username'], ['unique' => true])
              ->addIndex(['email'], ['unique' => true])
              ->create();

        if ($this->hasTable('perfis')) {
            $table->addForeignKey('perfil_id', 'perfis', 'id', ['delete' => 'RESTRICT'])
                  ->update();
        }
    }
}