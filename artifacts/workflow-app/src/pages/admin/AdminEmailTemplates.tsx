import { useState } from "react";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { Card, CardContent } from "@/components/ui/card";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Switch } from "@/components/ui/switch";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { useToast } from "@/hooks/use-toast";
import { Plus, MoreHorizontal, Pencil, Trash2, Eye, FileText, Tag } from "lucide-react";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";

const TRIGGER_LABELS: Record<string, string> = {
  task_assigned: "Task Assigned",
  step_completed: "Step Completed",
  task_overdue: "Task Overdue",
  task_rejected: "Task Rejected",
  task_completed: "Task Completed",
};

const VARIABLES = ["{task_title}", "{team_name}", "{current_step}", "{next_team}", "{due_date}", "{user_name}", "{task_id}"];

export default function AdminEmailTemplates() {
  const { emailTemplates, addEmailTemplate, updateEmailTemplate, deleteEmailTemplate } = useData();
  const { toast } = useToast();
  const [showCreate, setShowCreate] = useState(false);
  const [showEdit, setShowEdit] = useState<any>(null);
  const [showPreview, setShowPreview] = useState<any>(null);
  const [deleteConfirm, setDeleteConfirm] = useState<any>(null);
  const [form, setForm] = useState({ name: "", subject: "", body: "", trigger: "task_assigned", isActive: true });

  const openCreate = () => {
    setForm({ name: "", subject: "", body: "", trigger: "task_assigned", isActive: true });
    setShowCreate(true);
  };

  const openEdit = (t: any) => {
    setForm({ name: t.name, subject: t.subject, body: t.body, trigger: t.trigger, isActive: t.isActive });
    setShowEdit(t);
  };

  const handleCreate = () => {
    if (!form.name || !form.subject || !form.body) { toast({ title: "All fields required", variant: "destructive" }); return; }
    addEmailTemplate({ id: `et-${Date.now()}`, name: form.name, subject: form.subject, body: form.body, trigger: form.trigger as any, variables: VARIABLES, isActive: form.isActive, createdAt: new Date().toISOString() });
    toast({ title: "Template created" });
    setShowCreate(false);
  };

  const handleEdit = () => {
    if (!form.name || !form.subject || !form.body) { toast({ title: "All fields required", variant: "destructive" }); return; }
    updateEmailTemplate(showEdit.id, { name: form.name, subject: form.subject, body: form.body, trigger: form.trigger as any, isActive: form.isActive });
    toast({ title: "Template updated" });
    setShowEdit(null);
  };

  const insertVariable = (v: string) => {
    setForm(p => ({ ...p, body: p.body + v }));
  };

  const TemplateForm = () => (
    <div className="space-y-4 max-h-[60vh] overflow-y-auto pr-1">
      <div>
        <Label>Template Name *</Label>
        <Input value={form.name} onChange={e => setForm(p => ({ ...p, name: e.target.value }))} placeholder="e.g. Task Assignment Notice" className="mt-1" />
      </div>
      <div>
        <Label>Trigger Event *</Label>
        <Select value={form.trigger} onValueChange={v => setForm(p => ({ ...p, trigger: v }))}>
          <SelectTrigger className="mt-1"><SelectValue /></SelectTrigger>
          <SelectContent>
            {Object.entries(TRIGGER_LABELS).map(([k, v]) => <SelectItem key={k} value={k}>{v}</SelectItem>)}
          </SelectContent>
        </Select>
      </div>
      <div>
        <Label>Subject *</Label>
        <Input value={form.subject} onChange={e => setForm(p => ({ ...p, subject: e.target.value }))} placeholder="Email subject line..." className="mt-1" />
      </div>
      <div>
        <div className="flex items-center justify-between mb-1">
          <Label>Body *</Label>
        </div>
        <div className="flex flex-wrap gap-1 mb-2">
          {VARIABLES.map(v => (
            <button key={v} onClick={() => insertVariable(v)}
              className="text-xs px-2 py-0.5 rounded bg-primary/10 text-primary hover:bg-primary/20 transition-colors flex items-center gap-1">
              <Tag className="h-2.5 w-2.5" /> {v}
            </button>
          ))}
        </div>
        <Textarea value={form.body} onChange={e => setForm(p => ({ ...p, body: e.target.value }))} placeholder="Email body content..." rows={6} className="font-mono text-sm" />
        <p className="text-xs text-muted-foreground mt-1">Click variables above to insert them</p>
      </div>
      <div className="flex items-center gap-3">
        <Switch checked={form.isActive} onCheckedChange={v => setForm(p => ({ ...p, isActive: v }))} id="active-switch" />
        <Label htmlFor="active-switch">Active (sends automatically)</Label>
      </div>
    </div>
  );

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Email Templates</h1>
          <p className="text-sm text-muted-foreground mt-1">{emailTemplates.length} templates</p>
        </div>
        <Button onClick={openCreate}>
          <Plus className="h-4 w-4 mr-2" /> New Template
        </Button>
      </div>

      {/* Available Variables Reference */}
      <Card className="border-border bg-muted/30">
        <CardContent className="pt-4">
          <p className="text-sm font-medium text-foreground mb-2">Available Template Variables</p>
          <div className="flex flex-wrap gap-2">
            {VARIABLES.map(v => (
              <span key={v} className="text-xs px-2 py-1 rounded bg-primary/10 text-primary font-mono">{v}</span>
            ))}
          </div>
        </CardContent>
      </Card>

      {emailTemplates.length === 0 ? (
        <div className="text-center py-16 text-muted-foreground">
          <FileText className="h-12 w-12 mx-auto mb-3 opacity-40" />
          <p>No email templates yet</p>
          <Button variant="outline" className="mt-3" onClick={openCreate}>Create your first template</Button>
        </div>
      ) : (
        <div className="space-y-3">
          {emailTemplates.map(template => (
            <Card key={template.id} className="border-border hover:shadow-sm transition-shadow group">
              <CardContent className="pt-4">
                <div className="flex items-start justify-between gap-3">
                  <div className="flex-1">
                    <div className="flex items-center gap-2 mb-1">
                      <h3 className="font-semibold text-foreground">{template.name}</h3>
                      <span className="text-xs px-2 py-0.5 rounded-full bg-muted text-muted-foreground">
                        {TRIGGER_LABELS[template.trigger] || template.trigger}
                      </span>
                      <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${template.isActive ? "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" : "bg-gray-100 text-gray-500"}`}>
                        {template.isActive ? "Active" : "Inactive"}
                      </span>
                    </div>
                    <p className="text-sm text-muted-foreground font-medium">Subject: {template.subject}</p>
                    <p className="text-sm text-muted-foreground mt-1 line-clamp-2">{template.body}</p>
                  </div>
                  <div className="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <Button variant="ghost" size="sm" className="h-8 px-2" onClick={() => setShowPreview(template)}>
                      <Eye className="h-4 w-4" />
                    </Button>
                    <DropdownMenu>
                      <DropdownMenuTrigger asChild>
                        <Button variant="ghost" size="sm" className="h-8 px-2">
                          <MoreHorizontal className="h-4 w-4" />
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuItem onClick={() => openEdit(template)}><Pencil className="h-4 w-4 mr-2" /> Edit</DropdownMenuItem>
                        <DropdownMenuItem className="text-red-600" onClick={() => setDeleteConfirm(template)}><Trash2 className="h-4 w-4 mr-2" /> Delete</DropdownMenuItem>
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      )}

      {/* Create/Edit Dialog */}
      {(showCreate || showEdit) && (
        <Dialog open={true} onOpenChange={() => { setShowCreate(false); setShowEdit(null); }}>
          <DialogContent className="max-w-lg">
            <DialogHeader><DialogTitle>{showEdit ? "Edit Template" : "Create Template"}</DialogTitle></DialogHeader>
            <TemplateForm />
            <DialogFooter>
              <Button variant="outline" onClick={() => { setShowCreate(false); setShowEdit(null); }}>Cancel</Button>
              <Button onClick={showEdit ? handleEdit : handleCreate}>{showEdit ? "Save" : "Create"}</Button>
            </DialogFooter>
          </DialogContent>
        </Dialog>
      )}

      {/* Preview Dialog */}
      <Dialog open={!!showPreview} onOpenChange={() => setShowPreview(null)}>
        <DialogContent className="max-w-lg">
          <DialogHeader><DialogTitle>Preview: {showPreview?.name}</DialogTitle></DialogHeader>
          {showPreview && (
            <div className="space-y-3">
              <div className="bg-muted/30 rounded-lg p-4 border border-border">
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-1">Subject</p>
                <p className="font-medium text-foreground">{showPreview.subject}</p>
              </div>
              <div className="bg-muted/30 rounded-lg p-4 border border-border">
                <p className="text-xs text-muted-foreground uppercase tracking-wide mb-2">Body</p>
                <pre className="text-sm text-foreground whitespace-pre-wrap font-sans">{showPreview.body}</pre>
              </div>
            </div>
          )}
          <DialogFooter>
            <Button onClick={() => setShowPreview(null)}>Close</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>

      <Dialog open={!!deleteConfirm} onOpenChange={() => setDeleteConfirm(null)}>
        <DialogContent>
          <DialogHeader><DialogTitle>Delete Template</DialogTitle></DialogHeader>
          <p className="text-muted-foreground text-sm">Delete <strong>{deleteConfirm?.name}</strong>?</p>
          <DialogFooter>
            <Button variant="outline" onClick={() => setDeleteConfirm(null)}>Cancel</Button>
            <Button variant="destructive" onClick={() => { deleteEmailTemplate(deleteConfirm.id); toast({ title: "Template deleted" }); setDeleteConfirm(null); }}>Delete</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
