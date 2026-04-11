import { useEffect, useState } from "react";
import { Link, useRoute } from "wouter";
import { AlertTriangle, ArrowLeft, CheckCircle2, Clock, Download, FileText, Paperclip } from "lucide-react";
import { format, formatDistanceToNow } from "date-fns";
import type { TaskDetail } from "@flowdesk/api-client";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Textarea } from "@/components/ui/textarea";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { useToast } from "@/hooks/use-toast";

function getStatusBadge(status: string) {
  const cfg: Record<string, string> = {
    open: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    in_progress: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    on_hold: "bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400",
    completed: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400",
    closed: "bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400",
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

export default function UserTaskDetail() {
  const [, params] = useRoute("/my-tasks/:id");
  const { getTaskById, updateTask, addComment } = useData();
  const { toast } = useToast();
  const [task, setTask] = useState<TaskDetail | null>(null);
  const [isLoadingTask, setIsLoadingTask] = useState(true);
  const [comment, setComment] = useState("");
  const [activeTab, setActiveTab] = useState("comments");

  const taskId = params?.id ?? "";

  const reloadTask = async () => {
    if (!taskId) {
      setTask(null);
      setIsLoadingTask(false);
      return;
    }

    setIsLoadingTask(true);
    const nextTask = await getTaskById(taskId);
    setTask(nextTask);
    setIsLoadingTask(false);
  };

  useEffect(() => {
    void reloadTask();
  }, [taskId]);

  if (isLoadingTask) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <div className="h-8 w-8 border-2 border-primary border-t-transparent rounded-full animate-spin" />
        <p className="text-muted-foreground">Loading task details...</p>
      </div>
    );
  }

  if (!task) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <AlertTriangle className="h-12 w-12 text-muted-foreground" />
        <p className="text-muted-foreground">Task not found</p>
        <Link href="/my-tasks">
          <Button variant="outline">Back to Tasks</Button>
        </Link>
      </div>
    );
  }

  const handleComplete = async () => {
    if (!task.workflow?.steps) {
      return;
    }

    const nextIndex = task.currentStepIndex + 1;
    const isLast = nextIndex >= task.totalSteps;
    const nextStep = task.workflow.steps[nextIndex];

    await updateTask(task.id, {
      status: isLast ? "completed" : "in_progress",
      currentStepIndex: isLast ? task.currentStepIndex : nextIndex,
      currentStepId: nextStep?.id || task.currentStepId,
    });

    await reloadTask();
    toast({ title: isLast ? "Task completed" : `Moved to ${nextStep?.name}` });
  };

  const handleAddComment = async () => {
    if (!comment.trim()) {
      return;
    }

    await addComment(task.id, {
      content: comment,
      isInternal: false,
    });

    setComment("");
    await reloadTask();
    toast({ title: "Comment added" });
  };

  const steps = task.workflow?.steps || [];

  return (
    <div className="max-w-4xl mx-auto space-y-5">
      <div>
        <Link href="/my-tasks">
          <Button variant="ghost" size="sm" className="text-muted-foreground hover:text-foreground mb-3 -ml-2">
            <ArrowLeft className="h-4 w-4 mr-1" /> My Tasks
          </Button>
        </Link>
        <div className="flex flex-wrap items-start gap-3">
          <div className="flex-1">
            <div className="flex flex-wrap gap-2 mb-2">
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
            <h1 className="text-xl font-bold text-foreground">{task.title}</h1>
          </div>
          {task.status !== "completed" && task.status !== "closed" && (
            <Button onClick={() => void handleComplete()} className="bg-green-600 hover:bg-green-700 text-white">
              <CheckCircle2 className="h-4 w-4 mr-2" /> Complete Step
            </Button>
          )}
        </div>
      </div>

      {steps.length > 0 && (
        <Card className="border-border">
          <CardContent className="pt-4">
            <p className="text-xs text-muted-foreground uppercase tracking-wide mb-3">
              Progress - Step {task.currentStepIndex + 1} of {task.totalSteps}
            </p>
            <div className="flex items-center gap-0 overflow-x-auto pb-1">
              {steps.map((step, index) => {
                const isDone = index < task.currentStepIndex;
                const isCurrent = index === task.currentStepIndex;

                return (
                  <div key={step.id} className="flex items-center flex-1 min-w-[100px]">
                    <div className="flex flex-col items-center">
                      <div
                        className={`h-7 w-7 rounded-full flex items-center justify-center border-2 transition-colors ${
                          isDone
                            ? "bg-green-500 border-green-500 text-white"
                            : isCurrent
                              ? "bg-primary border-primary text-white"
                              : "bg-background border-border text-muted-foreground"
                        }`}
                      >
                        {isDone ? <CheckCircle2 className="h-3.5 w-3.5" /> : <span className="text-xs font-bold">{index + 1}</span>}
                      </div>
                      <p
                        className={`text-xs mt-1.5 text-center leading-tight ${
                          isCurrent ? "text-primary font-medium" : isDone ? "text-green-600 dark:text-green-400" : "text-muted-foreground"
                        }`}
                      >
                        {step.name}
                      </p>
                    </div>
                    {index < steps.length - 1 && <div className={`h-0.5 flex-1 mx-1 mb-4 ${isDone ? "bg-green-500" : "bg-border"}`} />}
                  </div>
                );
              })}
            </div>
          </CardContent>
        </Card>
      )}

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div className="lg:col-span-2 space-y-4">
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

          {task.attachments && task.attachments.length > 0 && (
            <Card className="border-border">
              <CardHeader className="pb-2">
                <CardTitle className="text-base font-semibold flex items-center gap-2">
                  <Paperclip className="h-4 w-4" /> Attachments ({task.attachments.length})
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-2">
                  {task.attachments.map((attachment) => (
                    <div key={attachment.id} className="flex items-center gap-3 p-3 border border-border rounded-lg">
                      <FileText className="h-4 w-4 text-muted-foreground shrink-0" />
                      <div className="flex-1">
                        <p className="text-sm font-medium">{attachment.fileName}</p>
                        <p className="text-xs text-muted-foreground">{(attachment.fileSize / 1024).toFixed(0)} KB</p>
                      </div>
                      <Button variant="ghost" size="sm" className="h-7 px-2" asChild>
                        <a href={attachment.url} target="_blank" rel="noreferrer">
                          <Download className="h-3.5 w-3.5" />
                        </a>
                      </Button>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          )}

          <Card className="border-border">
            <Tabs value={activeTab} onValueChange={setActiveTab}>
              <CardHeader className="pb-0">
                <TabsList className="w-full justify-start bg-transparent border-b border-border rounded-none p-0 h-auto gap-0">
                  <TabsTrigger
                    value="comments"
                    className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium"
                  >
                    Comments ({task.comments?.length || 0})
                  </TabsTrigger>
                  <TabsTrigger
                    value="activity"
                    className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium"
                  >
                    Activity
                  </TabsTrigger>
                </TabsList>
              </CardHeader>
              <TabsContent value="comments" className="m-0">
                <CardContent className="pt-4">
                  <div className="space-y-4 mb-4">
                    {!task.comments?.length ? (
                      <p className="text-sm text-muted-foreground text-center py-4">No comments yet</p>
                    ) : (
                      task.comments
                        .filter((entry) => !entry.isInternal)
                        .map((entry) => (
                          <div key={entry.id} className="flex gap-3">
                            <Avatar className="h-7 w-7 shrink-0">
                              <AvatarImage src={entry.userAvatar} />
                              <AvatarFallback className="text-xs">{entry.userName?.[0]}</AvatarFallback>
                            </Avatar>
                            <div className="flex-1">
                              <div className="flex items-center gap-2 mb-1">
                                <span className="text-sm font-medium">{entry.userName}</span>
                                <span className="text-xs text-muted-foreground">
                                  {formatDistanceToNow(new Date(entry.createdAt), { addSuffix: true })}
                                </span>
                              </div>
                              <div className="bg-muted/40 rounded-lg p-3">
                                <p className="text-sm">{entry.content}</p>
                              </div>
                            </div>
                          </div>
                        ))
                    )}
                  </div>
                  <div className="border-t border-border pt-4 space-y-3">
                    <Textarea placeholder="Add a comment..." value={comment} onChange={(event) => setComment(event.target.value)} rows={3} />
                    <Button size="sm" onClick={() => void handleAddComment()} disabled={!comment.trim()}>
                      Add Comment
                    </Button>
                  </div>
                </CardContent>
              </TabsContent>
              <TabsContent value="activity" className="m-0">
                <CardContent className="pt-4">
                  {!task.activityLog?.length ? (
                    <p className="text-sm text-muted-foreground text-center py-4">No activity recorded</p>
                  ) : (
                    <div className="space-y-3">
                      {task.activityLog.map((entry) => (
                        <div key={entry.id} className="flex items-start gap-3">
                          <div className="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-0.5">
                            <Clock className="h-3 w-3 text-primary" />
                          </div>
                          <div>
                            <p className="text-sm">
                              <span className="font-medium">{entry.userName}</span> {entry.description}
                            </p>
                            <p className="text-xs text-muted-foreground">
                              {formatDistanceToNow(new Date(entry.createdAt), { addSuffix: true })}
                            </p>
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

        <Card className="border-border h-fit">
          <CardHeader className="pb-3">
            <CardTitle className="text-base font-semibold">Details</CardTitle>
          </CardHeader>
          <CardContent className="space-y-3 text-sm">
            <div>
              <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Workflow</p>
              <p className="font-medium">{task.workflowName}</p>
            </div>
            <div>
              <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Current Step</p>
              <p className="font-medium">{task.currentStepName}</p>
            </div>
            <div>
              <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Team</p>
              <p className="font-medium">{task.assignedTeamName || "-"}</p>
            </div>
            <div>
              <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Created</p>
              <p className="font-medium">{format(new Date(task.createdAt), "MMM d, yyyy")}</p>
            </div>
            {task.dueDate && (
              <div>
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Due Date</p>
                <p className={`font-medium ${task.isOverdue ? "text-red-500" : ""}`}>
                  {format(new Date(task.dueDate), "MMM d, yyyy")}
                  {task.isOverdue ? " (Overdue)" : ""}
                </p>
              </div>
            )}
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
