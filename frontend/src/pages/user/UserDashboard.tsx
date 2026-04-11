import { useData } from "../../contexts/DataContext";
import { useAuth } from "../../contexts/AuthContext";
import { Link } from "wouter";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { CheckSquare, Clock, CheckCircle2, Pause, AlertTriangle, ArrowRight, ChevronRight } from "lucide-react";
import { format, formatDistanceToNow } from "date-fns";

function getStatusBadge(status: string) {
  const cfg: Record<string, { label: string; class: string }> = {
    open: { label: "Open", class: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400" },
    in_progress: { label: "In Progress", class: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400" },
    on_hold: { label: "On Hold", class: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400" },
    completed: { label: "Completed", class: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" },
    closed: { label: "Closed", class: "bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400" },
  };
  return cfg[status] || cfg.open;
}

function getPriorityBadge(priority: string) {
  const cfg: Record<string, string> = {
    urgent: "bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400",
    high: "bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400",
    medium: "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400",
    low: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
  };
  return cfg[priority] || cfg.medium;
}

export default function UserDashboard() {
  const { tasks, notifications } = useData();
  const { user } = useAuth();

  const myTasks = tasks.filter(t => t.assignedUserId === user?.id || t.assignedTeamId === user?.teamId);
  const openTasks = myTasks.filter(t => t.status === "open");
  const inProgressTasks = myTasks.filter(t => t.status === "in_progress");
  const completedTasks = myTasks.filter(t => t.status === "completed");
  const onHoldTasks = myTasks.filter(t => t.status === "on_hold");
  const overdueTasks = myTasks.filter(t => t.isOverdue);
  const urgentTasks = myTasks.filter(t => t.priority === "urgent" || t.priority === "high").slice(0, 5);
  const unreadNotifications = notifications.filter(n => !n.isRead && (!n.userId || n.userId === user?.id));

  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-2xl font-bold text-foreground">Dashboard</h1>
        <p className="text-muted-foreground text-sm mt-1">Welcome back, {user?.name}. Here's your task summary.</p>
      </div>

      {/* Quick stats */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        <Card className="border-border">
          <CardContent className="pt-5">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center shrink-0">
                <CheckSquare className="h-5 w-5 text-blue-600 dark:text-blue-400" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Open</p>
                <p className="text-2xl font-bold">{openTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-5">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center shrink-0">
                <Clock className="h-5 w-5 text-amber-600 dark:text-amber-400" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">In Progress</p>
                <p className="text-2xl font-bold">{inProgressTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-5">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center shrink-0">
                <CheckCircle2 className="h-5 w-5 text-green-600 dark:text-green-400" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Completed</p>
                <p className="text-2xl font-bold">{completedTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-5">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 rounded-lg bg-red-50 dark:bg-red-900/20 flex items-center justify-center shrink-0">
                <AlertTriangle className="h-5 w-5 text-red-600 dark:text-red-400" />
              </div>
              <div>
                <p className="text-xs text-muted-foreground">Overdue</p>
                <p className="text-2xl font-bold">{overdueTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Notifications banner */}
      {unreadNotifications.length > 0 && (
        <Card className="border-border border-l-4 border-l-primary bg-primary/5">
          <CardContent className="pt-4 pb-4">
            <div className="flex items-center justify-between">
              <div className="flex items-center gap-3">
                <div className="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                  <CheckSquare className="h-4 w-4 text-primary" />
                </div>
                <p className="text-sm font-medium text-foreground">
                  You have {unreadNotifications.length} unread notification{unreadNotifications.length > 1 ? "s" : ""}
                </p>
              </div>
              <Link href="/notifications">
                <Button variant="outline" size="sm">View <ArrowRight className="h-3 w-3 ml-1" /></Button>
              </Link>
            </div>
          </CardContent>
        </Card>
      )}

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* In Progress / Current Tasks */}
        <Card className="border-border">
          <CardHeader className="pb-3 flex flex-row items-center justify-between">
            <CardTitle className="text-base font-semibold">Current Tasks</CardTitle>
            <Link href="/my-tasks">
              <Button variant="ghost" size="sm" className="text-primary h-7 px-2 text-xs">
                All tasks <ChevronRight className="h-3 w-3 ml-1" />
              </Button>
            </Link>
          </CardHeader>
          <CardContent>
            {inProgressTasks.length === 0 && openTasks.length === 0 ? (
              <div className="text-center py-8">
                <CheckCircle2 className="h-10 w-10 text-green-400 mx-auto mb-2" />
                <p className="text-muted-foreground text-sm">No active tasks — you're all caught up!</p>
              </div>
            ) : (
              <div className="space-y-3">
                {[...inProgressTasks, ...openTasks].slice(0, 5).map(task => {
                  const status = getStatusBadge(task.status);
                  const priority = getPriorityBadge(task.priority);
                  return (
                    <Link key={task.id} href={`/my-tasks/${task.id}`}>
                      <div className="flex items-start gap-3 p-3 border border-border rounded-lg hover:border-primary/50 hover:bg-muted/30 transition-all cursor-pointer group">
                        {task.isOverdue && <AlertTriangle className="h-4 w-4 text-red-500 shrink-0 mt-0.5" />}
                        <div className="flex-1 min-w-0">
                          <p className="text-sm font-medium text-foreground group-hover:text-primary transition-colors truncate">{task.title}</p>
                          <div className="flex items-center gap-2 mt-1">
                            <span className={`text-xs px-1.5 py-0.5 rounded font-medium ${priority}`}>{task.priority}</span>
                            <span className="text-xs text-muted-foreground">{task.currentStepName}</span>
                          </div>
                        </div>
                        <div className="text-right shrink-0">
                          <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${status.class}`}>{status.label}</span>
                          {task.dueDate && (
                            <p className={`text-xs mt-1 ${task.isOverdue ? "text-red-500" : "text-muted-foreground"}`}>
                              Due {format(new Date(task.dueDate), "MMM d")}
                            </p>
                          )}
                        </div>
                      </div>
                    </Link>
                  );
                })}
              </div>
            )}
          </CardContent>
        </Card>

        {/* Quick Actions */}
        <Card className="border-border">
          <CardHeader className="pb-3">
            <CardTitle className="text-base font-semibold">High Priority Tasks</CardTitle>
          </CardHeader>
          <CardContent>
            {urgentTasks.length === 0 ? (
              <div className="text-center py-8">
                <CheckCircle2 className="h-10 w-10 text-green-400 mx-auto mb-2" />
                <p className="text-muted-foreground text-sm">No urgent tasks</p>
              </div>
            ) : (
              <div className="space-y-3">
                {urgentTasks.map(task => (
                  <Link key={task.id} href={`/my-tasks/${task.id}`}>
                    <div className="flex items-center gap-3 p-3 border border-border rounded-lg hover:border-primary/50 transition-all cursor-pointer group">
                      <div className={`h-2 w-2 rounded-full shrink-0 ${task.priority === "urgent" ? "bg-red-500" : "bg-orange-500"}`} />
                      <div className="flex-1 min-w-0">
                        <p className="text-sm font-medium text-foreground group-hover:text-primary transition-colors truncate">{task.title}</p>
                        <p className="text-xs text-muted-foreground">{task.workflowName} · {task.currentStepName}</p>
                      </div>
                      <span className={`text-xs px-2 py-0.5 rounded-full font-medium whitespace-nowrap ${getPriorityBadge(task.priority)}`}>
                        {task.priority}
                      </span>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </CardContent>
        </Card>
      </div>

      {/* All My Tasks Summary */}
      <Card className="border-border">
        <CardHeader className="pb-3">
          <CardTitle className="text-base font-semibold">Task Overview</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
            {[
              { label: "Open", count: openTasks.length, color: "bg-blue-500" },
              { label: "In Progress", count: inProgressTasks.length, color: "bg-amber-500" },
              { label: "On Hold", count: onHoldTasks.length, color: "bg-purple-500" },
              { label: "Completed", count: completedTasks.length, color: "bg-green-500" },
            ].map(item => (
              <div key={item.label} className="flex items-center gap-3 p-3 rounded-lg bg-muted/40">
                <div className={`h-3 w-3 rounded-full ${item.color} shrink-0`} />
                <div>
                  <p className="text-xs text-muted-foreground">{item.label}</p>
                  <p className="text-lg font-bold text-foreground">{item.count}</p>
                </div>
              </div>
            ))}
          </div>
        </CardContent>
      </Card>
    </div>
  );
}
