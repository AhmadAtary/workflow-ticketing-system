import { useState } from "react";
import { useData } from "../../contexts/DataContext";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import {
  Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter
} from "@/components/ui/dialog";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { useToast } from "@/hooks/use-toast";
import {
  Search, Plus, LayoutGrid, List, AlertTriangle, Clock, CheckCircle2,
  Pause, XCircle, ChevronRight, Filter, ArrowUpDown
} from "lucide-react";
import { format } from "date-fns";
import type { TaskDetail } from "@workspace/api-client-react";

type ViewMode = "list" | "kanban";

const STATUS_COLUMNS = [
  { key: "open", label: "Open", color: "bg-blue-500" },
  { key: "in_progress", label: "In Progress", color: "bg-amber-500" },
  { key: "on_hold", label: "On Hold", color: "bg-purple-500" },
  { key: "completed", label: "Completed", color: "bg-green-500" },
];

function getStatusBadge(status: string) {
  const config: Record<string, { label: string; class: string }> = {
    open: { label: "Open", class: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400" },
    in_progress: { label: "In Progress", class: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400" },
    on_hold: { label: "On Hold", class: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400" },
    completed: { label: "Completed", class: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" },
    closed: { label: "Closed", class: "bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400" },
    rejected: { label: "Rejected", class: "bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400" },
  };
  return config[status] || config.open;
}

function getPriorityBadge(priority: string) {
  const config: Record<string, { label: string; class: string }> = {
    urgent: { label: "Urgent", class: "bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400" },
    high: { label: "High", class: "bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400" },
    medium: { label: "Medium", class: "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400" },
    low: { label: "Low", class: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" },
  };
  return config[priority] || config.medium;
}

function TaskCard({ task }: { task: TaskDetail }) {
  const status = getStatusBadge(task.status);
  const priority = getPriorityBadge(task.priority);
  return (
    <Link href={`/admin/tasks/${task.id}`}>
      <div className="border border-border bg-card rounded-lg p-3 hover:border-primary/50 hover:shadow-sm transition-all cursor-pointer">
        <div className="flex items-start justify-between gap-2 mb-2">
          <p className="text-sm font-medium text-foreground line-clamp-2">{task.title}</p>
          {task.isOverdue && <AlertTriangle className="h-3.5 w-3.5 text-red-500 shrink-0 mt-0.5" />}
        </div>
        <div className="flex flex-wrap gap-1.5 mb-2">
          <span className={`text-xs px-1.5 py-0.5 rounded font-medium ${priority.class}`}>{priority.label}</span>
          <span className="text-xs px-1.5 py-0.5 rounded bg-muted text-muted-foreground">{task.currentStepName}</span>
        </div>
        <div className="flex items-center justify-between">
          <span className="text-xs text-muted-foreground">{task.assignedTeamName || "Unassigned"}</span>
          {task.dueDate && (
            <span className={`text-xs ${task.isOverdue ? "text-red-500" : "text-muted-foreground"}`}>
              {format(new Date(task.dueDate), "MMM d")}
            </span>
          )}
        </div>
      </div>
    </Link>
  );
}

export default function AdminTasks() {
  const { tasks, workflows, teams, users, addTask } = useData();
  const { toast } = useToast();
  const [viewMode, setViewMode] = useState<ViewMode>("list");
  const [search, setSearch] = useState("");
  const [filterStatus, setFilterStatus] = useState("all");
  const [filterPriority, setFilterPriority] = useState("all");
  const [filterTeam, setFilterTeam] = useState("all");
  const [showCreate, setShowCreate] = useState(false);
  const [newTask, setNewTask] = useState({
    title: "", description: "", priority: "medium", workflowId: "", assignedUserId: "", dueDate: ""
  });

  const filtered = tasks.filter(t => {
    if (search && !t.title.toLowerCase().includes(search.toLowerCase())) return false;
    if (filterStatus !== "all" && t.status !== filterStatus) return false;
    if (filterPriority !== "all" && t.priority !== filterPriority) return false;
    if (filterTeam !== "all" && t.assignedTeamId !== filterTeam) return false;
    return true;
  });

  const handleCreate = () => {
    if (!newTask.title || !newTask.workflowId) {
      toast({ title: "Please fill in required fields", variant: "destructive" });
      return;
    }
    const wf = workflows.find(w => w.id === newTask.workflowId);
    addTask({
      id: `task-${Date.now()}`,
      title: newTask.title,
      description: newTask.description,
      status: "open",
      priority: newTask.priority as any,
      workflowId: newTask.workflowId,
      workflowName: wf?.name || "",
      currentStepId: wf?.steps[0]?.id || "",
      currentStepName: wf?.steps[0]?.name || "",
      currentStepIndex: 0,
      totalSteps: wf?.steps.length || 1,
      assignedTeamId: wf?.steps[0]?.teamId || "",
      assignedTeamName: wf?.steps[0]?.teamName || "",
      assignedUserId: newTask.assignedUserId || undefined,
      assignedUserName: users.find(u => u.id === newTask.assignedUserId)?.name,
      createdByName: "Admin User",
      dueDate: newTask.dueDate || undefined,
      createdAt: new Date().toISOString(),
      isOverdue: false,
      commentCount: 0,
      workflow: wf,
      comments: [], internalNotes: [], activityLog: [], attachments: []
    });
    toast({ title: "Task created successfully" });
    setShowCreate(false);
    setNewTask({ title: "", description: "", priority: "medium", workflowId: "", assignedUserId: "", dueDate: "" });
  };

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Tasks</h1>
          <p className="text-sm text-muted-foreground mt-1">{filtered.length} tasks</p>
        </div>
        <Button onClick={() => setShowCreate(true)}>
          <Plus className="h-4 w-4 mr-2" /> New Task
        </Button>
      </div>

      {/* Filters */}
      <div className="flex flex-wrap items-center gap-3">
        <div className="relative flex-1 min-w-[200px]">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
          <Input placeholder="Search tasks..." value={search} onChange={e => setSearch(e.target.value)} className="pl-9" />
        </div>
        <Select value={filterStatus} onValueChange={setFilterStatus}>
          <SelectTrigger className="w-36"><SelectValue placeholder="Status" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Statuses</SelectItem>
            <SelectItem value="open">Open</SelectItem>
            <SelectItem value="in_progress">In Progress</SelectItem>
            <SelectItem value="on_hold">On Hold</SelectItem>
            <SelectItem value="completed">Completed</SelectItem>
            <SelectItem value="closed">Closed</SelectItem>
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
        <Select value={filterTeam} onValueChange={setFilterTeam}>
          <SelectTrigger className="w-36"><SelectValue placeholder="Team" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Teams</SelectItem>
            {teams.map(t => <SelectItem key={t.id} value={t.id}>{t.name}</SelectItem>)}
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

      {/* Kanban View */}
      {viewMode === "kanban" ? (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 overflow-x-auto">
          {STATUS_COLUMNS.map(col => {
            const colTasks = filtered.filter(t => t.status === col.key);
            return (
              <div key={col.key} className="bg-muted/40 rounded-xl p-3 min-w-[240px]">
                <div className="flex items-center gap-2 mb-3">
                  <div className={`h-2 w-2 rounded-full ${col.color}`} />
                  <span className="text-sm font-semibold text-foreground">{col.label}</span>
                  <span className="ml-auto text-xs text-muted-foreground bg-background border border-border rounded-full px-2 py-0.5">{colTasks.length}</span>
                </div>
                <div className="space-y-2">
                  {colTasks.map(task => <TaskCard key={task.id} task={task} />)}
                  {colTasks.length === 0 && (
                    <p className="text-xs text-muted-foreground text-center py-4">No tasks</p>
                  )}
                </div>
              </div>
            );
          })}
        </div>
      ) : (
        /* List View */
        <Card className="border-border">
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="border-b border-border bg-muted/40">
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Task</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Status</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Priority</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Workflow</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Current Step</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Team</th>
                  <th className="text-left px-4 py-3 font-medium text-muted-foreground">Due</th>
                  <th className="px-4 py-3"></th>
                </tr>
              </thead>
              <tbody>
                {filtered.length === 0 ? (
                  <tr>
                    <td colSpan={8} className="text-center text-muted-foreground py-12">
                      No tasks found.{" "}
                      <button className="text-primary underline" onClick={() => setShowCreate(true)}>Create one</button>
                    </td>
                  </tr>
                ) : (
                  filtered.map(task => {
                    const statusCfg = getStatusBadge(task.status);
                    const priorityCfg = getPriorityBadge(task.priority);
                    return (
                      <tr key={task.id} className="border-b border-border last:border-0 hover:bg-muted/30 transition-colors">
                        <td className="px-4 py-3">
                          <div className="flex items-center gap-2">
                            {task.isOverdue && <AlertTriangle className="h-3.5 w-3.5 text-red-500 shrink-0" />}
                            <span className="font-medium text-foreground">{task.title}</span>
                          </div>
                          <div className="text-xs text-muted-foreground mt-0.5">
                            {task.currentStepIndex + 1}/{task.totalSteps} steps
                          </div>
                        </td>
                        <td className="px-4 py-3">
                          <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${statusCfg.class}`}>{statusCfg.label}</span>
                        </td>
                        <td className="px-4 py-3">
                          <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${priorityCfg.class}`}>{priorityCfg.label}</span>
                        </td>
                        <td className="px-4 py-3 text-muted-foreground">{task.workflowName}</td>
                        <td className="px-4 py-3 text-muted-foreground">{task.currentStepName}</td>
                        <td className="px-4 py-3 text-muted-foreground">{task.assignedTeamName || "—"}</td>
                        <td className="px-4 py-3">
                          {task.dueDate ? (
                            <span className={task.isOverdue ? "text-red-500 font-medium" : "text-muted-foreground"}>
                              {format(new Date(task.dueDate), "MMM d, yyyy")}
                            </span>
                          ) : "—"}
                        </td>
                        <td className="px-4 py-3">
                          <Link href={`/admin/tasks/${task.id}`}>
                            <Button variant="ghost" size="sm" className="h-7 px-2">
                              <ChevronRight className="h-4 w-4" />
                            </Button>
                          </Link>
                        </td>
                      </tr>
                    );
                  })
                )}
              </tbody>
            </table>
          </div>
        </Card>
      )}

      {/* Create Task Dialog */}
      <Dialog open={showCreate} onOpenChange={setShowCreate}>
        <DialogContent className="max-w-md">
          <DialogHeader>
            <DialogTitle>Create New Task</DialogTitle>
          </DialogHeader>
          <div className="space-y-4">
            <div>
              <Label>Title *</Label>
              <Input placeholder="Task title" value={newTask.title} onChange={e => setNewTask(p => ({ ...p, title: e.target.value }))} className="mt-1" />
            </div>
            <div>
              <Label>Description</Label>
              <Textarea placeholder="Task description..." value={newTask.description} onChange={e => setNewTask(p => ({ ...p, description: e.target.value }))} className="mt-1" rows={3} />
            </div>
            <div className="grid grid-cols-2 gap-3">
              <div>
                <Label>Priority *</Label>
                <Select value={newTask.priority} onValueChange={v => setNewTask(p => ({ ...p, priority: v }))}>
                  <SelectTrigger className="mt-1"><SelectValue /></SelectTrigger>
                  <SelectContent>
                    <SelectItem value="low">Low</SelectItem>
                    <SelectItem value="medium">Medium</SelectItem>
                    <SelectItem value="high">High</SelectItem>
                    <SelectItem value="urgent">Urgent</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label>Workflow *</Label>
                <Select value={newTask.workflowId} onValueChange={v => setNewTask(p => ({ ...p, workflowId: v }))}>
                  <SelectTrigger className="mt-1"><SelectValue placeholder="Select" /></SelectTrigger>
                  <SelectContent>
                    {workflows.filter(w => w.status === "active").map(w => (
                      <SelectItem key={w.id} value={w.id}>{w.name}</SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
            </div>
            <div>
              <Label>Assign To</Label>
              <Select value={newTask.assignedUserId} onValueChange={v => setNewTask(p => ({ ...p, assignedUserId: v }))}>
                <SelectTrigger className="mt-1"><SelectValue placeholder="Select user (optional)" /></SelectTrigger>
                <SelectContent>
                  {users.map(u => <SelectItem key={u.id} value={u.id}>{u.name}</SelectItem>)}
                </SelectContent>
              </Select>
            </div>
            <div>
              <Label>Due Date</Label>
              <Input type="date" value={newTask.dueDate} onChange={e => setNewTask(p => ({ ...p, dueDate: e.target.value }))} className="mt-1" />
            </div>
          </div>
          <DialogFooter className="mt-2">
            <Button variant="outline" onClick={() => setShowCreate(false)}>Cancel</Button>
            <Button onClick={handleCreate}>Create Task</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
