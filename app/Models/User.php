<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * @return string
     *
     * @todo Migrate this to a user creation event
     */
    public function getExternalCustomerId(): string
    {
        return config('braintree.gateway.sandbox_customer_id');
    }
}
