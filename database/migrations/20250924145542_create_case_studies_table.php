<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCaseStudiesTable extends AbstractMigration
{
    
    public function change(): void
    {
        $table = $this->table('case_studies');
        if(!$table->exists()){
            $table->addColumn('title', 'string', ['limit' => 50])
                ->addColumn('date_posted', 'datetime')
                ->addColumn('date_modified', 'datetime')
                ->addColumn('cover_image', 'string', ['limit' => 255, 'null' => true])
                ->addColumn('description', 'string', ['limit' => 255])
                ->addColumn('content', 'text')
                ->addColumn('project_type', 'string', ['limit' => 50])
                ->addColumn('slug', 'string', ['limit' => 50])
                ->addColumn('is_visible', 'boolean')
                ->addColumn('design_link', 'string', ['limit' => 255])
                ->addColumn('live_site_link', 'string', ['limit' => 255])
                ->addColumn('github_link', 'string', ['limit' => 255])
                ->create();
        }
    }
}
