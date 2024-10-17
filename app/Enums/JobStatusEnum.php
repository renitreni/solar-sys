<?php

namespace App\Enums;

enum JobStatusEnum: string
{
    case CANCELLED = 'cancelled';
    case CANCELLED_INVOICED = 'cancelled invoice';
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in progress';
    case NOT_STARTED = 'not started';
    case ON_HOLD = 'on hold';
    case PENDING = 'pending';
    case SENT_TO_CLIENT = 'sent to client';
}
