<?php

if (! function_exists('AuthCreateToken')) {
    function AuthCreateToken($name="auth_token",$abilities=['*']) {
        return request()->user()->createToken($name,$abilities)->plainTextToken;
    }
}

if (! function_exists('AuthTokenCan')) {
    function AuthTokenCan($ability="*") {
        return request()->user()->tokenCan($ability);
    }
}
