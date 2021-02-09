<?php

declare(strict_types=1);


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 * @package App\Models
 */
class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'admin';
    /**
     * @var string
     */
    protected $table = 'admins';
    /**
     * @var string
     */
    protected $primaryKey = 'admin_id';
    /**
     * @var string[]
     */
    protected $fillable = ['full_name', 'email', 'password'];
}
