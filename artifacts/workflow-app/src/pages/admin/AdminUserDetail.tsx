import { useRoute, Link } from "wouter";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { ArrowLeft, AlertTriangle, CheckSquare, Mail, Shield, Users, Calendar } from "lucide-react";
import { format } from "date-fns";

function getStatusBadge(status: string) {
  const cfg: Record<string, string> = {
    open: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    in_progress: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    completed: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
    on_hold: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400",
  };
  return cfg[status] || cfg.open;
}

export default function AdminUserDetail() {
  const [, params] = useRoute("/admin/users/:id");
  const { users, tasks } = useData();
  const user = users.find(u => u.id === params?.id);

  if (!user) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <AlertTriangle className="h-12 w-12 text-muted-foreground" />
        <p className="text-muted-foreground">User not found</p>
        <Link href="/admin/users"><Button variant="outline">Back to Users</Button></Link>
      </div>
    );
  }

  const userTasks = tasks.filter(t => t.assignedUserId === user.id);
  const activeTasks = userTasks.filter(t => t.status !== "completed" && t.status !== "closed");
  const completedTasks = userTasks.filter(t => t.status === "completed");

  return (
    <div className="space-y-6">
      <div>
        <Link href="/admin/users">
          <Button variant="ghost" size="sm" className="text-muted-foreground hover:text-foreground mb-3 -ml-2">
            <ArrowLeft className="h-4 w-4 mr-1" /> Back to Users
          </Button>
        </Link>
        <div className="flex items-center gap-4">
          <Avatar className="h-16 w-16 border-2 border-border">
            <AvatarImage src={user.avatar} />
            <AvatarFallback className="text-lg font-bold">{user.name.charAt(0)}</AvatarFallback>
          </Avatar>
          <div>
            <h1 className="text-2xl font-bold text-foreground">{user.name}</h1>
            <p className="text-muted-foreground text-sm">{user.email}</p>
            <div className="flex items-center gap-2 mt-1">
              <span className={`text-xs px-2 py-0.5 rounded-full font-medium capitalize ${user.role === "admin" ? "bg-primary/10 text-primary" : "bg-muted text-muted-foreground"}`}>
                {user.role}
              </span>
              <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${user.status === "active" ? "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" : "bg-gray-100 text-gray-500"}`}>
                {user.status}
              </span>
            </div>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
        {[
          { label: "Active Tasks", value: activeTasks.length, icon: CheckSquare, color: "text-amber-500" },
          { label: "Completed", value: completedTasks.length, icon: CheckSquare, color: "text-green-500" },
          { label: "Total Tasks", value: userTasks.length, icon: CheckSquare, color: "text-blue-500" },
        ].map(stat => (
          <Card key={stat.label} className="border-border">
            <CardContent className="pt-4">
              <div className="flex items-center gap-3">
                <stat.icon className={`h-5 w-5 ${stat.color}`} />
                <div>
                  <p className="text-xs text-muted-foreground">{stat.label}</p>
                  <p className="text-xl font-bold">{stat.value}</p>
                </div>
              </div>
            </CardContent>
          </Card>
        ))}
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Profile Info */}
        <Card className="border-border">
          <CardHeader className="pb-3">
            <CardTitle className="text-base font-semibold">Profile</CardTitle>
          </CardHeader>
          <CardContent className="space-y-4 text-sm">
            <div className="flex items-center gap-3 text-muted-foreground">
              <Mail className="h-4 w-4 shrink-0" />
              <span>{user.email}</span>
            </div>
            <div className="flex items-center gap-3 text-muted-foreground">
              <Shield className="h-4 w-4 shrink-0" />
              <span className="capitalize">{user.role}</span>
            </div>
            {user.teamName && (
              <div className="flex items-center gap-3 text-muted-foreground">
                <Users className="h-4 w-4 shrink-0" />
                <span>{user.teamName}</span>
              </div>
            )}
            <div className="flex items-center gap-3 text-muted-foreground">
              <Calendar className="h-4 w-4 shrink-0" />
              <span>Joined {format(new Date(user.createdAt), "MMM d, yyyy")}</span>
            </div>
          </CardContent>
        </Card>

        {/* Assigned Tasks */}
        <div className="lg:col-span-2">
          <Card className="border-border">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">Assigned Tasks</CardTitle>
            </CardHeader>
            <CardContent>
              {userTasks.length === 0 ? (
                <p className="text-muted-foreground text-sm text-center py-6">No tasks assigned</p>
              ) : (
                <div className="space-y-3">
                  {userTasks.map(task => (
                    <Link key={task.id} href={`/admin/tasks/${task.id}`}>
                      <div className="flex items-start gap-3 p-2 rounded-lg hover:bg-muted/40 transition-colors cursor-pointer group">
                        <div className="flex-1">
                          <p className="text-sm font-medium text-foreground group-hover:text-primary transition-colors">{task.title}</p>
                          <p className="text-xs text-muted-foreground mt-0.5">{task.workflowName} · {task.currentStepName}</p>
                        </div>
                        <span className={`text-xs px-2 py-0.5 rounded-full font-medium whitespace-nowrap ${getStatusBadge(task.status)}`}>
                          {task.status.replace("_", " ")}
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
    </div>
  );
}
