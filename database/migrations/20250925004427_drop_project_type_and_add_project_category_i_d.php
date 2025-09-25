<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DropProjectTypeAndAddProjectCategoryID extends AbstractMigration
{
   
    public function change(): void
    {
        $table = $this->table('case_studies');

        if ($table->hasColumn('project_type')) {
            $table->removeColumn('project_type')->update();
        }

        if (!$table->hasColumn('project_category_id')) {
            $table->addColumn('project_category_id', 'integer')->update();
        }

        if (!$table->hasForeignKey('project_category_id')) {
            $table->addForeignKey(
                'project_category_id',
                'project_categories',
                'id',
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE']
            )->update();
        }

    }
}
