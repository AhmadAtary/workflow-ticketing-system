FROM node:22-alpine AS frontend-builder

WORKDIR /app

RUN corepack enable

COPY package.json pnpm-lock.yaml pnpm-workspace.yaml tsconfig.base.json tsconfig.json ./
COPY frontend ./frontend
COPY packages ./packages

RUN pnpm install --frozen-lockfile \
    && pnpm --filter @flowdesk/api-client run build \
    && pnpm --filter @flowdesk/frontend run build

FROM nginx:1.27-alpine

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=frontend-builder /app/frontend/dist /usr/share/nginx/html
