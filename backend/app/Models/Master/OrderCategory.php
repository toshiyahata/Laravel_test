<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class OrderCategory extends Model
{
    protected $table = 'dbo.T受注カテゴリ区分';
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