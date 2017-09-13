<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $model = new \framework\models\UserModel();

        for ($i = 0; $i < 50; $i++) {
            $model->create(
                [
                    'email' => $faker->safeEmail(),
                    'name' => $faker->lastName().','.$faker->firstName(),
                    'birth_date' => $faker->dateTimeBetween()->format('Y-m-d H:i:s')
                ]
            );
        }
    }
}
