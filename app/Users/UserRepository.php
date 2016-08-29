<?php

namespace App\Users;

use Auth, Hash;
use App\Services\EloquentRepository;
use Laravel\Socialite\Two\User as SocialUser;

class UserRepository extends EloquentRepository
{
    /**
     * Eloquent model for repository
     *
     * @var string
     */
    protected $model = 'App\Users\User';

    /**
     * Create or update the user by data from a social network provider
     *
     * @param  \Laravel\Socialite\Two\User $socialUser
     * @return \Varewo\Users\User
     */
    public function createOrUpdateFromSocial(SocialUser $socialUser, $provider)
    {
        $user      = $this->where('email', $socialUser->email)->first();
        $firstName = array_get($socialUser->user, 'first_name', array_get($socialUser->user, 'name.givenName', object_get($socialUser, 'name')));
        $lastName  = array_get($socialUser->user, 'last_name',  array_get($socialUser->user, 'name.familyName'));
        $avatar    = object_get($socialUser, 'avatar');

        if ($user)
        {
            $user->update([
                'email'      => $socialUser->email,
                'first_name' => $firstName,
                'last_name'  => $lastName,
            ]);
            if ( ! $user->avatar and $avatar) $user->update(['avatar' => $avatar]);
        }
        else
        {
            $user = $this->create([
                'email'         => $socialUser->email,
                'password'      => bcrypt(uniqid()),
                'first_name'    => $firstName,
                'last_name'     => $lastName,
                'social_avatar' => object_get($socialUser, 'avatar'),
            ]);
        }

        // Update the social provider ID
        if     ($provider == "facebook") $user->update(['facebook_id' => object_get($socialUser, 'id')]);
        elseif ($provider == "google")   $user->update(['google_id'   => object_get($socialUser, 'id')]);
        elseif ($provider == "github")   $user->update(['github_id'   => object_get($socialUser, 'id')]);

        return $user;
    }
}
