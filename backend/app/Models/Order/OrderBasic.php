<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderBasic extends Model
{
    protected $table = 'dbo.B受注_基本';
    protected $primaryKey = '受注番号';

    protected $created_at = '作成日';
    protected $updated_at = '更新日';

    public $timestamps = false;
    public $incrementing = false;

    protected $connection = 'Square';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}