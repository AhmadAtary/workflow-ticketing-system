# Workspace

## Overview

pnpm workspace monorepo using TypeScript. FlowDesk — an enterprise workflow ticketing system with role-based access.

## Stack

- **Monorepo tool**: pnpm workspaces
- **Node.js version**: 24
- **Package manager**: pnpm
- **TypeScript version**: 5.9
- **API codegen**: Orval (from OpenAPI spec)
- **Frontend**: React + Vite (workflow-app), Tailwind CSS, shadcn/ui, Wouter routing, Recharts

## Key Artifacts

### `artifacts/workflow-app` — FlowDesk Web App
- **Preview path**: `/`
- **Port**: 22115
- **Auth**: Mock authentication (no real backend)
  - Admin: `admin@company.com / password123`
  - User: `user@company.com / password123`
- **Routing**: Wouter with role-based protected routes

### Admin Pages
- `/admin/dashboard` — Stats cards, activity feed, task charts, overdue list
- `/admin/tasks` — List + kanban view with filters, create task dialog
- `/admin/tasks/:id` — Task detail with step timeline, comments, internal notes, activity
- `/admin/teams` — Team grid with CRUD
- `/admin/teams/:id` — Team detail with members and tasks
- `/admin/users` — User table with CRUD
- `/admin/users/:id` — User detail with assigned tasks
- `/admin/workflows` — Workflow list with step flow visualizer and CRUD
- `/admin/workflows/:id` — Workflow detail with step builder
- `/admin/reports` — Analytics: charts, team performance, bottlenecks
- `/admin/email-templates` — Email template management with variable insertion
- `/admin/settings` — General, mail, branding, roles, language settings
- `/admin/notifications` — Admin notifications with mark-as-read

### User Pages
- `/dashboard` — User dashboard with task summary and notifications
- `/my-tasks` — User's tasks with list/kanban views
- `/my-tasks/:id` — Task detail with step progress and comments
- `/notifications` — User notifications

## Data Layer
- All data is in-memory using React Context (`DataContext`)
- `src/services/mockData.ts` — Seed data: users, teams, workflows, tasks, notifications, email templates, settings
- `src/contexts/DataContext.tsx` — Full CRUD mutations for all entities
- `src/contexts/AuthContext.tsx` — Mock auth with role-based routing

## Key Commands
- `pnpm --filter @workspace/workflow-app run dev` — Run the frontend
- `pnpm --filter @workspace/api-spec run codegen` — Regenerate API hooks from OpenAPI spec

See the `pnpm-workspace` skill for workspace structure and TypeScript setup.
