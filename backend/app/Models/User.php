<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'dbo.M社員';
    protected $primaryKey = null;

    protected $created_at = null;
    protected $updated_at = null;

    public $timestamps = false;
    public $incrementing = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}