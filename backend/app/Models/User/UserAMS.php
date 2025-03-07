<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserAMS extends Model
{
    protected $table = 'dbo.T_users';

    protected $primaryKey = 'ユーザーID';

    protected $created_at = '作成日';
    protected $updated_at = '更新日';

    public $timestamps = 'FGC_CreateDate';
    public $incrementing = 'FGC_LastModifyDate';

    protected $connection = 'FGC1';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}