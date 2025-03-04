<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;

final class TestController extends Controller
{
    public function test(){
        $User = User::all();
        return json_decode(json_encode($User), JSON_UNESCAPED_UNICODE);
    }
}