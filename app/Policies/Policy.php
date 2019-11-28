<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
        // If user has the permission of 'manage_content', give the authentication.
        if ($user->can('manage_contents')) {
            return true;
        }
	}
}
