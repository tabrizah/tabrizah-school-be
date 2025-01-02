<?php

namespace App\Enum;

enum EnumSystemLogAction: string
{
    // Create enum "create", "update", "delete", "view", "send", "etc"
    case Create = 'create';
    case Update = 'update';
    case Delete = 'delete';
    case View = 'view';
    case Send = 'send';
    case Etc = 'etc';
}
