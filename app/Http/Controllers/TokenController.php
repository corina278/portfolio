<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Support\Facades\Crypt;

class TokenController extends Controller
{
    public function getToken() {
        $token = Token::create();
        $secret = Crypt::encryptString($token->id);
        $token->update(['name' => $secret]);
        return 'portfolio.test/register?token=' . $token->name;
    }

    public function deleteAll() {
        Token::delete();
    }
}
