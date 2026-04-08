import { useState } from "react";
import { useRoute, Link } from "wouter";
import { useData } from "../../contexts/DataContext";
import { useAuth } from "../../contexts/AuthContext";
import { Button } from "@/components/ui/button";
import { Textarea } from "@/components/ui/textarea";
import { Badge } from "@/components/ui/badge";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Label } from "@/components/ui/label";
import { useToast } from "@/hooks/use-toast";
import {
  ArrowLeft, CheckCircle2, RotateCcw, UserCheck, Pause, XCircle,
  AlertTriangle, Paperclip, MessageSquare, FileText, Clock, Download, Lock
} from "lucide-react";
import { format, formatDistanceToNow } from "date-fns";

function getStatusBadge(status: string) {
  const cfg: Record<string, string> = {
    open: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    in_progress: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    on_hold: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400",
    completed: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
    closed: "bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400",
    rejected: "bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400",
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

function StepTimeline({ task }: { task: any }) {
  const steps = task.workflow?.steps || [];
  return (
    <div className="flex items-start gap-0 overflow-x-auto pb-2">
      {steps.map((step: any, idx: number) => {
        const isDone = idx < task.currentStepIndex;
        const isCurrent = idx === task.currentStepIndex;
        return (
          <div key={step.id} className="flex items-center flex-1 min-w-[120px]">
            <div className="flex flex-col items-center">
              <div className={`h-8 w-8 rounded-full flex items-center justify-center border-2 transition-colors ${
                isDone ? "bg-green-500 border-green-500 text-white" :
                isCurrent ? "bg-primary border-primary text-white" :
                "bg-background border-border text-muted-foreground"
              }`}>
                {isDone ? (
                  <CheckCircle2 className="h-4 w-4" />
                ) : (
                  <span className="text-xs font-bold">{idx + 1}</span>
                )}
              </div>
              <div className="mt-2 text-center">
                <p className={`text-xs font-medium leading-tight ${isCurrent ? "text-primary" : isDone ? "text-green-600 dark:text-green-400" : "text-muted-foreground"}`}>
                  {step.name}
                </p>
                <p className="text-xs text-muted-foreground mt-0.5">{step.teamName}</p>
                <span className={`text-xs px-1 py-0.5 rounded mt-1 inline-block ${
                  step.stepType === "approval" ? "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400" :
                  step.stepType === "review" ? "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400" :
                  "bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400"
                }`}>{step.stepType}</span>
              </div>
            </div>
            {idx < steps.length - 1 && (
              <div className={`h-0.5 flex-1 mx-2 mt-[-24px] ${isDone ? "bg-green-500" : "bg-border"}`} />
            )}
          </div>
        );
      })}
    </div>
  );
}

export default function AdminTaskDetail() {
  const [, params] = useRoute("/admin/tasks/:id");
  const { tasks, users, updateTask, addComment } = useData();
  const { user } = useAuth();
  const { toast } = useToast();
  const [comment, setComment] = useState("");
  const [isInternal, setIsInternal] = useState(false);
  const [showSendBack, setShowSendBack] = useState(false);
  const [showReassign, setShowReassign] = useState(false);
  const [sendBackReason, setSendBackReason] = useState("");
  const [reassignUserId, setReassignUserId] = useState("");
  const [confirmClose, setConfirmClose] = useState(false);
  const [activeTab, setActiveTab] = useState("comments");

  const task = tasks.find(t => t.id === params?.id);

  if (!task) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <AlertTriangle className="h-12 w-12 text-muted-foreground" />
        <p className="text-muted-foreground">Task not found</p>
        <Link href="/admin/tasks"><Button variant="outline">Back to Tasks</Button></Link>
      </div>
    );
  }

  const handleComplete = () => {
    if (!task.workflow?.steps) return;
    const nextIdx = task.currentStepIndex + 1;
    const isLast = nextIdx >= task.totalSteps;
    const nextStep = task.workflow.steps[nextIdx];
    updateTask(task.id, {
      status: isLast ? "completed" : "in_progress",
      currentStepIndex: isLast ? task.currentStepIndex : nextIdx,
      currentStepId: nextStep?.id || task.currentStepId,
      currentStepName: nextStep?.name || task.currentStepName,
      assignedTeamId: nextStep?.teamId || task.assignedTeamId,
      assignedTeamName: nextStep?.teamName || task.assignedTeamName,
    });
    toast({ title: isLast ? "Task completed!" : `Moved to step: ${nextStep?.name}` });
  };

  const handleSendBack = () => {
    if (task.currentStepIndex === 0) return;
    const prevIdx = task.currentStepIndex - 1;
    const prevStep = task.workflow?.steps?.[prevIdx];
    updateTask(task.id, {
      currentStepIndex: prevIdx,
      currentStepId: prevStep?.id || "",
      currentStepName: prevStep?.name || "",
      assignedTeamId: prevStep?.teamId || "",
      assignedTeamName: prevStep?.teamName || "",
    });
    toast({ title: "Task sent back to previous step" });
    setShowSendBack(false);
  };

  const handleHold = () => {
    updateTask(task.id, { status: task.status === "on_hold" ? "in_progress" : "on_hold" });
    toast({ title: task.status === "on_hold" ? "Task resumed" : "Task put on hold" });
  };

  const handleClose = () => {
    updateTask(task.id, { status: "closed" });
    toast({ title: "Task closed" });
    setConfirmClose(false);
  };

  const handleAddComment = () => {
    if (!comment.trim()) return;
    addComment(task.id, {
      id: `c-${Date.now()}`,
      taskId: task.id,
      userId: user?.id || "",
      userName: user?.name || "",
      userAvatar: user?.avatar,
      content: comment,
      isInternal,
      createdAt: new Date().toISOString(),
    });
    setComment("");
    toast({ title: "Comment added" });
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div>
        <Link href="/admin/tasks">
          <Button variant="ghost" size="sm" className="text-muted-foreground hover:text-foreground mb-3 -ml-2">
            <ArrowLeft className="h-4 w-4 mr-1" /> Back to Tasks
          </Button>
        </Link>
        <div className="flex items-start justify-between gap-4">
          <div className="flex-1">
            <div className="flex flex-wrap items-center gap-2 mb-2">
              <span className={`text-xs px-2 py-1 rounded-full font-medium ${getStatusBadge(task.status)}`}>
                {task.status.replace("_", " ")}
              </span>
              <span className={`text-xs px-2 py-1 rounded-full font-medium ${getPriorityBadge(task.priority)}`}>
                {task.priority}
              </span>
              {task.isOverdue && (
                <span className="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 flex items-center gap-1">
                  <AlertTriangle className="h-3 w-3" /> Overdue
                </span>
              )}
            </div>
            <h1 className="text-2xl font-bold text-foreground">{task.title}</h1>
          </div>
          {/* Action Buttons */}
          <div className="flex flex-wrap items-center gap-2 shrink-0">
            {task.status !== "completed" && task.status !== "closed" && (
              <Button size="sm" onClick={handleComplete} className="bg-green-600 hover:bg-green-700 text-white">
                <CheckCircle2 className="h-4 w-4 mr-1" /> Complete Step
              </Button>
            )}
            {task.currentStepIndex > 0 && task.status !== "closed" && (
              <Button size="sm" variant="outline" onClick={() => setShowSendBack(true)}>
                <RotateCcw className="h-4 w-4 mr-1" /> Send Back
              </Button>
            )}
            <Button size="sm" variant="outline" onClick={() => setShowReassign(true)}>
              <UserCheck className="h-4 w-4 mr-1" /> Reassign
            </Button>
            <Button size="sm" variant="outline" onClick={handleHold}>
              <Pause className="h-4 w-4 mr-1" /> {task.status === "on_hold" ? "Resume" : "Hold"}
            </Button>
            {task.status !== "closed" && (
              <Button size="sm" variant="outline" className="text-red-600 border-red-200 hover:bg-red-50" onClick={() => setConfirmClose(true)}>
                <XCircle className="h-4 w-4 mr-1" /> Close
              </Button>
            )}
          </div>
        </div>
      </div>

      {/* Step Timeline */}
      <Card className="border-border">
        <CardHeader className="pb-3">
          <CardTitle className="text-sm font-semibold text-muted-foreground uppercase tracking-wide">Progress — Step {task.currentStepIndex + 1} of {task.totalSteps}</CardTitle>
        </CardHeader>
        <CardContent>
          <StepTimeline task={task} />
        </CardContent>
      </Card>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main Content */}
        <div className="lg:col-span-2 space-y-4">
          {/* Description */}
          {task.description && (
            <Card className="border-border">
              <CardHeader className="pb-2">
                <CardTitle className="text-base font-semibold">Description</CardTitle>
              </CardHeader>
              <CardContent>
                <p className="text-sm text-foreground whitespace-pre-wrap">{task.description}</p>
              </CardContent>
            </Card>
          )}

          {/* Attachments */}
          <Card className="border-border">
            <CardHeader className="pb-2">
              <CardTitle className="text-base font-semibold flex items-center gap-2">
                <Paperclip className="h-4 w-4" /> Attachments
                <span className="text-muted-foreground font-normal text-sm">({task.attachments?.length || 0})</span>
              </CardTitle>
            </CardHeader>
            <CardContent>
              {!task.attachments?.length ? (
                <p className="text-sm text-muted-foreground">No attachments</p>
              ) : (
                <div className="space-y-2">
                  {task.attachments.map((att: any) => (
                    <div key={att.id} className="flex items-center gap-3 p-3 border border-border rounded-lg hover:bg-muted/30 transition-colors">
                      <FileText className="h-5 w-5 text-muted-foreground shrink-0" />
                      <div className="flex-1 min-w-0">
                        <p className="text-sm font-medium text-foreground truncate">{att.fileName}</p>
                        <p className="text-xs text-muted-foreground">{(att.fileSize / 1024).toFixed(0)} KB · {att.uploadedByName}</p>
                      </div>
                      <Button variant="ghost" size="sm" className="h-7 px-2">
                        <Download className="h-3.5 w-3.5" />
                      </Button>
                    </div>
                  ))}
                </div>
              )}
            </CardContent>
          </Card>

          {/* Comments / Notes / Activity Tabs */}
          <Card className="border-border">
            <Tabs value={activeTab} onValueChange={setActiveTab}>
              <CardHeader className="pb-0">
                <TabsList className="w-full justify-start bg-transparent border-b border-border rounded-none p-0 h-auto gap-0">
                  <TabsTrigger value="comments" className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium">
                    Comments ({task.comments?.length || 0})
                  </TabsTrigger>
                  <TabsTrigger value="notes" className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium">
                    <Lock className="h-3.5 w-3.5 mr-1.5" /> Internal Notes ({task.internalNotes?.length || 0})
                  </TabsTrigger>
                  <TabsTrigger value="activity" className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium">
                    Activity Log
                  </TabsTrigger>
                </TabsList>
              </CardHeader>
              <TabsContent value="comments" className="m-0">
                <CardContent className="pt-4">
                  <div className="space-y-4 mb-4">
                    {!task.comments?.length ? (
                      <p className="text-sm text-muted-foreground text-center py-4">No comments yet. Be the first to comment.</p>
                    ) : (
                      task.comments.map((c: any) => (
                        <div key={c.id} className="flex gap-3">
                          <Avatar className="h-7 w-7 shrink-0">
                            <AvatarImage src={c.userAvatar} />
                            <AvatarFallback className="text-xs">{c.userName?.[0]}</AvatarFallback>
                          </Avatar>
                          <div className="flex-1">
                            <div className="flex items-center gap-2 mb-1">
                              <span className="text-sm font-medium text-foreground">{c.userName}</span>
                              <span className="text-xs text-muted-foreground">{formatDistanceToNow(new Date(c.createdAt), { addSuffix: true })}</span>
                            </div>
                            <div className="bg-muted/40 rounded-lg p-3">
                              <p className="text-sm text-foreground whitespace-pre-wrap">{c.content}</p>
                            </div>
                          </div>
                        </div>
                      ))
                    )}
                  </div>
                  <div className="border-t border-border pt-4 space-y-3">
                    <Textarea placeholder="Add a comment..." value={comment} onChange={e => setComment(e.target.value)} rows={3} />
                    <div className="flex items-center justify-between">
                      <label className="flex items-center gap-2 text-sm text-muted-foreground cursor-pointer">
                        <input type="checkbox" checked={isInternal} onChange={e => setIsInternal(e.target.checked)} className="rounded" />
                        Internal only
                      </label>
                      <Button size="sm" onClick={handleAddComment} disabled={!comment.trim()}>Add Comment</Button>
                    </div>
                  </div>
                </CardContent>
              </TabsContent>
              <TabsContent value="notes" className="m-0">
                <CardContent className="pt-4">
                  <div className="space-y-4 mb-4">
                    {!task.internalNotes?.length ? (
                      <p className="text-sm text-muted-foreground text-center py-4">No internal notes</p>
                    ) : (
                      task.internalNotes.map((n: any) => (
                        <div key={n.id} className="flex gap-3">
                          <Avatar className="h-7 w-7 shrink-0">
                            <AvatarFallback className="text-xs">{n.userName?.[0]}</AvatarFallback>
                          </Avatar>
                          <div className="flex-1">
                            <div className="flex items-center gap-2 mb-1">
                              <span className="text-sm font-medium text-foreground">{n.userName}</span>
                              <span className="text-xs text-muted-foreground">{formatDistanceToNow(new Date(n.createdAt), { addSuffix: true })}</span>
                              <span className="text-xs bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 px-1.5 py-0.5 rounded">Internal</span>
                            </div>
                            <div className="bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/30 rounded-lg p-3">
                              <p className="text-sm text-foreground">{n.content}</p>
                            </div>
                          </div>
                        </div>
                      ))
                    )}
                  </div>
                  <div className="border-t border-border pt-4 space-y-3">
                    <Textarea placeholder="Add internal note (only admins can see this)..." value={isInternal ? comment : ""} onChange={e => { setComment(e.target.value); setIsInternal(true); }} rows={3} />
                    <Button size="sm" onClick={handleAddComment} disabled={!comment.trim()}>Add Note</Button>
                  </div>
                </CardContent>
              </TabsContent>
              <TabsContent value="activity" className="m-0">
                <CardContent className="pt-4">
                  {!task.activityLog?.length ? (
                    <p className="text-sm text-muted-foreground text-center py-4">No activity recorded</p>
                  ) : (
                    <div className="space-y-3">
                      {task.activityLog.map((item: any) => (
                        <div key={item.id} className="flex items-start gap-3">
                          <div className="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-0.5">
                            <Clock className="h-3 w-3 text-primary" />
                          </div>
                          <div className="flex-1">
                            <p className="text-sm text-foreground">
                              <span className="font-medium">{item.userName}</span> {item.description}
                            </p>
                            <p className="text-xs text-muted-foreground">{formatDistanceToNow(new Date(item.createdAt), { addSuffix: true })}</p>
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </CardContent>
              </TabsContent>
            </Tabs>
          </Card>
        </div>

        {/* Sidebar Metadata */}
        <div className="space-y-4">
          <Card className="border-border">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">Details</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4 text-sm">
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Workflow</p>
                <p className="font-medium text-foreground">{task.workflowName}</p>
              </div>
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Current Step</p>
                <p className="font-medium text-foreground">{task.currentStepName}</p>
              </div>
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Assigned Team</p>
                <p className="font-medium text-foreground">{task.assignedTeamName || "—"}</p>
              </div>
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Assigned To</p>
                <p className="font-medium text-foreground">{task.assignedUserName || "Unassigned"}</p>
              </div>
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Created By</p>
                <p className="font-medium text-foreground">{task.createdByName || "—"}</p>
              </div>
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Created</p>
                <p className="font-medium text-foreground">{format(new Date(task.createdAt), "MMM d, yyyy")}</p>
              </div>
              {task.dueDate && (
                <div>
                  <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Due Date</p>
                  <p className={`font-medium ${task.isOverdue ? "text-red-500" : "text-foreground"}`}>
                    {format(new Date(task.dueDate), "MMM d, yyyy")}
                    {task.isOverdue && " (Overdue)"}
                  </p>
                </div>
              )}
            </CardContent>
          </Card>
        </div>
      </div>

      {/* Send Back Dialog */}
      <Dialog open={showSendBack} onOpenChange={setShowSendBack}>
        <DialogContent>
          <DialogHeader><DialogTitle>Send Task Back</DialogTitle></DialogHeader>
          <div>
            <Label className="mb-2 block">Reason (optional)</Label>
            <Textarea placeholder="Explain why you're sending this back..." value={sendBackReason} onChange={e => setSendBackReason(e.target.value)} rows={3} />
          </div>
          <DialogFooter>
            <Button variant="outline" onClick={() => setShowSendBack(false)}>Cancel</Button>
            <Button onClick={handleSendBack}>Send Back</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>

      {/* Reassign Dialog */}
      <Dialog open={showReassign} onOpenChange={setShowReassign}>
        <DialogContent>
          <DialogHeader><DialogTitle>Reassign Task</DialogTitle></DialogHeader>
          <div>
            <Label className="mb-2 block">Assign To</Label>
            <Select value={reassignUserId} onValueChange={setReassignUserId}>
              <SelectTrigger><SelectValue placeholder="Select user" /></SelectTrigger>
              <SelectContent>
                {users.map(u => <SelectItem key={u.id} value={u.id}>{u.name} — {u.teamName}</SelectItem>)}
              </SelectContent>
            </Select>
          </div>
          <DialogFooter>
            <Button variant="outline" onClick={() => setShowReassign(false)}>Cancel</Button>
            <Button onClick={() => {
              if (!reassignUserId) return;
              const u = users.find(x => x.id === reassignUserId);
              updateTask(task.id, { assignedUserId: reassignUserId, assignedUserName: u?.name });
              toast({ title: `Reassigned to ${u?.name}` });
              setShowReassign(false);
            }}>Reassign</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>

      {/* Close Confirmation */}
      <Dialog open={confirmClose} onOpenChange={setConfirmClose}>
        <DialogContent>
          <DialogHeader><DialogTitle>Close Task</DialogTitle></DialogHeader>
          <p className="text-muted-foreground text-sm">Are you sure you want to close this task? This action cannot be undone easily.</p>
          <DialogFooter>
            <Button variant="outline" onClick={() => setConfirmClose(false)}>Cancel</Button>
            <Button variant="destructive" onClick={handleClose}>Close Task</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
