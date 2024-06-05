<?php

namespace App\Policies;

use App\Models\CourseForum;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseForumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view(User $user, CourseForum $courseForum)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return mixed
     */
    public function update(User $user, CourseForum $courseForum)
    {
        return $user->id == $courseForum->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return mixed
     */
    public function delete(User $user, CourseForum $courseForum)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return mixed
     */
    public function restore(User $user, CourseForum $courseForum)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return mixed
     */
    public function forceDelete(User $user, CourseForum $courseForum)
    {
        //
    }

    public function pin(User $user, CourseForum $courseForum)
    {
        return $courseForum->webinar->isOwner($user->id);
    }
}
