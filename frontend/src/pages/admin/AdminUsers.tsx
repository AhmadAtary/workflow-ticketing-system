import { useState } from "react";
import { Link } from "wouter";
import { format } from "date-fns";
import { Search, Plus, Users, MoreHorizontal, Pencil, Trash2, ChevronRight } from "lucide-react";
import { useData } from "../../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Label } from "@/components/ui/label";
import { useToast } from "@/hooks/use-toast";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "@/components/ui/dropdown-menu";
import { ApiHttpError } from "@/shared/api/http";

const NO_TEAM_VALUE = "__no_team__";

function getErrorMessage(error: unknown, fallback: string): string {
  if (error instanceof ApiHttpError) {
    const payload = error.payload;
    const problem = payload && typeof payload === "object" ? payload : null;
    const firstValidationError = problem?.errors
      ? Object.values(problem.errors)[0]?.[0]
      : null;

    return firstValidationError ?? problem?.detail ?? fallback;
  }

  if (error instanceof Error && error.message) {
    return error.message;
  }

  return fallback;
}

export default function AdminUsers() {
  const { users, teams, addUser, updateUser, deleteUser } = useData();
  const { toast } = useToast();
  const [search, setSearch] = useState("");
  const [filterRole, setFilterRole] = useState("all");
  const [filterTeam, setFilterTeam] = useState("all");
  const [showCreate, setShowCreate] = useState(false);
  const [showEdit, setShowEdit] = useState<any>(null);
  const [deleteConfirm, setDeleteConfirm] = useState<any>(null);
  const [form, setForm] = useState({ name: "", email: "", role: "user", teamId: "", password: "" });

  const filtered = users.filter((user) => {
    if (search && !user.name.toLowerCase().includes(search.toLowerCase()) && !user.email.toLowerCase().includes(search.toLowerCase())) {
      return false;
    }

    if (filterRole !== "all" && user.role !== filterRole) {
      return false;
    }

    if (filterTeam !== "all" && user.teamId !== filterTeam) {
      return false;
    }

    return true;
  });

  const handleCreate = async () => {
    if (!form.name || !form.email || !form.password) {
      toast({ title: "Name, email, and password are required", variant: "destructive" });
      return;
    }

    try {
      await addUser({
        id: `user-${Date.now()}`,
        name: form.name,
        email: form.email,
        role: form.role as any,
        teamId: form.teamId || undefined,
        password: form.password,
        teamName: teams.find((team) => team.id === form.teamId)?.name,
        status: "active",
        avatar: `https://i.pravatar.cc/150?u=${form.email}`,
        createdAt: new Date().toISOString(),
      });

      toast({ title: "User created" });
      setShowCreate(false);
      setForm({ name: "", email: "", role: "user", teamId: "", password: "" });
    } catch (error) {
      toast({
        title: "Failed to create user",
        description: getErrorMessage(error, "Unable to create user."),
        variant: "destructive",
      });
    }
  };

  const handleEdit = async () => {
    if (!form.name || !form.email) {
      toast({ title: "Name and email are required", variant: "destructive" });
      return;
    }

    try {
      await updateUser(showEdit.id, {
        name: form.name,
        email: form.email,
        role: form.role as any,
        teamId: form.teamId || undefined,
        teamName: teams.find((team) => team.id === form.teamId)?.name,
        password: form.password || undefined,
      });

      toast({ title: "User updated" });
      setShowEdit(null);
    } catch (error) {
      toast({
        title: "Failed to update user",
        description: getErrorMessage(error, "Unable to update user."),
        variant: "destructive",
      });
    }
  };

  const openEdit = (user: any) => {
    setForm({ name: user.name, email: user.email, role: user.role, teamId: user.teamId || "", password: "" });
    setShowEdit(user);
  };

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Users</h1>
          <p className="text-sm text-muted-foreground mt-1">{users.length} users</p>
        </div>
        <Button
          onClick={() => {
            setForm({ name: "", email: "", role: "user", teamId: "", password: "" });
            setShowCreate(true);
          }}
        >
          <Plus className="h-4 w-4 mr-2" /> New User
        </Button>
      </div>

      <div className="flex flex-wrap gap-3">
        <div className="relative flex-1 min-w-[200px]">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
          <Input placeholder="Search users..." value={search} onChange={(event) => setSearch(event.target.value)} className="pl-9" />
        </div>
        <Select value={filterRole} onValueChange={setFilterRole}>
          <SelectTrigger className="w-32"><SelectValue placeholder="Role" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Roles</SelectItem>
            <SelectItem value="admin">Admin</SelectItem>
            <SelectItem value="user">User</SelectItem>
          </SelectContent>
        </Select>
        <Select value={filterTeam} onValueChange={setFilterTeam}>
          <SelectTrigger className="w-36"><SelectValue placeholder="Team" /></SelectTrigger>
          <SelectContent>
            <SelectItem value="all">All Teams</SelectItem>
            {teams.map((team) => <SelectItem key={team.id} value={team.id}>{team.name}</SelectItem>)}
          </SelectContent>
        </Select>
      </div>

      <Card className="border-border">
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="border-b border-border bg-muted/40">
                <th className="text-left px-4 py-3 font-medium text-muted-foreground">User</th>
                <th className="text-left px-4 py-3 font-medium text-muted-foreground">Role</th>
                <th className="text-left px-4 py-3 font-medium text-muted-foreground">Team</th>
                <th className="text-left px-4 py-3 font-medium text-muted-foreground">Status</th>
                <th className="text-left px-4 py-3 font-medium text-muted-foreground">Joined</th>
                <th className="px-4 py-3"></th>
              </tr>
            </thead>
            <tbody>
              {filtered.length === 0 ? (
                <tr>
                  <td colSpan={6} className="text-center text-muted-foreground py-12">
                    <Users className="h-10 w-10 mx-auto mb-3 opacity-40" />
                    No users found
                  </td>
                </tr>
              ) : filtered.map((user) => (
                <tr key={user.id} className="border-b border-border last:border-0 hover:bg-muted/30 transition-colors">
                  <td className="px-4 py-3">
                    <div className="flex items-center gap-3">
                      <Avatar className="h-8 w-8">
                        <AvatarImage src={user.avatar} />
                        <AvatarFallback>{user.name.charAt(0)}</AvatarFallback>
                      </Avatar>
                      <div>
                        <p className="font-medium text-foreground">{user.name}</p>
                        <p className="text-xs text-muted-foreground">{user.email}</p>
                      </div>
                    </div>
                  </td>
                  <td className="px-4 py-3">
                    <span className={`text-xs px-2 py-0.5 rounded-full font-medium capitalize ${user.role === "admin" ? "bg-primary/10 text-primary" : "bg-muted text-muted-foreground"}`}>
                      {user.role}
                    </span>
                  </td>
                  <td className="px-4 py-3 text-muted-foreground">{user.teamName || "-"}</td>
                  <td className="px-4 py-3">
                    <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${user.status === "active" ? "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400" : "bg-gray-100 text-gray-500"}`}>
                      {user.status}
                    </span>
                  </td>
                  <td className="px-4 py-3 text-muted-foreground">{format(new Date(user.createdAt), "MMM d, yyyy")}</td>
                  <td className="px-4 py-3">
                    <div className="flex items-center gap-1">
                      <Link href={`/admin/users/${user.id}`}>
                        <Button variant="ghost" size="sm" className="h-7 px-2">
                          <ChevronRight className="h-4 w-4" />
                        </Button>
                      </Link>
                      <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                          <Button variant="ghost" size="sm" className="h-7 px-2">
                            <MoreHorizontal className="h-4 w-4" />
                          </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                          <DropdownMenuItem onClick={() => openEdit(user)}>
                            <Pencil className="h-4 w-4 mr-2" /> Edit
                          </DropdownMenuItem>
                          <DropdownMenuItem className="text-red-600" onClick={() => setDeleteConfirm(user)}>
                            <Trash2 className="h-4 w-4 mr-2" /> Delete
                          </DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </Card>

      {(showCreate || showEdit) && (
        <Dialog open={true} onOpenChange={() => { setShowCreate(false); setShowEdit(null); }}>
          <DialogContent>
            <DialogHeader><DialogTitle>{showEdit ? "Edit User" : "Create User"}</DialogTitle></DialogHeader>
            <div className="space-y-4">
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <Label>Full Name *</Label>
                  <Input value={form.name} onChange={(event) => setForm((current) => ({ ...current, name: event.target.value }))} placeholder="John Smith" className="mt-1" />
                </div>
                <div>
                  <Label>Email *</Label>
                  <Input type="email" value={form.email} onChange={(event) => setForm((current) => ({ ...current, email: event.target.value }))} placeholder="john@company.com" className="mt-1" />
                </div>
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <Label>Role</Label>
                  <Select value={form.role} onValueChange={(value) => setForm((current) => ({ ...current, role: value }))}>
                    <SelectTrigger className="mt-1"><SelectValue /></SelectTrigger>
                    <SelectContent>
                      <SelectItem value="user">User</SelectItem>
                      <SelectItem value="admin">Admin</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Team</Label>
                  <Select
                    value={form.teamId || NO_TEAM_VALUE}
                    onValueChange={(value) =>
                      setForm((current) => ({ ...current, teamId: value === NO_TEAM_VALUE ? "" : value }))
                    }
                  >
                    <SelectTrigger className="mt-1"><SelectValue placeholder="Select team" /></SelectTrigger>
                    <SelectContent>
                      <SelectItem value={NO_TEAM_VALUE}>No Team</SelectItem>
                      {teams.map((team) => <SelectItem key={team.id} value={team.id}>{team.name}</SelectItem>)}
                    </SelectContent>
                  </Select>
                </div>
              </div>
              <div>
                <Label>{showEdit ? "New Password (optional)" : "Password *"}</Label>
                <Input
                  type="password"
                  value={form.password}
                  onChange={(event) => setForm((current) => ({ ...current, password: event.target.value }))}
                  placeholder={showEdit ? "Leave blank to keep the current password" : "Temporary password"}
                  className="mt-1"
                />
              </div>
            </div>
            <DialogFooter>
              <Button variant="outline" onClick={() => { setShowCreate(false); setShowEdit(null); }}>Cancel</Button>
              <Button onClick={showEdit ? handleEdit : handleCreate}>{showEdit ? "Save" : "Create"}</Button>
            </DialogFooter>
          </DialogContent>
        </Dialog>
      )}

      <Dialog open={!!deleteConfirm} onOpenChange={() => setDeleteConfirm(null)}>
        <DialogContent>
          <DialogHeader><DialogTitle>Delete User</DialogTitle></DialogHeader>
          <p className="text-muted-foreground text-sm">Are you sure you want to delete <strong>{deleteConfirm?.name}</strong>?</p>
          <DialogFooter>
            <Button variant="outline" onClick={() => setDeleteConfirm(null)}>Cancel</Button>
            <Button
              variant="destructive"
              onClick={async () => {
                try {
                  await deleteUser(deleteConfirm.id);
                  toast({ title: "User deleted" });
                  setDeleteConfirm(null);
                } catch (error) {
                  toast({
                    title: "Failed to delete user",
                    description: getErrorMessage(error, "Unable to delete user."),
                    variant: "destructive",
                  });
                }
              }}
            >
              Delete
            </Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
