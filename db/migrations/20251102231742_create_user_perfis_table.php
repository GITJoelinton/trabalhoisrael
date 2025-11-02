<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserPerfisTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_perfis', ['id' => false, 'primary_key' => ['user_id', 'perfil_id'], 'engine' => 'InnoDB']);
        $table->addColumn('user_id', 'integer', ['null' => false, 'signed' => false])
              ->addColumn('perfil_id', 'integer', ['null' => false, 'signed' => false])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();

        if ($this->hasTable('users') && $this->hasTable('perfis')) {
            $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
                  ->addForeignKey('perfil_id', 'perfis', 'id', ['delete' => 'CASCADE'])
                  ->update();
        }
    }
}