<?php

namespace App\Models\Campaign;

use Illuminate\Database\Eloquent\Model;

class CampaignElement extends Model
{
    protected $table = 'dbo.Mキャンペーン_構成';
    protected $primaryKey = ['キャンペーン番号', '行番号'];

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