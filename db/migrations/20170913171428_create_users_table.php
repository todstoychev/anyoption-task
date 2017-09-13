<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        $this->table('users')
             ->addColumn('name', 'string')
             ->addColumn('email', 'string')
             ->addColumn('birth_date', 'datetime')
             ->save()
        ;
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
