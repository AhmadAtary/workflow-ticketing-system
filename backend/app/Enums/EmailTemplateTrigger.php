<?php

namespace App\Enums;

enum EmailTemplateTrigger: string
{
    case TaskAssigned = 'task_assigned';
    case StepCompleted = 'step_completed';
    case TaskOverdue = 'task_overdue';
    case TaskRejected = 'task_rejected';
    case TaskCompleted = 'task_completed';
}
