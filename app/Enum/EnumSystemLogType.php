<?php

namespace App\Enum;

enum EnumSystemLogType: string
{
    // Create enum "system", "user-activity", "notification", "authentication", "error"
    case System = 'system';
    case UserActivity = 'user-activity';
    case Notification = 'notification';
    case Error = 'error';
}
