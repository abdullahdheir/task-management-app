<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case DOING = 'doing';
    case COMPLETED = 'completed';
}
