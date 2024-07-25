<?php

namespace app\enums;

final class UserRole
{
    public const string ADMIN = 'admin';
    public const string USER = 'user';
    public const string MANAGER = 'manager';


    public static function getArray(): array
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return array_values($reflectionClass->getConstants());
    }
}