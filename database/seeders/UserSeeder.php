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
            'password'      => '$2y$07$3SSS4Kn97oPA6sEPC5rxxemmXe4e1n8dKLLu6XhVmxTHufSjJcEL2',
            'email'         => 'webman@webman.com',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];
        $data[] = [
            'username'      => $faker->userName,
            'password'      => '$2y$07$3SSS4Kn97oPA6sEPC5rxxemmXe4e1n8dKLLu6XhVmxTHufSjJcEL2',
            'email'         => $faker->email,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];
        $this->table('users')->truncate();
        $this->insert('users', $data);
    }
}
