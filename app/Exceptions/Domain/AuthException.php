<?php

namespace App\Exceptions\Domain;

use App\Exceptions\BusinessException;

class AuthException extends BusinessException
{
    public static function invalidCredential(): self
    {
        return new self('Password salah.', 401);
    }

    public static function userNotFound(): self
    {
        return new self('User tidak ditemukan.', 404);
    }

    public static function inactiveUser(): self
    {
        return new self('User tidak aktif.', 403);
    }

    public static function noLocation(): self
    {
        return new self('User tidak terdaftar di lokasi manapun.', 403);
    }
}
