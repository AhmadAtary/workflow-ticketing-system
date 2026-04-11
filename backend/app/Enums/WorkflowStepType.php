<?php

namespace App\Enums;

enum WorkflowStepType: string
{
    case Action = 'action';
    case Approval = 'approval';
    case Review = 'review';
}
