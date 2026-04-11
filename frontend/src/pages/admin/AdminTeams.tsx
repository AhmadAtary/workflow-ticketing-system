import { useState } from "react";
import { useData } from "../../contexts/DataContext";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { useToast } from "@/hooks/use-toast";
import { Search, Plus, Users, CheckSquare, ChevronRight, MoreHorizontal, Pencil, Trash2 } from "lucide-react";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";

const TEAM_COLORS = ["#3b82f6", "#10b981", "#8b5cf6", "#f59e0b", "#ef4444", "#ec4899", "#06b6d4", "#84cc16"];

export default function AdminTeams() {
  const { teams, users, addTeam, updateTeam, deleteTeam } = useData();
  const { toast } = useToast();
  const [search, setSearch] = useState("");
  const [showCreate, setShowCreate] = useState(false);
  const [showEdit, setShowEdit] = useState<any>(null);
  const [formData, setFormData] = useState({ name: "", description: "", color: "#3b82f6" });
  const [deleteConfirm, setDeleteConfirm] = useState<any>(null);

  const filtered = teams.filter(t =>
    !search || t.name.toLowerCase().includes(search.toLowerCase())
  );

  const handleCreate = () => {
    if (!formData.name.trim()) { toast({ title: "Team name is required", variant: "destructive" }); return; }
    addTeam({ id: `team-${Date.now()}`, name: formData.name, description: formData.description, color: formData.color, memberCount: 0, taskCount: 0, createdAt: new Date().toISOString() });
    toast({ title: "Team created" });
    setShowCreate(false);
    setFormData({ name: "", description: "", color: "#3b82f6" });
  };

  const handleEdit = () => {
    if (!formData.name.trim()) { toast({ title: "Team name is required", variant: "destructive" }); return; }
    updateTeam(showEdit.id, { name: formData.name, description: formData.description, color: formData.color });
    toast({ title: "Team updated" });
    setShowEdit(null);
  };

  const openEdit = (team: any) => {
    setFormData({ name: team.name, description: team.description || "", color: team.color || "#3b82f6" });
    setShowEdit(team);
  };

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Teams</h1>
          <p className="text-sm text-muted-foreground mt-1">{teams.length} teams</p>
        </div>
        <Button onClick={() => { setFormData({ name: "", description: "", color: "#3b82f6" }); setShowCreate(true); }}>
          <Plus className="h-4 w-4 mr-2" /> New Team
        </Button>
      </div>

      <div className="relative max-w-sm">
        <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
        <Input placeholder="Search teams..." value={search} onChange={e => setSearch(e.target.value)} className="pl-9" />
      </div>

      {filtered.length === 0 ? (
        <div className="text-center py-16 text-muted-foreground">
          <Users className="h-12 w-12 mx-auto mb-3 opacity-40" />
          <p>No teams found</p>
          <Button variant="outline" className="mt-3" onClick={() => setShowCreate(true)}>Create your first team</Button>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {filtered.map(team => {
            const memberList = users.filter(u => u.teamId === team.id);
            return (
              <Card key={team.id} className="border-border hover:shadow-sm transition-shadow group">
                <CardContent className="pt-5">
                  <div className="flex items-start justify-between mb-3">
                    <div className="flex items-center gap-3">
                      <div className="h-10 w-10 rounded-lg flex items-center justify-center text-white font-bold text-sm"
                        style={{ backgroundColor: team.color || "#3b82f6" }}>
                        {team.name.charAt(0).toUpperCase()}
                      </div>
                      <div>
                        <h3 className="font-semibold text-foreground">{team.name}</h3>
                        {team.description && <p className="text-xs text-muted-foreground line-clamp-1">{team.description}</p>}
                      </div>
                    </div>
                    <DropdownMenu>
                      <DropdownMenuTrigger asChild>
                        <Button variant="ghost" size="icon" className="h-7 w-7 opacity-0 group-hover:opacity-100 transition-opacity">
                          <MoreHorizontal className="h-4 w-4" />
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuItem onClick={() => openEdit(team)}>
                          <Pencil className="h-4 w-4 mr-2" /> Edit
                        </DropdownMenuItem>
                        <DropdownMenuItem className="text-red-600" onClick={() => setDeleteConfirm(team)}>
                          <Trash2 className="h-4 w-4 mr-2" /> Delete
                        </DropdownMenuItem>
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </div>

                  <div className="flex items-center gap-4 text-sm text-muted-foreground mb-4">
                    <div className="flex items-center gap-1">
                      <Users className="h-3.5 w-3.5" />
                      <span>{memberList.length} members</span>
                    </div>
                    <div className="flex items-center gap-1">
                      <CheckSquare className="h-3.5 w-3.5" />
                      <span>{team.taskCount} tasks</span>
                    </div>
                  </div>

                  {memberList.length > 0 && (
                    <div className="flex -space-x-1.5 mb-4">
                      {memberList.slice(0, 5).map(m => (
                        <div key={m.id} className="h-7 w-7 rounded-full border-2 border-background flex items-center justify-center text-white text-xs font-medium"
                          style={{ backgroundColor: team.color || "#3b82f6" }}>
                          {m.name.charAt(0)}
                        </div>
                      ))}
                      {memberList.length > 5 && (
                        <div className="h-7 w-7 rounded-full border-2 border-background bg-muted flex items-center justify-center text-xs text-muted-foreground font-medium">
                          +{memberList.length - 5}
                        </div>
                      )}
                    </div>
                  )}

                  <Link href={`/admin/teams/${team.id}`}>
                    <Button variant="outline" size="sm" className="w-full">
                      View Team <ChevronRight className="h-3.5 w-3.5 ml-1" />
                    </Button>
                  </Link>
                </CardContent>
              </Card>
            );
          })}
        </div>
      )}

      {/* Create/Edit Dialog */}
      {(showCreate || showEdit) && (
        <Dialog open={true} onOpenChange={() => { setShowCreate(false); setShowEdit(null); }}>
          <DialogContent>
            <DialogHeader><DialogTitle>{showEdit ? "Edit Team" : "Create New Team"}</DialogTitle></DialogHeader>
            <div className="space-y-4">
              <div>
                <Label>Team Name *</Label>
                <Input value={formData.name} onChange={e => setFormData(p => ({ ...p, name: e.target.value }))} placeholder="e.g. Engineering" className="mt-1" />
              </div>
              <div>
                <Label>Description</Label>
                <Textarea value={formData.description} onChange={e => setFormData(p => ({ ...p, description: e.target.value }))} placeholder="Brief description..." className="mt-1" rows={2} />
              </div>
              <div>
                <Label>Team Color</Label>
                <div className="flex flex-wrap gap-2 mt-2">
                  {TEAM_COLORS.map(c => (
                    <button key={c} onClick={() => setFormData(p => ({ ...p, color: c }))}
                      className={`h-8 w-8 rounded-full border-2 transition-all ${formData.color === c ? "border-foreground scale-110" : "border-transparent"}`}
                      style={{ backgroundColor: c }} />
                  ))}
                </div>
              </div>
            </div>
            <DialogFooter>
              <Button variant="outline" onClick={() => { setShowCreate(false); setShowEdit(null); }}>Cancel</Button>
              <Button onClick={showEdit ? handleEdit : handleCreate}>{showEdit ? "Save Changes" : "Create Team"}</Button>
            </DialogFooter>
          </DialogContent>
        </Dialog>
      )}

      {/* Delete Confirm */}
      <Dialog open={!!deleteConfirm} onOpenChange={() => setDeleteConfirm(null)}>
        <DialogContent>
          <DialogHeader><DialogTitle>Delete Team</DialogTitle></DialogHeader>
          <p className="text-muted-foreground text-sm">Are you sure you want to delete <strong>{deleteConfirm?.name}</strong>? This cannot be undone.</p>
          <DialogFooter>
            <Button variant="outline" onClick={() => setDeleteConfirm(null)}>Cancel</Button>
            <Button variant="destructive" onClick={() => { deleteTeam(deleteConfirm.id); toast({ title: "Team deleted" }); setDeleteConfirm(null); }}>Delete</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
