<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
/* SoftDeletes is a way of deleting resources without actually deleting the data from the database.
 * What happens is that when the table is created, there will be a field called ‘deleted_at’ and
 * when a user tries to delete a task, the ‘deleted_at’ field will be populated with the current
 * date time. And so when fetches are made for resources, the ‘deleted’ resource will not be part
 * of the response
 */
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable. This means you can just pass an array
     * to the create function of the model with the data you want to get assigned.
     *
     * id – the unique auto-incrementing ID of the user.
     * name – the name of the user.
     * email – the email of the user.
     * password – used in authentication.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks () {
        return $this->hasMany(Task::class);
    }
}
