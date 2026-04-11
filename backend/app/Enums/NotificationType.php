<?php

namespace App\Enums;

enum NotificationType: string
{
    case Assigned = 'assigned';
    case Moved = 'moved';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case Comment = 'comment';
    case Overdue = 'overdue';
}
