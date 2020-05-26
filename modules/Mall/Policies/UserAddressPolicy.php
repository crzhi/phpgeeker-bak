<?php

namespace Modules\Mall\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Modules\Passport\Models\User;
use Modules\Mall\Models\UserAddress;

class UserAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function own(User $user, UserAddress $address)
    {
        return $address->user_id == $user->id;
    }
}
