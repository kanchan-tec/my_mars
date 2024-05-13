<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;


class CustomUserProvider extends EloquentUserProvider
{

    public function retrieveByCredentials(array $credentials)
    {
        if (isset($credentials['passcode'])) {
            unset($credentials['passcode']);
        }

        return parent::retrieveByCredentials($credentials);
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['passcode'];
        return $this->hasher->check($plain, $user->getAuthPassword());
    }

}
?>
