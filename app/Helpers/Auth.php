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

if (! function_exists('AuthRevoke')) {
    function AuthRevoke() {
        return request()->user()->tokens()->delete();
    }
}

if (! function_exists('AuthUser')) {
    function AuthUser($key) {
        return auth()->user()->{$key};
    }
}
