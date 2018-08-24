<?php

namespace NtimYeboah\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The name of the table
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * Mass assignable fields
     * 
     * @var array
     */
    protected $fillable = ['full_name', 'email'];
}