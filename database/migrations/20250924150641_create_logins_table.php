<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLoginsTable extends AbstractMigration
{
    public function change(): void
    {
        // Define the logins table, but only create if it does not exist
        $table = $this->table('logins', ['id' => 'id']);
        if (!$table->exists()) {
            $table->addColumn('username', 'string', ['limit' => 10])
                  ->addColumn('password', 'string', ['limit' => 255])
                  ->create();
        }
    }
}
