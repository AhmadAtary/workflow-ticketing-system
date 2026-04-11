import { lazy, Suspense } from "react";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Redirect, Route, Router as WouterRouter, Switch } from "wouter";
import { Toaster } from "@/components/ui/toaster";
import { TooltipProvider } from "@/components/ui/tooltip";
import { AuthProvider, useAuth } from "@/app/providers/AuthProvider";
import { DataProvider } from "@/app/providers/DataProvider";
import { AdminLayout } from "@/components/AdminLayout";
import { UserLayout } from "@/components/UserLayout";
import NotFound from "@/pages/not-found";

const Login = lazy(() => import("@/pages/Login"));
const AdminDashboard = lazy(() => import("@/pages/admin/AdminDashboard"));
const AdminTasks = lazy(() => import("@/pages/admin/AdminTasks"));
const AdminTaskDetail = lazy(() => import("@/pages/admin/AdminTaskDetail"));
const AdminTeams = lazy(() => import("@/pages/admin/AdminTeams"));
const AdminTeamDetail = lazy(() => import("@/pages/admin/AdminTeamDetail"));
const AdminUsers = lazy(() => import("@/pages/admin/AdminUsers"));
const AdminUserDetail = lazy(() => import("@/pages/admin/AdminUserDetail"));
const AdminWorkflows = lazy(() => import("@/pages/admin/AdminWorkflows"));
const AdminWorkflowDetail = lazy(() => import("@/pages/admin/AdminWorkflowDetail"));
const AdminReports = lazy(() => import("@/pages/admin/AdminReports"));
const AdminEmailTemplates = lazy(() => import("@/pages/admin/AdminEmailTemplates"));
const AdminSettings = lazy(() => import("@/pages/admin/AdminSettings"));
const UserDashboard = lazy(() => import("@/pages/user/UserDashboard"));
const UserTasks = lazy(() => import("@/pages/user/UserTasks"));
const UserTaskDetail = lazy(() => import("@/pages/user/UserTaskDetail"));
const Notifications = lazy(() => import("@/pages/shared/Notifications"));

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      retry: 1,
      refetchOnWindowFocus: false,
      staleTime: 30_000,
    },
  },
});

function PageLoader() {
  return (
    <div className="h-screen flex items-center justify-center">
      <div className="text-center">
        <div className="h-8 w-8 border-2 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-3" />
        <p className="text-sm text-muted-foreground">Loading...</p>
      </div>
    </div>
  );
}

function ProtectedRoute({
  component: Component,
  layout: Layout,
  allowedRole,
}: {
  component: React.ComponentType;
  layout: React.ComponentType<{ children: React.ReactNode }>;
  allowedRole?: "admin" | "user";
}) {
  const { user, isLoading } = useAuth();

  if (isLoading) {
    return <PageLoader />;
  }

  if (!user) {
    return <Redirect to="/login" />;
  }

  if (allowedRole && user.role !== allowedRole) {
    return <Redirect to={user.role === "admin" ? "/admin/dashboard" : "/dashboard"} />;
  }

  return (
    <Layout>
      <Suspense fallback={<PageLoader />}>
        <Component />
      </Suspense>
    </Layout>
  );
}

function RootRedirect() {
  const { user, isLoading } = useAuth();

  if (isLoading) {
    return <PageLoader />;
  }

  if (!user) {
    return <Redirect to="/login" />;
  }

  return <Redirect to={user.role === "admin" ? "/admin/dashboard" : "/dashboard"} />;
}

function Router() {
  return (
    <Suspense fallback={<PageLoader />}>
      <Switch>
        <Route path="/login" component={Login} />

        <Route path="/admin/dashboard">
          {() => <ProtectedRoute component={AdminDashboard} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/tasks/:id">
          {() => <ProtectedRoute component={AdminTaskDetail} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/tasks">
          {() => <ProtectedRoute component={AdminTasks} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/teams/:id">
          {() => <ProtectedRoute component={AdminTeamDetail} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/teams">
          {() => <ProtectedRoute component={AdminTeams} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/users/:id">
          {() => <ProtectedRoute component={AdminUserDetail} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/users">
          {() => <ProtectedRoute component={AdminUsers} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/workflows/:id">
          {() => <ProtectedRoute component={AdminWorkflowDetail} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/workflows">
          {() => <ProtectedRoute component={AdminWorkflows} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/reports">
          {() => <ProtectedRoute component={AdminReports} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/email-templates">
          {() => <ProtectedRoute component={AdminEmailTemplates} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/settings">
          {() => <ProtectedRoute component={AdminSettings} layout={AdminLayout} allowedRole="admin" />}
        </Route>
        <Route path="/admin/notifications">
          {() => <ProtectedRoute component={Notifications} layout={AdminLayout} allowedRole="admin" />}
        </Route>

        <Route path="/dashboard">
          {() => <ProtectedRoute component={UserDashboard} layout={UserLayout} allowedRole="user" />}
        </Route>
        <Route path="/my-tasks/:id">
          {() => <ProtectedRoute component={UserTaskDetail} layout={UserLayout} allowedRole="user" />}
        </Route>
        <Route path="/my-tasks">
          {() => <ProtectedRoute component={UserTasks} layout={UserLayout} allowedRole="user" />}
        </Route>
        <Route path="/notifications">
          {() => <ProtectedRoute component={Notifications} layout={UserLayout} allowedRole="user" />}
        </Route>

        <Route path="/" component={RootRedirect} />
        <Route component={NotFound} />
      </Switch>
    </Suspense>
  );
}

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <TooltipProvider>
        <AuthProvider>
          <DataProvider>
            <WouterRouter base={import.meta.env.BASE_URL.replace(/\/$/, "")}>
              <Router />
            </WouterRouter>
          </DataProvider>
        </AuthProvider>
        <Toaster />
      </TooltipProvider>
    </QueryClientProvider>
  );
}

export default App;
