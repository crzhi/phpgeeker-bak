<?php

namespace Modules\Mall\Policies;

use Modules\Mall\Models\Order;
use Modules\Passport\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class OrderPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Order $order)
    {
        return $order->user_id == $user->id;
    }
}
