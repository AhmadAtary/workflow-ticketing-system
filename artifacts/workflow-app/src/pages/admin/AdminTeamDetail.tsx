import { useRoute, Link } from "wouter";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Badge } from "@/components/ui/badge";
import { ArrowLeft, Users, CheckSquare, UserPlus, AlertTriangle } from "lucide-react";
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

export default function AdminTeamDetail() {
  const [, params] = useRoute("/admin/teams/:id");
  const { teams, users, tasks } = useData();
  const team = teams.find(t => t.id === params?.id);

  if (!team) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <AlertTriangle className="h-12 w-12 text-muted-foreground" />
        <p className="text-muted-foreground">Team not found</p>
        <Link href="/admin/teams"><Button variant="outline">Back to Teams</Button></Link>
      </div>
    );
  }

  const members = users.filter(u => u.teamId === team.id);
  const teamTasks = tasks.filter(t => t.assignedTeamId === team.id);
  const activeTasks = teamTasks.filter(t => t.status !== "completed" && t.status !== "closed");

  return (
    <div className="space-y-6">
      <div>
        <Link href="/admin/teams">
          <Button variant="ghost" size="sm" className="text-muted-foreground hover:text-foreground mb-3 -ml-2">
            <ArrowLeft className="h-4 w-4 mr-1" /> Back to Teams
          </Button>
        </Link>
        <div className="flex items-center gap-4">
          <div className="h-14 w-14 rounded-xl flex items-center justify-center text-white font-bold text-xl"
            style={{ backgroundColor: team.color || "#3b82f6" }}>
            {team.name.charAt(0)}
          </div>
          <div>
            <h1 className="text-2xl font-bold text-foreground">{team.name}</h1>
            {team.description && <p className="text-muted-foreground text-sm">{team.description}</p>}
          </div>
        </div>
      </div>

      <div className="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <Card className="border-border">
          <CardContent className="pt-4">
            <div className="flex items-center gap-3">
              <Users className="h-5 w-5 text-primary" />
              <div>
                <p className="text-xs text-muted-foreground">Members</p>
                <p className="text-xl font-bold">{members.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-4">
            <div className="flex items-center gap-3">
              <CheckSquare className="h-5 w-5 text-amber-500" />
              <div>
                <p className="text-xs text-muted-foreground">Active Tasks</p>
                <p className="text-xl font-bold">{activeTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
        <Card className="border-border">
          <CardContent className="pt-4">
            <div className="flex items-center gap-3">
              <CheckSquare className="h-5 w-5 text-green-500" />
              <div>
                <p className="text-xs text-muted-foreground">Total Tasks</p>
                <p className="text-xl font-bold">{teamTasks.length}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Members */}
        <Card className="border-border">
          <CardHeader className="flex flex-row items-center justify-between pb-3">
            <CardTitle className="text-base font-semibold">Members</CardTitle>
            <Link href="/admin/users">
              <Button variant="outline" size="sm" className="h-8">
                <UserPlus className="h-3.5 w-3.5 mr-1.5" /> Add Member
              </Button>
            </Link>
          </CardHeader>
          <CardContent>
            {members.length === 0 ? (
              <p className="text-muted-foreground text-sm text-center py-6">No members in this team</p>
            ) : (
              <div className="space-y-3">
                {members.map(member => (
                  <Link key={member.id} href={`/admin/users/${member.id}`}>
                    <div className="flex items-center gap-3 p-2 rounded-lg hover:bg-muted/40 transition-colors cursor-pointer">
                      <Avatar className="h-8 w-8">
                        <AvatarImage src={member.avatar} />
                        <AvatarFallback>{member.name.charAt(0)}</AvatarFallback>
                      </Avatar>
                      <div className="flex-1">
                        <p className="text-sm font-medium text-foreground">{member.name}</p>
                        <p className="text-xs text-muted-foreground">{member.email}</p>
                      </div>
                      <span className={`text-xs px-2 py-0.5 rounded-full font-medium capitalize ${member.role === "admin" ? "bg-primary/10 text-primary" : "bg-muted text-muted-foreground"}`}>
                        {member.role}
                      </span>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </CardContent>
        </Card>

        {/* Active Tasks */}
        <Card className="border-border">
          <CardHeader className="pb-3">
            <CardTitle className="text-base font-semibold">Active Tasks</CardTitle>
          </CardHeader>
          <CardContent>
            {activeTasks.length === 0 ? (
              <p className="text-muted-foreground text-sm text-center py-6">No active tasks</p>
            ) : (
              <div className="space-y-3">
                {activeTasks.map(task => (
                  <Link key={task.id} href={`/admin/tasks/${task.id}`}>
                    <div className="flex items-start gap-3 p-2 rounded-lg hover:bg-muted/40 transition-colors cursor-pointer group">
                      <div className="flex-1">
                        <p className="text-sm font-medium text-foreground group-hover:text-primary transition-colors">{task.title}</p>
                        <p className="text-xs text-muted-foreground mt-0.5">{task.currentStepName}</p>
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
  );
}
