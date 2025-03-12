<?php

namespace App\Enum;

enum RegistrationStatusEnum: string
{
    case PENDING = 'Pending';
    case PAID = 'Paid';
    case CONFIRM = 'Confirm';
    case INVALID = 'Invalid';
    case EXPIRED = 'Expired';
}
