<?php

namespace App\Policies;

use App\User;
use App\article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before($user, $ability) {
        if($user->is_admin==1 || $user->is_editor==1) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function view(User $user, article $article)
    {
        return $user->id == $article->author_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function update(User $user, article $article)
    {
        return $user->id == $article->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function delete(User $user, article $article)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function restore(User $user, article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\article  $article
     * @return mixed
     */
    public function forceDelete(User $user, article $article)
    {
        //
    }
}
