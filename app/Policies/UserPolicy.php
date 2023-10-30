<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy
{
    use HandlesAuthorization;

    /*
     * @param User $user
     * @return bool
     */
    public function manager(User $user): bool
    {
        return $user->hasRole('manager');
    }

    /*
     * @param User $user
     * @return bool
     */
    public function agent(User $user): bool
    {
        return $user->hasRole('agent');
    }


}
