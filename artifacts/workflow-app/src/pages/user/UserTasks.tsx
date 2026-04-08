import { useState } from "react";
import { useData } from "../../contexts/DataContext";
import { useAuth } from "../../contexts/AuthContext";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card } from "@/components/ui/card";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Search, LayoutGrid, List, AlertTriangle, ChevronRight } from "lucide-react";
import { format } from "date-fns";

type ViewMode = "list" | "kanban";

const STATUS_COLUMNS = [
  { key: "open", label: "Open", color: "bg-blue-500" },
  { key: "in_progress", label: "In Progress", color: "bg-amber-500" },
  { key: "on_hold", label: "On Hold", color: "bg-purple-500" },
  { key: "completed", label: "Completed", color: "bg-green-500" },
];

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

export default function UserTasks() {
  const { tasks } = useData();
  const { user } = useAuth();
  const [viewMode, setViewMode] = useState<ViewMode>("list");
  const [search, setSearch] = useState("");
  const [filterStatus, setFilterStatus] = useState("all");
  const [filterPriority, setFilterPriority] = useState("all");

  const myTasks = tasks.filter(t => t.assignedUserId === user?.id || t.assignedTeamId === user?.teamId);
  const filtered = myTasks.filter(t => {
    if (search && !t.title.toLowerCase().includes(search.toLowerCase())) return false;
    if (filterStatus !== "all" && t.status !== filterStatus) return false;
    if (filterPriority !== "all" && t.priority !== filterPriority) return false;
    return true;
  });

  return (
    <div className="space-y-5">
      <div>
        <h1 className="text-2xl font-bold text-foreground">My Tasks</h1>
        <p className="text-sm text-muted-foreground mt-1">{filtered.length} tasks</p>
      </div>

      <div className="flex flex-wrap items-center gap-3">
        <div className="relative flex-1 min-w-[200px]">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
          <Input placeholder="Search your tasks..." value={search} onChange={e => setSearch(e.target.value)} className="pl-9" />
        </div>
        <Select value={filterStatus} onValueChange={setFilterStatus}>
          <SelectTrigger className="w-36"><SelectValue placeholder="Status" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Statuses</SelectItem>
            <SelectItem value="open">Open</SelectItem>
            <SelectItem value="in_progress">In Progress</SelectItem>
            <SelectItem value="on_hold">On Hold</SelectItem>
            <SelectItem value="completed">Completed</SelectItem>
          </SelectContent>
        </Select>
        <Select value={filterPriority} onValueChange={setFilterPriority}>
          <SelectTrigger className="w-36"><SelectValue placeholder="Priority" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Priorities</SelectItem>
            <SelectItem value="urgent">Urgent</SelectItem>
            <SelectItem value="high">High</SelectItem>
            <SelectItem value="medium">Medium</SelectItem>
            <SelectItem value="low">Low</SelectItem>
          </SelectContent>
        </Select>
        <div className="flex items-center gap-1 border border-border rounded-md p-1">
          <Button variant={viewMode === "list" ? "secondary" : "ghost"} size="sm" className="h-7 px-2" onClick={() => setViewMode("list")}>
            <List className="h-4 w-4" />
          </Button>
          <Button variant={viewMode === "kanban" ? "secondary" : "ghost"} size="sm" className="h-7 px-2" onClick={() => setViewMode("kanban")}>
            <LayoutGrid className="h-4 w-4" />
          </Button>
        </div>
      </div>

      {viewMode === "kanban" ? (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          {STATUS_COLUMNS.map(col => {
            const colTasks = filtered.filter(t => t.status === col.key);
            return (
              <div key={col.key} className="bg-muted/40 rounded-xl p-3">
                <div className="flex items-center gap-2 mb-3">
                  <div className={`h-2 w-2 rounded-full ${col.color}`} />
                  <span className="text-sm font-semibold">{col.label}</span>
                  <span className="ml-auto text-xs text-muted-foreground bg-background border border-border rounded-full px-2 py-0.5">{colTasks.length}</span>
                </div>
                <div className="space-y-2">
                  {colTasks.map(task => (
                    <Link key={task.id} href={`/my-tasks/${task.id}`}>
                      <div className="border border-border bg-card rounded-lg p-3 hover:border-primary/50 hover:shadow-sm transition-all cursor-pointer">
                        <div className="flex items-start gap-1.5 mb-2">
                          {task.isOverdue && <AlertTriangle className="h-3.5 w-3.5 text-red-500 shrink-0 mt-0.5" />}
                          <p className="text-sm font-medium text-foreground line-clamp-2">{task.title}</p>
                        </div>
                        <div className="flex flex-wrap gap-1">
                          <span className={`text-xs px-1.5 py-0.5 rounded font-medium ${getPriorityBadge(task.priority)}`}>{task.priority}</span>
                          <span className="text-xs px-1.5 py-0.5 rounded bg-muted text-muted-foreground">{task.currentStepName}</span>
                        </div>
                        {task.dueDate && (
                          <p className={`text-xs mt-2 ${task.isOverdue ? "text-red-500" : "text-muted-foreground"}`}>
                            Due {format(new Date(task.dueDate), "MMM d")}
                          </p>
                        )}
                      </div>
                    </Link>
                  ))}
                  {colTasks.length === 0 && <p className="text-xs text-muted-foreground text-center py-4">No tasks</p>}
                </div>
              </div>
            );
          })}
        </div>
      ) : (
        <Card className="border-border">
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="border-b border-border bg-muted/40">
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Task</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Status</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Priority</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Current Step</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Due</th>
                  <th className="px-4 py-3"></th>
                </tr>
              </thead>
              <tbody>
                {filtered.length === 0 ? (
                  <tr><td colSpan={6} className="text-center text-muted-foreground py-12">No tasks found</td></tr>
                ) : filtered.map(task => {
                  const status = getStatusBadge(task.status);
                  const priority = getPriorityBadge(task.priority);
                  return (
                    <tr key={task.id} className="border-b border-border last:border-0 hover:bg-muted/30 transition-colors">
                      <td className="px-4 py-3">
                        <div className="flex items-center gap-2">
                          {task.isOverdue && <AlertTriangle className="h-3.5 w-3.5 text-red-500 shrink-0" />}
                          <span className="font-medium text-foreground">{task.title}</span>
                        </div>
                        <p className="text-xs text-muted-foreground mt-0.5">{task.workflowName}</p>
                      </td>
                      <td className="px-4 py-3">
                        <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${status.class}`}>{status.label}</span>
                      </td>
                      <td className="px-4 py-3">
                        <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${priority}`}>{task.priority}</span>
                      </td>
                      <td className="px-4 py-3 text-muted-foreground">{task.currentStepName}</td>
                      <td className="px-4 py-3">
                        {task.dueDate ? (
                          <span className={task.isOverdue ? "text-red-500 font-medium" : "text-muted-foreground"}>
                            {format(new Date(task.dueDate), "MMM d, yyyy")}
                          </span>
                        ) : "—"}
                      </td>
                      <td className="px-4 py-3">
                        <Link href={`/my-tasks/${task.id}`}>
                          <Button variant="ghost" size="sm" className="h-7 px-2">
                            <ChevronRight className="h-4 w-4" />
                          </Button>
                        </Link>
                      </td>
                    </tr>
                  );
                })}
              </tbody>
            </table>
          </div>
        </Card>
      )}
    </div>
  );
}
