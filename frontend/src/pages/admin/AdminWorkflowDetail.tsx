import { useRoute, Link } from "wouter";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { ArrowLeft, AlertTriangle, CheckSquare, ArrowRight, GitMerge } from "lucide-react";

function getStepTypeBadge(type: string) {
  const cfg: Record<string, string> = {
    approval: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    review: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    action: "bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400",
  };
  return cfg[type] || cfg.action;
}

export default function AdminWorkflowDetail() {
  const [, params] = useRoute("/admin/workflows/:id");
  const { workflows, tasks } = useData();
  const wf = workflows.find(w => w.id === params?.id);

  if (!wf) {
    return (
      <div className="flex flex-col items-center justify-center h-64 gap-4">
        <AlertTriangle className="h-12 w-12 text-muted-foreground" />
        <p className="text-muted-foreground">Workflow not found</p>
        <Link href="/admin/workflows"><Button variant="outline">Back to Workflows</Button></Link>
      </div>
    );
  }

  const wfTasks = tasks.filter(t => t.workflowId === wf.id);

  return (
    <div className="space-y-6">
      <div>
        <Link href="/admin/workflows">
          <Button variant="ghost" size="sm" className="text-muted-foreground hover:text-foreground mb-3 -ml-2">
            <ArrowLeft className="h-4 w-4 mr-1" /> Back to Workflows
          </Button>
        </Link>
        <div className="flex items-center gap-3">
          <div className="h-12 w-12 rounded-xl bg-primary/10 flex items-center justify-center">
            <GitMerge className="h-6 w-6 text-primary" />
          </div>
          <div>
            <h1 className="text-2xl font-bold text-foreground">{wf.name}</h1>
            {wf.description && <p className="text-muted-foreground text-sm">{wf.description}</p>}
          </div>
        </div>
      </div>

      {/* Step Builder */}
      <Card className="border-border">
        <CardHeader className="pb-3">
          <CardTitle className="text-base font-semibold">Workflow Steps</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="space-y-3">
            {wf.steps?.map((step, idx) => (
              <div key={step.id} className="flex items-start gap-4">
                <div className="flex flex-col items-center">
                  <div className="h-9 w-9 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-sm font-bold">{idx + 1}</div>
                  {idx < (wf.steps?.length || 0) - 1 && <div className="w-0.5 h-8 bg-border mt-1" />}
                </div>
                <div className="flex-1 pb-4">
                  <div className="flex items-center gap-2 mb-1">
                    <span className="font-semibold text-foreground">{step.name}</span>
                    <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${getStepTypeBadge(step.stepType)}`}>{step.stepType}</span>
                    {step.required && <span className="text-xs text-muted-foreground">Required</span>}
                  </div>
                  {step.description && <p className="text-sm text-muted-foreground mb-1">{step.description}</p>}
                  {step.teamName && (
                    <span className="text-xs bg-muted px-2 py-0.5 rounded text-muted-foreground">
                      Assigned to: {step.teamName}
                    </span>
                  )}
                </div>
              </div>
            ))}
          </div>
        </CardContent>
      </Card>

      {/* Tasks using this workflow */}
      <Card className="border-border">
        <CardHeader className="pb-3">
          <CardTitle className="text-base font-semibold">Tasks ({wfTasks.length})</CardTitle>
        </CardHeader>
        <CardContent>
          {wfTasks.length === 0 ? (
            <p className="text-muted-foreground text-sm text-center py-6">No tasks using this workflow yet</p>
          ) : (
            <div className="space-y-2">
              {wfTasks.map(task => (
                <Link key={task.id} href={`/admin/tasks/${task.id}`}>
                  <div className="flex items-center gap-3 p-2 rounded-lg hover:bg-muted/40 transition-colors cursor-pointer group">
                    <CheckSquare className="h-4 w-4 text-muted-foreground shrink-0" />
                    <span className="flex-1 text-sm font-medium text-foreground group-hover:text-primary transition-colors">{task.title}</span>
                    <span className="text-xs text-muted-foreground">Step {task.currentStepIndex + 1}/{task.totalSteps}</span>
                  </div>
                </Link>
              ))}
            </div>
          )}
        </CardContent>
      </Card>
    </div>
  );
}
