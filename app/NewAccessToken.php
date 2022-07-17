<?php

namespace App;

use App\Models\PersonalAccessToken;
use Laravel\Sanctum\NewAccessToken as BaseNewAccessToken;

class NewAccessToken extends BaseNewAccessToken
{
    /**
     * Create a new access token result.
     *
     * @param  \Laravel\Sanctum\PersonalAccessToken  $accessToken
     * @param  string  $plainTextToken
     * @return void
     */
    public function __construct(PersonalAccessToken $accessToken, string $plainTextToken)
    {
        $this->accessToken = $accessToken;
        $this->plainTextToken = $plainTextToken;
    }
}
