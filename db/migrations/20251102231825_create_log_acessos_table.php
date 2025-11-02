<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLogAcessosTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('log_acessos', ['id' => true, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'signed' => false]);
        $table->addColumn('user_id', 'integer', ['null' => true, 'signed' => false])
              ->addColumn('tipo_acao', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('detalhes', 'text', ['null' => true])
              ->addColumn('ip_address', 'string', ['limit' => 45, 'null' => true])
              ->addColumn('user_agent', 'string', ['limit' => 255, 'null' => true])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();

        if ($this->hasTable('users')) {
            $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'SET_NULL'])
                  ->update();
        }
    }
}