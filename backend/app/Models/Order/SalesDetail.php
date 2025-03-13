<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    protected $table = 'dbo.C売上明細';
    protected $primaryKey = null;

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