<?php

namespace Modules\Passport\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OAuthUser extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'passport_oauth_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'openid', 'token', 'subscribe'
    ];
}
