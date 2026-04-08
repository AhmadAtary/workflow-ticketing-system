import { useState } from "react";
import { useData } from "../../contexts/DataContext";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { useToast } from "@/hooks/use-toast";
import { Search, Plus, GitMerge, ChevronRight, MoreHorizontal, Pencil, Trash2, GripVertical, ArrowRight } from "lucide-react";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
import { format } from "date-fns";

function getStatusBadge(status: string) {
  const cfg: Record<string, { label: string; class: string }> = {
    active: { label: "Active", class: "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" },
    inactive: { label: "Inactive", class: "bg-gray-100 text-gray-500" },
    draft: { label: "Draft", class: "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400" },
  };
  return cfg[status] || cfg.draft;
}

function getStepTypeBadge(type: string) {
  const cfg: Record<string, string> = {
    approval: "bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400",
    review: "bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400",
    action: "bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400",
  };
  return cfg[type] || cfg.action;
}

export default function AdminWorkflows() {
  const { workflows, teams, addWorkflow, updateWorkflow, deleteWorkflow } = useData();
  const { toast } = useToast();
  const [search, setSearch] = useState("");
  const [showCreate, setShowCreate] = useState(false);
  const [showEdit, setShowEdit] = useState<any>(null);
  const [deleteConfirm, setDeleteConfirm] = useState<any>(null);
  const [form, setForm] = useState({ name: "", description: "", status: "draft" });
  const [steps, setSteps] = useState<any[]>([]);

  const filtered = workflows.filter(w => !search || w.name.toLowerCase().includes(search.toLowerCase()));

  const addStep = () => setSteps(s => [...s, { id: `new-${Date.now()}`, name: "", description: "", order: s.length + 1, teamId: "", teamName: "", stepType: "action", required: true }]);
  const removeStep = (idx: number) => setSteps(s => s.filter((_, i) => i !== idx));
  const updateStep = (idx: number, field: string, value: string) => setSteps(s => s.map((step, i) => i === idx ? { ...step, [field]: value, ...(field === "teamId" ? { teamName: teams.find(t => t.id === value)?.name || "" } : {}) } : step));

  const openCreate = () => {
    setForm({ name: "", description: "", status: "draft" });
    setSteps([{ id: `new-${Date.now()}`, name: "Step 1", description: "", order: 1, teamId: "", teamName: "", stepType: "action", required: true }]);
    setShowCreate(true);
  };

  const openEdit = (wf: any) => {
    setForm({ name: wf.name, description: wf.description || "", status: wf.status });
    setSteps([...(wf.steps || [])]);
    setShowEdit(wf);
  };

  const handleCreate = () => {
    if (!form.name || steps.length === 0) { toast({ title: "Name and at least one step required", variant: "destructive" }); return; }
    addWorkflow({ id: `wf-${Date.now()}`, name: form.name, description: form.description, status: form.status as any, steps: steps.map((s, i) => ({ ...s, order: i + 1 })), taskCount: 0, createdAt: new Date().toISOString() });
    toast({ title: "Workflow created" });
    setShowCreate(false);
  };

  const handleEdit = () => {
    if (!form.name) { toast({ title: "Name required", variant: "destructive" }); return; }
    updateWorkflow(showEdit.id, { name: form.name, description: form.description, status: form.status as any, steps: steps.map((s, i) => ({ ...s, order: i + 1 })) });
    toast({ title: "Workflow updated" });
    setShowEdit(null);
  };

  const WorkflowFormContent = () => (
    <div className="space-y-4 max-h-[60vh] overflow-y-auto pr-1">
      <div>
        <Label>Workflow Name *</Label>
        <Input value={form.name} onChange={e => setForm(p => ({ ...p, name: e.target.value }))} placeholder="e.g. Software Release" className="mt-1" />
      </div>
      <div>
        <Label>Description</Label>
        <Textarea value={form.description} onChange={e => setForm(p => ({ ...p, description: e.target.value }))} placeholder="Describe this workflow..." className="mt-1" rows={2} />
      </div>
      <div>
        <Label>Status</Label>
        <Select value={form.status} onValueChange={v => setForm(p => ({ ...p, status: v }))}>
          <SelectTrigger className="mt-1"><SelectValue /></SelectTrigger>
          <SelectContent>
            <SelectItem value="draft">Draft</SelectItem>
            <SelectItem value="active">Active</SelectItem>
            <SelectItem value="inactive">Inactive</SelectItem>
          </SelectContent>
        </Select>
      </div>

      <div>
        <div className="flex items-center justify-between mb-2">
          <Label>Steps</Label>
          <Button type="button" variant="outline" size="sm" className="h-7 text-xs" onClick={addStep}>
            <Plus className="h-3 w-3 mr-1" /> Add Step
          </Button>
        </div>
        <div className="space-y-3">
          {steps.map((step, idx) => (
            <div key={step.id} className="border border-border rounded-lg p-3 space-y-2">
              <div className="flex items-center gap-2">
                <GripVertical className="h-4 w-4 text-muted-foreground cursor-grab" />
                <span className="text-xs font-semibold text-muted-foreground">Step {idx + 1}</span>
                <Button type="button" variant="ghost" size="sm" className="ml-auto h-6 px-2 text-red-500 hover:text-red-600" onClick={() => removeStep(idx)}>
                  <Trash2 className="h-3.5 w-3.5" />
                </Button>
              </div>
              <div className="grid grid-cols-2 gap-2">
                <div>
                  <Label className="text-xs">Name</Label>
                  <Input value={step.name} onChange={e => updateStep(idx, "name", e.target.value)} placeholder="Step name" className="mt-0.5 h-8 text-sm" />
                </div>
                <div>
                  <Label className="text-xs">Type</Label>
                  <Select value={step.stepType} onValueChange={v => updateStep(idx, "stepType", v)}>
                    <SelectTrigger className="mt-0.5 h-8 text-sm"><SelectValue /></SelectTrigger>
                    <SelectContent>
                      <SelectItem value="action">Action</SelectItem>
                      <SelectItem value="review">Review</SelectItem>
                      <SelectItem value="approval">Approval</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
              </div>
              <div>
                <Label className="text-xs">Assigned Team</Label>
                <Select value={step.teamId} onValueChange={v => updateStep(idx, "teamId", v)}>
                  <SelectTrigger className="mt-0.5 h-8 text-sm"><SelectValue placeholder="Select team" /></SelectTrigger>
                  <SelectContent>
                    <SelectItem value="">Unassigned</SelectItem>
                    {teams.map(t => <SelectItem key={t.id} value={t.id}>{t.name}</SelectItem>)}
                  </SelectContent>
                </Select>
              </div>
            </div>
          ))}
          {steps.length === 0 && (
            <div className="text-center py-4 text-muted-foreground text-sm border border-dashed border-border rounded-lg">
              No steps yet. Add at least one step.
            </div>
          )}
        </div>
      </div>
    </div>
  );

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Workflows</h1>
          <p className="text-sm text-muted-foreground mt-1">{workflows.length} workflows</p>
        </div>
        <Button onClick={openCreate}>
          <Plus className="h-4 w-4 mr-2" /> New Workflow
        </Button>
      </div>

      <div className="relative max-w-sm">
        <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
        <Input placeholder="Search workflows..." value={search} onChange={e => setSearch(e.target.value)} className="pl-9" />
      </div>

      {filtered.length === 0 ? (
        <div className="text-center py-16 text-muted-foreground">
          <GitMerge className="h-12 w-12 mx-auto mb-3 opacity-40" />
          <p>No workflows found</p>
        </div>
      ) : (
        <div className="space-y-4">
          {filtered.map(wf => {
            const statusCfg = getStatusBadge(wf.status);
            return (
              <Card key={wf.id} className="border-border hover:shadow-sm transition-shadow group">
                <CardContent className="pt-5">
                  <div className="flex items-start justify-between gap-4 mb-3">
                    <div className="flex-1">
                      <div className="flex items-center gap-2 mb-1">
                        <h3 className="font-semibold text-foreground">{wf.name}</h3>
                        <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${statusCfg.class}`}>{statusCfg.label}</span>
                      </div>
                      {wf.description && <p className="text-sm text-muted-foreground">{wf.description}</p>}
                      <div className="flex items-center gap-2 mt-2 text-xs text-muted-foreground">
                        <span>{wf.steps?.length || 0} steps</span>
                        <span>·</span>
                        <span>{wf.taskCount} tasks</span>
                        <span>·</span>
                        <span>Created {format(new Date(wf.createdAt), "MMM d, yyyy")}</span>
                      </div>
                    </div>
                    <div className="flex items-center gap-1">
                      <Link href={`/admin/workflows/${wf.id}`}>
                        <Button variant="outline" size="sm" className="h-8 opacity-0 group-hover:opacity-100 transition-opacity">
                          <ChevronRight className="h-4 w-4" />
                        </Button>
                      </Link>
                      <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                          <Button variant="ghost" size="sm" className="h-8 px-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <MoreHorizontal className="h-4 w-4" />
                          </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                          <DropdownMenuItem onClick={() => openEdit(wf)}><Pencil className="h-4 w-4 mr-2" /> Edit</DropdownMenuItem>
                          <DropdownMenuItem className="text-red-600" onClick={() => setDeleteConfirm(wf)}><Trash2 className="h-4 w-4 mr-2" /> Delete</DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </div>
                  </div>

                  {/* Step Flow */}
                  {wf.steps && wf.steps.length > 0 && (
                    <div className="flex flex-wrap items-center gap-1 mt-3">
                      {wf.steps.map((step, idx) => (
                        <div key={step.id} className="flex items-center gap-1">
                          <div className="flex items-center gap-1.5 px-2 py-1 bg-muted rounded text-xs">
                            <span className="font-medium">{step.name}</span>
                            <span className={`px-1 py-0.5 rounded text-xs ${getStepTypeBadge(step.stepType)}`}>{step.stepType}</span>
                          </div>
                          {idx < wf.steps.length - 1 && <ArrowRight className="h-3 w-3 text-muted-foreground" />}
                        </div>
                      ))}
                    </div>
                  )}
                </CardContent>
              </Card>
            );
          })}
        </div>
      )}

      {(showCreate || showEdit) && (
        <Dialog open={true} onOpenChange={() => { setShowCreate(false); setShowEdit(null); }}>
          <DialogContent className="max-w-lg">
            <DialogHeader><DialogTitle>{showEdit ? "Edit Workflow" : "Create Workflow"}</DialogTitle></DialogHeader>
            <WorkflowFormContent />
            <DialogFooter>
              <Button variant="outline" onClick={() => { setShowCreate(false); setShowEdit(null); }}>Cancel</Button>
              <Button onClick={showEdit ? handleEdit : handleCreate}>{showEdit ? "Save" : "Create"}</Button>
            </DialogFooter>
          </DialogContent>
        </Dialog>
      )}

      <Dialog open={!!deleteConfirm} onOpenChange={() => setDeleteConfirm(null)}>
        <DialogContent>
          <DialogHeader><DialogTitle>Delete Workflow</DialogTitle></DialogHeader>
          <p className="text-muted-foreground text-sm">Delete <strong>{deleteConfirm?.name}</strong>? This cannot be undone.</p>
          <DialogFooter>
            <Button variant="outline" onClick={() => setDeleteConfirm(null)}>Cancel</Button>
            <Button variant="destructive" onClick={() => { deleteWorkflow(deleteConfirm.id); toast({ title: "Workflow deleted" }); setDeleteConfirm(null); }}>Delete</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
