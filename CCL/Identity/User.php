<?php


namespace SDTech\CCL\Identity;


class User
{
    public int $userId;
    public int $localityId;
    public string $name;
    protected string $userType;
    protected bool $emailVerified;

    public function __construct(int $userId, int $localityId, string $name, string $userType, bool $emailVerified)
    {
        $this->userId = $userId;
        $this->localityId = $localityId;
        $this->name = $name;
        $this->userType = $userType;
        $this->emailVerified = $emailVerified;
    }

    /**
     * @return bool
     */
    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }
}