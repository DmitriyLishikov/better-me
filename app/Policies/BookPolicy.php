<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Book $book)
    {
        if($user->id === $book->user_id){
            return true;
        }

        if($user->role === 'admin'){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Book $book)
    {
        if($user->id === $book->user_id){
            return true;
        }

        if($user->role === 'admin'){
            return true;
        }

        return false;
    }

}
