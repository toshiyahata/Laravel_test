<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'dbo.M会計部門';
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

    public function  locationName()
    {
        return $this->hasOne(Location::class, '事業所コード', '事業所コード');
    }
}