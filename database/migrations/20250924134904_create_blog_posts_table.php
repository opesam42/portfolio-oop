<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBlogPostsTable extends AbstractMigration
{
   
    public function change(): void
    {
        $table = $this->table('blog_posts');
        if(!$table->exists()){
            $table->addColumn('title', 'string', ['limit' => 255])
                ->addColumn('link', 'string', ['limit' => 255])
                ->addColumn('published_at', 'datetime')
                ->addColumn('content', 'text', ['null' => true])
                ->create();
        }
    }
}
