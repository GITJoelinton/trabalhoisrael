<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePerfisTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('perfis', ['id' => true, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'signed' => false]);
        $table->addColumn('nome', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('descricao', 'string', ['limit' => 255, 'null' => true])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addIndex(['nome'], ['unique' => true])
              ->create();
    }
}