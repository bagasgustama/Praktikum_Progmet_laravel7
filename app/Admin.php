<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function notifications()
        {
            return $this->morphMany(AdminNotification::class, 'notifiable')->orderby('created_at', 'desc');
        }

    public function createNotif($data){
        $notif = new AdminNotifications();
        $notif->type = 'App\Notifications\AdminNotification';
        $notif->notifiable_type = 'App\User';
        $notif->notifiable_id = $this->id;
        $notif->data = $data;
        $notif->save();
    }
}