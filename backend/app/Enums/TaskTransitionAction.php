<?php

namespace App\Enums;

enum TaskTransitionAction: string
{
    case Created = 'created';
    case Advanced = 'advanced';
    case SentBack = 'sent_back';
    case Held = 'held';
    case Closed = 'closed';
    case Commented = 'commented';
    case Assigned = 'assigned';
}
