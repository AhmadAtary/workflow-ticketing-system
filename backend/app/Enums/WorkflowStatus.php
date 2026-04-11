<?php

namespace App\Enums;

enum WorkflowStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Draft = 'draft';
}
