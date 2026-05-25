<?php

namespace App;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case DOIND = 'doing';
    case COMPLETED = 'completed';
}
