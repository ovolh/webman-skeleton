<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', array('limit' => 20))
            ->addColumn('password', 'string', array('limit' => 40))
            ->addColumn('password_salt', 'string', array('limit' => 40))
            ->addColumn('email', 'string', array('limit' => 100))
            ->addColumn('first_name', 'string', array('limit' => 30))
            ->addColumn('last_name', 'string', array('limit' => 30))
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', array('null' => true))
            ->addIndex(array('username', 'email'), array('unique' => true))
            ->save();
    }
}
