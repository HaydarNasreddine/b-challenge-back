<?php

use App\Constants\Roles;
use App\Repositories\UserRepo;
use App\Services\UserService;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    public function __construct()
    {
        $this->userService = (new UserService(new UserRepo(new User())));
    }

    private function createUser($data, $role)
    {
        $user = $this->userService->filter(['email' => $data['email']]);
        if (count($user) == 0) {
            $user = $this->userService->create($data);
            $this->userService->addRole($user->id, $role);
        }
    }

    public function run()
    {
        $data = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@bchallenge.com',
            'password' => 'admin_admin',
        ];
        $this->createUser($data, Roles::ADMIN);

        for ($i = 1; $i <= 1000; $i++) {
            $minutes = $i * 300;
            $data = [
                'first_name' => 'user_' . $i,
                'last_name' => 'user_' . $i,
                'email' => 'user_' . $i . '@bchallenge.com',
                'password' => 'password_user_' . $i,
                'created_at' => date("Y-m-d H:i:s", strtotime("-{$minutes} minutes", strtotime(date('Y-m-d H:i:s')))),
                'updated_at' => date("Y-m-d H:i:s", strtotime("-{$minutes} minutes", strtotime(date('Y-m-d H:i:s'))))
            ];
            $this->createUser($data, Roles::CUSTOMER);
        }
    }
}
