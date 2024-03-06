<?php


namespace App\Repositories\MasterAdmin\User;


use App\Repositories\MasterAdmin\RepositoryContract;
use App\Role;
use App\Models\User;

class UserRepository extends RepositoryContract
{
    public function rolelist($search=null,$relation=null)
    {
        return Role::query()->record()->get();
    }

    public function userlist($search=null,$realtion=null)
    {
        return User::query()->get();
    }
}
