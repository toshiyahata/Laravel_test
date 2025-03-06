<?php

namespace App\MyDefined\ValueObject;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ValueObject
{
    public $value;
    static $ITEM_NAME;
    static $DEFAULT;
    static $SELECTS;

    protected function __construct(mixed $value)
    {
        $this->value = $value === '' ? null : $value;
    }

    public function v()
    {
        return $this->value;
    }

    public function getName(){
        // 子クラスのstaticプロパティを取得するためにstatic::を使う
        return static::$ITEM_NAME;
    }

    // 必須チェック
    public function required(){
        if(is_null($this->value)){
            return static::$ITEM_NAME . "は必須です。";
        }
        return '';
    }

    // 文字数チェック
    public function length(int $maxLength){
        $i = fn($v) => $v;

        if(!is_null($this->value)){
            if(mb_strlen($this->value) > $maxLength){
                return "{$this->getName()} は {$i(strval($maxLength))} 文字以下で入力してください。";
            }
        }
        return '';
    }

    // 数値境界チェック
    public function numeric(int|float $min = 0, int|float $max = PHP_INT_MAX){
        $i = fn($v) => $v;

        if(!is_null($this->value)){
            if($this->value < $min || $this->value > $max){
                if($max != PHP_INT_MAX) return "{$this->getName()} は {$i(strval($min))} 以上 {$i(strval($max))} 以下で入力してください。";
                else return "{$this->getName()} は {$i(strval($min))} 以上で入力してください。";
            }
        }
        return '';
    }

    // 正規表現チェック
    protected function match(string $pattern, string $output){
        if(!is_null($this->value)){
            if(!preg_match($pattern, $this->value)){
                return "{$this->getName()}は「{$output}」で指定してください。";
            }  
        };
        return '';
    }

    // リストチェック
    public function list(array $list){
        if(!is_null($this->value)){
            if(!in_array($this->value, $list)){
                return "リストにない値です。開発担当者にお問い合わせください。{$this->getName()}:{$this->value}";
            }
        };
        return '';
    }

    // UUIDチェック
    protected function uuid(){
        if(!is_null($this->value)){
            if(!Str::isUuid($this->value)){
                return "IDの形式が不正です。{$this->getName()}:{$this->value}";
            }
        };
        return '';
    }

    // 日時チェック
    protected function datetime(){
        if(!is_null($this->value)){
            if(!strtotime($this->value)){
                return "日付の形式が不正です。{$this->getName()}:{$this->value}";
            }

            $carbon = new Carbon($this->value);
            $this->value = $carbon->format('Y-m-d H:i:s');
        };
        return '';
    }

    // Jsonチェック
    protected function json(){
        if(!is_null($this->value)){
            if(!json_validate($this->value)){
                return "{$this->getName()}はjson形式で入力してください。";
            }

            $this->value = json_decode($this->value, true);
        }
        return '';
    }
}
?>