<?php

namespace App\Constants;

class Status
{
    public const DRAFT = 'draft';
    public const APPROVED = 'approved';

    public const LIST = [
        self::DRAFT,
        self::APPROVED,
    ];
}
