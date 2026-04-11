<?php

namespace App\Enums;

enum ActivityLogType: string
{
    case TaskCreated = 'task_created';
    case StepCompleted = 'step_completed';
    case TaskAssigned = 'task_assigned';
    case TaskClosed = 'task_closed';
    case CommentAdded = 'comment_added';
    case TaskRejected = 'task_rejected';
    case TaskMoved = 'task_moved';
    case SettingsUpdated = 'settings_updated';
    case UserLoggedIn = 'user_logged_in';
}
