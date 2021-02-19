<?php

namespace App\Repositories;

use App\Constants\Average;
use App\Models\UserRole;
use App\User;
use \Carbon\Carbon;

class UserRepo extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function average($option)
    {
        switch ($option) {
            case $option == Average::LAST_24_HOURS:
                return $this->filter([
                    'created_at' => ['value' => Carbon::now()->subDays(1), 'operator' => '>=']
                ], ['count' => 1]);
            case $option == Average::LAST_WEEK:
                return $this->filter([
                    'created_at' => [
                        ['value' => Carbon::now()->startOfWeek()->subWeek(), 'operator' => '>='],
                        ['value' => Carbon::now()->startOfWeek(), 'operator' => '<'],
                    ],
                ], ['count' => 1]);
            case $option == Average::LAST_MONTH:
                return $this->filter([
                    'created_at' => [
                        ['value' => Carbon::now()->startOfMonth()->subMonth(), 'operator' => '>='],
                        ['value' => Carbon::now()->startOfMonth(), 'operator' => '<'],
                    ],
                ], ['count' => 1]);
            case $option == Average::LAST_3_MONTHS:
                return $this->filter([
                    'created_at' => [
                        ['value' => Carbon::now()->startOfMonth()->subMonth(3), 'operator' => '>='],
                        ['value' => Carbon::now()->startOfMonth(), 'operator' => '<'],
                    ],
                ], ['count' => 1]);
            case $option == Average::LAST_YEAR:
                return $this->filter([
                    'created_at' => [
                        ['value' => Carbon::now()->startOfYear()->subYear(1), 'operator' => '>='],
                        ['value' => Carbon::now()->startOfYear(), 'operator' => '<'],
                    ],
                ], ['count' => 1]);
            default:
                return [];
        }
    }

    public function addRole($user, $role)
    {
        return UserRole::create(['user_id' => $user, 'role_id' => $role]);
    }
}
