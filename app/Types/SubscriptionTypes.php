<?php

namespace App\Types;

class SubscriptionTypes
{
    public const STARTER_MONTHLY_STRING = 'Starter Monthly';
    public const PRO_MONTHLY_STRING = 'Pro Monthly';
    public const PRO_YEARLY_STRING = 'Pro Yearly';

    public const PLAN_STRING_MAP = [
        self::STARTER_MONTHLY_STRING,
        self::PRO_MONTHLY_STRING,
        self::PRO_YEARLY_STRING,
    ];
}
