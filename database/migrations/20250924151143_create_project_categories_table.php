<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProjectCategoriesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('project_categories', ['id' => 'id']);
        if (!$table->exists()) {
            $table->addColumn('name', 'string', ['limit' => 100])
                  ->addIndex(['name'], ['unique' => true])
                  ->addColumn('description', 'text', ['null' => true])
                  ->addColumn('created_at', 'timestamp', [
                      'default' => 'CURRENT_TIMESTAMP',
                      'null' => true
                  ])
                  ->addColumn('updated_at', 'timestamp', [
                      'default' => 'CURRENT_TIMESTAMP',
                      'update' => 'CURRENT_TIMESTAMP',
                      'null' => true
                  ])
                  ->create();
        }
    }
}
