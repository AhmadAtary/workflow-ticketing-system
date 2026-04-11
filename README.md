# FlowDesk

FlowDesk is a production-oriented workflow and task management platform with a React/Vite SPA and a Laravel 12 API. The repository was migrated from a Replit export into a two-app monorepo with explicit API contracts, role-based access control, Docker-based delivery, and CI-ready quality gates.

## Architecture

```text
.
|-- backend/                  Laravel 12 API, auth, domain logic, migrations, seeders, tests
|-- frontend/                 React 19 + Vite SPA
|-- packages/
|   |-- api-client/           Orval-generated TypeScript client and schemas
|   `-- api-contract/         OpenAPI source
|-- docker/
|   |-- app/                  PHP application image
|   `-- nginx/                Frontend build + edge proxy image
|-- .github/workflows/        CI, image release, deployment workflows
|-- docker-compose.yml
|-- LICENSE
`-- README.md
```

### Backend

- Laravel 12 API under `/api/v1`
- JWT access tokens with rotating refresh-token cookies
- Role-based access through `spatie/laravel-permission`
- RFC 7807 error responses with request tracing
- PostgreSQL + Redis ready for queueing and caching
- Service-oriented domain logic for auth, reports, and task lifecycle workflows

### Frontend

- React 19, Vite, TypeScript, React Query, Wouter
- Query-backed auth/session and data providers
- Lazy-loaded route boundaries for admin and user surfaces
- Contract-driven typing via `@flowdesk/api-client`

## Key Interfaces

Primary API routes:

- `POST /api/v1/auth/login`
- `POST /api/v1/auth/refresh`
- `POST /api/v1/auth/logout`
- `GET /api/v1/auth/me`
- `GET /api/v1/tasks`
- `GET /api/v1/tasks/{task}`
- `POST /api/v1/tasks/{task}/complete-step`
- `POST /api/v1/tasks/{task}/send-back`
- `POST /api/v1/tasks/{task}/hold`
- `POST /api/v1/tasks/{task}/close`
- `POST /api/v1/tasks/{task}/attachments`
- `DELETE /api/v1/tasks/{task}/attachments/{attachment}`
- `GET /api/v1/notifications`
- `GET /api/v1/reports/dashboard-summary`

Admin-only routes include `users`, `teams`, `workflows`, `email-templates`, `settings`, and report endpoints.

The API contract source lives at [packages/api-contract/openapi.yaml](/f:/New%20folder/FrontEnd/Asset-Manager-1/packages/api-contract/openapi.yaml). Regenerate the client with `pnpm codegen`.

## Local Setup

### Prerequisites

- Node.js 22+
- pnpm 10+
- PHP 8.2+
- Composer 2
- PostgreSQL 16
- Redis 7

### Install

```bash
pnpm install
cd backend
composer install
copy .env.example .env
php artisan key:generate --force
php artisan migrate --seed
```

### Run Without Docker

Backend:

```bash
cd backend
php artisan serve --host=0.0.0.0 --port=8000
```

Frontend:

```bash
cd frontend
pnpm dev
```

Frontend environment:

- `VITE_APP_NAME`
- `VITE_API_BASE_URL`
- `VITE_SENTRY_DSN` optional

Backend environment:

- `APP_URL`
- `DB_*`
- `REDIS_*`
- `JWT_*`
- `REFRESH_TOKEN_*`
- `FILESYSTEM_DISK`
- `ATTACHMENTS_DISK`
- `CORS_ALLOWED_ORIGINS`
- `MAIL_*`

### Seeded Accounts

`php artisan migrate --seed` creates local development users:

- `admin@flowdesk.test` / `Password123!`
- `operations@flowdesk.test` / `Password123!`
- `compliance@flowdesk.test` / `Password123!`
- `finance@flowdesk.test` / `Password123!`

## Docker

Bring the full stack up with one command:

```bash
docker compose up --build
```

Services:

- `nginx` on `http://localhost:8080`
- `app` for Laravel PHP-FPM
- `queue` for queued jobs
- `scheduler` for scheduled tasks
- `postgres`
- `redis`

The compose file also supports image-based deployment through `APP_IMAGE` and `WEB_IMAGE`.

## Quality Gates

Frontend:

- `pnpm --filter @flowdesk/frontend run lint`
- `pnpm --filter @flowdesk/frontend run test`
- `pnpm --filter @flowdesk/frontend run typecheck`
- `pnpm --filter @flowdesk/frontend run build`

Backend:

- `cd backend && composer lint`
- `cd backend && composer analyse`
- `cd backend && composer test`

Contract:

- `pnpm codegen`

## CI/CD

GitHub Actions workflows:

- `ci.yml` runs frontend lint/test/typecheck/build plus backend Pint, Larastan, and Pest
- `release.yml` builds and publishes `flowdesk-app` and `flowdesk-web` images to GHCR
- `deploy.yml` pulls the tagged images on a VPS and performs a compose-based rollout

Required deployment secrets:

- `DEPLOY_HOST`
- `DEPLOY_USER`
- `DEPLOY_SSH_KEY`

## Deployment Guide

1. Push a tagged release such as `v1.0.0` or trigger `Release Images` manually.
2. Provision a host with Docker and Docker Compose.
3. Clone the repository to the server and provide runtime environment values.
4. Trigger `Deploy` with the image tag and target compose path.
5. Validate `http://<host>/api/v1/healthz`.

## Branching

Recommended branch model:

- `main` for production-ready history
- `develop` for integration
- `feature/*` for isolated feature work

Current migration branches created in this repository:

- `main`
- `develop`
- `feature/repo-cleanup`

## Developer Onboarding

1. Read this README and inspect `packages/api-contract/openapi.yaml`.
2. Run the install and seed steps.
3. Verify `composer test` and frontend `lint`, `test`, `typecheck`, and `build`.
4. Create a feature branch from `develop`.
5. Keep backend changes behind `/api/v1` and regenerate the client when the contract changes.
