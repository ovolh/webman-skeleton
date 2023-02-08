<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAdminUsersTable extends AbstractMigration
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
        $users = $this->table('admin_users');
        $users->addColumn('username', 'string', ['limit' => 20, 'default' => '', 'comment' => '用户名'])
            ->addColumn('password', 'string', ['default' => '', 'comment' => '密码'])
            ->addColumn('email', 'string', ['limit' => 100, 'default' => '', 'comment' => '邮箱'])
            ->addColumn('created_at', 'timestamp')
            ->addColumn('updated_at', 'timestamp')
            ->addColumn('deleted_at', 'timestamp', ['null' => true, 'comment' => '删除时间'])
            ->save();
    }
}
