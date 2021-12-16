<?php


namespace SDTech\CCL;


use SDTech\CCL\Identity\User;

class SecurityContext
{
    static User $user;

    /**
     * @return User
     */
    public static function getUser(): User
    {
        return self::$user;
    }

    /**
     * @param User $user
     */
    public static function setUser(User $user): void
    {
        self::$user = $user;
    }

}