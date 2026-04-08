import { useData } from "../../contexts/DataContext";
import { useAuth } from "../../contexts/AuthContext";
import { Link } from "wouter";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Button } from "@/components/ui/button";
import {
  CheckSquare, Clock, AlertTriangle, Users, Building2, GitMerge,
  TrendingUp, ArrowRight, CheckCircle2, XCircle, Pause
} from "lucide-react";
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, PieChart, Pie, Cell, Legend } from "recharts";
import { format, formatDistanceToNow } from "date-fns";

export default function AdminDashboard() {
  const { tasks, users, teams, workflows, notifications, activities } = useData();
  const { user } = useAuth();

  const totalTasks = tasks.length;
  const openTasks = tasks.filter(t => t.status === "open").length;
  const inProgressTasks = tasks.filter(t => t.status === "in_progress").length;
  const completedTasks = tasks.filter(t => t.status === "completed").length;
  const overdueTasks = tasks.filter(t => t.isOverdue).length;
  const pendingApprovals = tasks.filter(t => t.status === "in_progress").length;

  const tasksByStatus = [
    { name: "Open", value: openTasks, color: "#3b82f6" },
    { name: "In Progress", value: inProgressTasks, color: "#f59e0b" },
    { name: "Completed", value: completedTasks, color: "#10b981" },
    { name: "On Hold", value: tasks.filter(t => t.status === "on_hold").length, color: "#8b5cf6" },
  ];

  const tasksByTeam = teams.map(team => ({
    name: team.name,
    tasks: tasks.filter(t => t.assignedTeamId === team.id).length,
  }));

  const recentActivities = activities.slice(0, 8);
  const overdueTasksList = tasks.filter(t => t.isOverdue).slice(0, 5);

  const getActivityIcon = (type: string) => {
    switch (type) {
      case "task_created": return <CheckSquare className="h-4 w-4 text-blue-500" />;
      case "step_completed": return <CheckCircle2 className="h-4 w-4 text-green-500" />;
      case "task_closed": return <XCircle className="h-4 w-4 text-gray-500" />;
      case "task_rejected": return <XCircle className="h-4 w-4 text-red-500" />;
      default: return <Clock className="h-4 w-4 text-gray-400" />;
    }
  };

  const getPriorityBadge = (priority: string) => {
    const variants: Record<string, string> = {
      urgent: "bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400",
      high: "bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400",
      medium: "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400",
      low: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
    };
    return variants[priority] || variants.medium;
  };

  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-2xl font-bold text-foreground">Dashboard</h1>
        <p className="text-muted-foreground text-sm mt-1">Welcome back, {user?.name}. Here's what's happening today.</p>
      </div>

      {/* Summary Cards */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm font-medium text-muted-foreground">Total Tasks</p>
                <p className="text-3xl font-bold text-foreground mt-1">{totalTasks}</p>
                <p className="text-xs text-muted-foreground mt-1">{openTasks} open, {inProgressTasks} in progress</p>
              </div>
              <div className="h-12 w-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                <CheckSquare className="h-6 w-6 text-blue-600 dark:text-blue-400" />
              </div>
            </div>
          </CardContent>
        </Card>

        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm font-medium text-muted-foreground">Completed</p>
                <p className="text-3xl font-bold text-foreground mt-1">{completedTasks}</p>
                <p className="text-xs text-green-600 dark:text-green-400 mt-1 flex items-center gap-1">
                  <TrendingUp className="h-3 w-3" /> This month
                </p>
              </div>
              <div className="h-12 w-12 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                <CheckCircle2 className="h-6 w-6 text-green-600 dark:text-green-400" />
              </div>
            </div>
          </CardContent>
        </Card>

        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm font-medium text-muted-foreground">Overdue</p>
                <p className="text-3xl font-bold text-foreground mt-1">{overdueTasks}</p>
                <p className="text-xs text-red-500 mt-1">Requires attention</p>
              </div>
              <div className="h-12 w-12 rounded-lg bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                <AlertTriangle className="h-6 w-6 text-red-600 dark:text-red-400" />
              </div>
            </div>
          </CardContent>
        </Card>

        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm font-medium text-muted-foreground">Pending Approvals</p>
                <p className="text-3xl font-bold text-foreground mt-1">{pendingApprovals}</p>
                <p className="text-xs text-muted-foreground mt-1">Awaiting action</p>
              </div>
              <div className="h-12 w-12 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center">
                <Clock className="h-6 w-6 text-amber-600 dark:text-amber-400" />
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Secondary stats */}
      <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <Users className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Total Users</p>
                <p className="text-2xl font-bold">{users.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <Building2 className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Teams</p>
                <p className="text-2xl font-bold">{teams.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-6">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <GitMerge className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Active Workflows</p>
                <p className="text-2xl font-bold">{workflows.filter(w => w.status === "active").length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold">Tasks by Status</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={220}>
              <PieChart>
                <Pie data={tasksByStatus} cx="50%" cy="50%" innerRadius={60} outerRadius={90} paddingAngle={3} dataKey="value">
                  {tasksByStatus.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={entry.color} />
                  ))}
                </Pie>
                <Tooltip />
                <Legend />
              </PieChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>

        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold">Tasks by Team</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={220}>
              <BarChart data={tasksByTeam} margin={{ top: 5, right: 10, left: -20, bottom: 5 }}>
                <CartesianGrid strokeDasharray="3 3" stroke="hsl(var(--border))" />
                <XAxis dataKey="name" tick={{ fontSize: 12, fill: "hsl(var(--muted-foreground))" }} />
                <YAxis tick={{ fontSize: 12, fill: "hsl(var(--muted-foreground))" }} />
                <Tooltip contentStyle={{ background: "hsl(var(--card))", border: "1px solid hsl(var(--border))", borderRadius: 6 }} />
                <Bar dataKey="tasks" fill="hsl(var(--primary))" radius={[4, 4, 0, 0]} />
              </BarChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>
      </div>

      {/* Activity & Overdue */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Recent Activity */}
        <Card className="border-border">
          <CardHeader className="pb-2 flex flex-row items-center justify-between">
            <CardTitle className="text-base font-semibold">Recent Activity</CardTitle>
          </CardHeader>
          <CardContent>
            {recentActivities.length === 0 ? (
              <p className="text-muted-foreground text-sm text-center py-8">No recent activity</p>
            ) : (
              <div className="space-y-4">
                {recentActivities.map((activity) => (
                  <div key={activity.id} className="flex items-start gap-3">
                    <div className="mt-0.5">{getActivityIcon(activity.type)}</div>
                    <div className="flex-1 min-w-0">
                      <p className="text-sm text-foreground">
                        <span className="font-medium">{activity.userName}</span>{" "}
                        {activity.description}
                        {activity.taskTitle && (
                          <span className="text-primary"> "{activity.taskTitle}"</span>
                        )}
                      </p>
                      <p className="text-xs text-muted-foreground mt-0.5">
                        {formatDistanceToNow(new Date(activity.createdAt), { addSuffix: true })}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            )}
          </CardContent>
        </Card>

        {/* Overdue Tasks */}
        <Card className="border-border">
          <CardHeader className="pb-2 flex flex-row items-center justify-between">
            <CardTitle className="text-base font-semibold">Overdue Tasks</CardTitle>
            <Link href="/admin/tasks">
              <Button variant="ghost" size="sm" className="text-primary text-xs h-7 px-2">
                View all <ArrowRight className="h-3 w-3 ml-1" />
              </Button>
            </Link>
          </CardHeader>
          <CardContent>
            {overdueTasksList.length === 0 ? (
              <div className="text-center py-8">
                <CheckCircle2 className="h-10 w-10 text-green-400 mx-auto mb-2" />
                <p className="text-muted-foreground text-sm">No overdue tasks</p>
              </div>
            ) : (
              <div className="space-y-3">
                {overdueTasksList.map((task) => (
                  <Link key={task.id} href={`/admin/tasks/${task.id}`}>
                    <div className="flex items-start gap-3 p-3 rounded-lg hover:bg-muted/50 transition-colors cursor-pointer group">
                      <AlertTriangle className="h-4 w-4 text-red-500 mt-0.5 shrink-0" />
                      <div className="flex-1 min-w-0">
                        <p className="text-sm font-medium text-foreground group-hover:text-primary transition-colors truncate">{task.title}</p>
                        <div className="flex items-center gap-2 mt-1">
                          <span className={`text-xs px-1.5 py-0.5 rounded font-medium ${getPriorityBadge(task.priority)}`}>
                            {task.priority}
                          </span>
                          <span className="text-xs text-muted-foreground">{task.currentStepName}</span>
                        </div>
                      </div>
                      <span className="text-xs text-red-500 shrink-0">
                        {task.dueDate ? format(new Date(task.dueDate), "MMM d") : "—"}
                      </span>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
