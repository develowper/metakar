<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\Podcast;
use App\Models\Site;
use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;
use Termwind\Components\Dd;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {

        if ($user->role == 'go') {
            return true;
        }

    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, $item, $abort = true, $option = null)
    {

        if (!$user->is_active) {
            return abort(403, __("user_is_inactive"));
        }
        if ($user->is_blocked) {
            return abort(403, __("user_is_blocked"));
        }

        switch ($item) {
            case User::class  :
                if (in_array($user->role, ['ad',]))
                    return true;
                break;
            case Site::class  :
            case Business::class  :
            case Podcast::class  :
            case Video::class  :
                if (in_array($user->role, ['us', 'ad',]))
                    return true;
                break;
        }

        if ($abort)
            return abort(403, __("access_denied"));
        else return false;
    }

    public function edit(User $user, $item, $abort = true, $data = null)
    {
//        dd(request()->route()->parameter('site'));
        if ($user->is_blocked) {
            return abort(403, __("user_is_blocked"));
        }

        switch (true) {
            case $item instanceof User   :
                if (in_array($user->role, ['ad',]))
                    return true;
                break;
            case $item instanceof Site :
            case $item instanceof Business :
            case $item instanceof Podcast :
            case $item instanceof Video :
                return $user->role == 'us' && optional($item)->owner_id == $user->id || in_array($user->role, ['ad',]);
                break;
        }
        if ($abort)
            return abort(403, __("access_denied"));
        else return false;
    }

    public function update(User $user, $item, $abort = true, $data = null)
    {

        if (!$user->is_active) {
            return abort(403, __("user_is_inactive"));
        }
        if ($user->is_blocked) {
            return abort(403, __("user_is_blocked"));
        }

        if ($item && $item->status == 'block') {
            return abort(403, __("item_is_blocked"));
        }

        switch ($item) {
            case $item instanceof User  :
                if (in_array($user->role, ['ad',]))
                    return true;
                break;
            case $item instanceof Site  :
            case $item instanceof Business  :
            case $item instanceof Podcast  :
            case $item instanceof Video  :
                return $user->role == 'us' && optional($item)->owner_id == $user->id || in_array($user->role, ['ad',]);
                break;
        }
        if ($abort)
            return abort(403, __("access_denied"));
        else return false;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
