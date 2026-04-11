<?php

namespace Database\Seeders;

use App\Enums\EmailTemplateTrigger;
use App\Enums\RoleName;
use App\Enums\SystemLanguage;
use App\Enums\TaskPriority;
use App\Enums\WorkflowStatus;
use App\Enums\WorkflowStepType;
use App\Models\EmailTemplate;
use App\Models\SystemSetting;
use App\Models\Team;
use App\Models\User;
use App\Models\Workflow;
use App\Services\Tasks\TaskLifecycleService;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $operations = Team::query()->create([
            'name' => 'Operations',
            'description' => 'Intake and coordination for incoming work.',
            'color' => '#0F766E',
        ]);

        $compliance = Team::query()->create([
            'name' => 'Compliance',
            'description' => 'Reviews tasks for policy and process compliance.',
            'color' => '#1D4ED8',
        ]);

        $finance = Team::query()->create([
            'name' => 'Finance',
            'description' => 'Handles budget approval and payment execution.',
            'color' => '#B45309',
        ]);

        $admin = User::query()->create([
            'name' => 'FlowDesk Admin',
            'email' => 'admin@flowdesk.test',
            'password' => 'Password123!',
            'team_id' => $operations->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole(RoleName::Admin->value);

        $opsLead = User::query()->create([
            'name' => 'Olivia Hart',
            'email' => 'operations@flowdesk.test',
            'password' => 'Password123!',
            'team_id' => $operations->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $opsLead->assignRole(RoleName::User->value);

        $complianceLead = User::query()->create([
            'name' => 'Daniel Reed',
            'email' => 'compliance@flowdesk.test',
            'password' => 'Password123!',
            'team_id' => $compliance->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $complianceLead->assignRole(RoleName::User->value);

        $financeLead = User::query()->create([
            'name' => 'Maya Foster',
            'email' => 'finance@flowdesk.test',
            'password' => 'Password123!',
            'team_id' => $finance->id,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $financeLead->assignRole(RoleName::User->value);

        $workflow = Workflow::query()->create([
            'name' => 'Vendor Onboarding',
            'description' => 'Standard workflow for onboarding and approving new vendors.',
            'status' => WorkflowStatus::Active,
        ]);

        $intakeStep = $workflow->steps()->create([
            'name' => 'Intake',
            'description' => 'Validate request completeness and vendor documents.',
            'sequence' => 1,
            'team_id' => $operations->id,
            'step_type' => WorkflowStepType::Action,
            'is_required' => true,
        ]);

        $reviewStep = $workflow->steps()->create([
            'name' => 'Compliance Review',
            'description' => 'Confirm policy and contractual compliance.',
            'sequence' => 2,
            'team_id' => $compliance->id,
            'step_type' => WorkflowStepType::Review,
            'is_required' => true,
        ]);

        $approvalStep = $workflow->steps()->create([
            'name' => 'Budget Approval',
            'description' => 'Approve budget allocation and final payment workflow.',
            'sequence' => 3,
            'team_id' => $finance->id,
            'step_type' => WorkflowStepType::Approval,
            'is_required' => true,
        ]);

        /** @var TaskLifecycleService $tasks */
        $tasks = app(TaskLifecycleService::class);

        $inReview = $tasks->createTask([
            'title' => 'Onboard Atlas Security',
            'description' => 'Urgent onboarding for the Q2 office expansion project.',
            'priority' => TaskPriority::High->value,
            'workflow_id' => $workflow->id,
            'assigned_user_id' => $opsLead->id,
            'due_at' => now()->addDays(5),
        ], $admin);

        $tasks->addComment($inReview, $opsLead, 'Vendor packet reviewed. Sending to compliance.');
        $inReview = $tasks->completeStep($inReview, $opsLead, 'All intake documents are attached.');
        $tasks->addComment($inReview, $admin, 'Please verify regional sanctions screening before final approval.', true);

        $completed = $tasks->createTask([
            'title' => 'Renew Acme Logistics Contract',
            'description' => 'Annual renewal for regional logistics partner.',
            'priority' => TaskPriority::Medium->value,
            'workflow_id' => $workflow->id,
            'assigned_user_id' => $opsLead->id,
            'due_at' => now()->addDays(2),
        ], $admin);

        $completed = $tasks->completeStep($completed, $opsLead, 'Request package validated.');
        $completed = $tasks->completeStep($completed, $admin, 'Compliance checklist approved.');
        $tasks->completeStep($completed, $admin, 'Budget confirmed.');

        $onHold = $tasks->createTask([
            'title' => 'Approve Northwind Marketing Spend',
            'description' => 'Waiting on revised supplier quote before proceeding.',
            'priority' => TaskPriority::Urgent->value,
            'workflow_id' => $workflow->id,
            'assigned_user_id' => $opsLead->id,
            'due_at' => now()->addDay(),
        ], $admin);

        $tasks->hold($onHold, $admin);

        EmailTemplate::query()->create([
            'name' => 'Task Assigned',
            'subject' => 'A new FlowDesk task has been assigned to you',
            'body' => 'Hello {{user_name}}, a new task "{{task_title}}" is awaiting your action.',
            'trigger' => EmailTemplateTrigger::TaskAssigned,
            'variables' => ['user_name', 'task_title'],
            'is_active' => true,
        ]);

        EmailTemplate::query()->create([
            'name' => 'Task Completed',
            'subject' => 'A FlowDesk task has been completed',
            'body' => 'Task "{{task_title}}" completed successfully on {{completed_at}}.',
            'trigger' => EmailTemplateTrigger::TaskCompleted,
            'variables' => ['task_title', 'completed_at'],
            'is_active' => true,
        ]);

        SystemSetting::query()->create([
            'company_name' => 'FlowDesk',
            'primary_color' => '#0F172A',
            'default_language' => SystemLanguage::English,
            'email_host' => 'mailhog',
            'email_port' => 1025,
            'email_from' => 'noreply@flowdesk.test',
            'email_user' => 'flowdesk',
            'email_password' => 'secret',
            'email_enabled' => true,
            'allow_registration' => false,
            'require_email_verification' => true,
        ]);
    }
}
