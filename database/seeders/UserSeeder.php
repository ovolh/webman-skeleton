<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [];
        $data[] = [
            'username'      => 'webman',
            'password'      => password_hash('123456', PASSWORD_DEFAULT),
            'email'         => 'webman@webman.com',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'username'      => $faker->userName,
            'password'      => password_hash('123456', PASSWORD_DEFAULT),
            'email'         => $faker->email,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];
        $this->table('users')->truncate();
        $this->insert('users', $data);
    }
}
