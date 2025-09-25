<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClientMessageTable extends AbstractMigration
{
    public function change(): void
    {
        // Define table only if it does not exist
        $table = $this->table('client_message', ['id' => 'id']);
        if (!$table->exists()) {
            $table->addColumn('date_sent', 'datetime')
                  ->addColumn('name', 'string', ['limit' => 50])
                  ->addColumn('email', 'string', ['limit' => 100])
                  ->addColumn('mobile', 'string', ['limit' => 20])
                  ->addColumn('message', 'text')
                  ->create();
        }
    }
}
