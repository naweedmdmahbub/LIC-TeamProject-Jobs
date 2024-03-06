<?php

namespace App\Constants;

class Status
{
    public const DRAFT = 'draft';
    public const APPROVED = 'approved';
    public const ACTIVE = 'active';
    public const EXPIRED = 'expired';

    public const LIST = [
        self::DRAFT,
        self::APPROVED,
        self::ACTIVE,
        self::EXPIRED,
    ];
}
