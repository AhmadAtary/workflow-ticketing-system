import { Switch, Route, Router as WouterRouter, Redirect } from "wouter";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { Toaster } from "@/components/ui/toaster";
import { TooltipProvider } from "@/components/ui/tooltip";
import { AuthProvider, useAuth } from "./contexts/AuthContext";
import { DataProvider } from "./contexts/DataContext";
import { AdminLayout } from "./components/AdminLayout";
import { UserLayout } from "./components/UserLayout";
import NotFound from "@/pages/not-found";
import Login from "@/pages/Login";

import AdminDashboard from "./pages/admin/AdminDashboard";
import AdminTasks from "./pages/admin/AdminTasks";
import AdminTaskDetail from "./pages/admin/AdminTaskDetail";
import AdminTeams from "./pages/admin/AdminTeams";
import AdminTeamDetail from "./pages/admin/AdminTeamDetail";
import AdminUsers from "./pages/admin/AdminUsers";
import AdminUserDetail from "./pages/admin/AdminUserDetail";
import AdminWorkflows from "./pages/admin/AdminWorkflows";
import AdminWorkflowDetail from "./pages/admin/AdminWorkflowDetail";
import AdminReports from "./pages/admin/AdminReports";
import AdminEmailTemplates from "./pages/admin/AdminEmailTemplates";
import AdminSettings from "./pages/admin/AdminSettings";

import UserDashboard from "./pages/user/UserDashboard";
import UserTasks from "./pages/user/UserTasks";
import UserTaskDetail from "./pages/user/UserTaskDetail";

import Notifications from "./pages/shared/Notifications";

const queryClient = new QueryClient();

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
    return (
      <div className="h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="h-8 w-8 border-2 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-3" />
          <p className="text-muted-foreground text-sm">Loading...</p>
        </div>
      </div>
    );
  }

  if (!user) return <Redirect to="/login" />;

  if (allowedRole && user.role !== allowedRole) {
    return <Redirect to={user.role === "admin" ? "/admin/dashboard" : "/dashboard"} />;
  }

  return (
    <Layout>
      <Component />
    </Layout>
  );
}

function RootRedirect() {
  const { user, isLoading } = useAuth();
  if (isLoading) {
    return (
      <div className="h-screen flex items-center justify-center">
        <div className="h-8 w-8 border-2 border-primary border-t-transparent rounded-full animate-spin" />
      </div>
    );
  }
  if (!user) return <Redirect to="/login" />;
  return <Redirect to={user.role === "admin" ? "/admin/dashboard" : "/dashboard"} />;
}

function Router() {
  return (
    <Switch>
      <Route path="/login" component={Login} />

      {/* Admin Routes */}
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

      {/* User Routes */}
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
