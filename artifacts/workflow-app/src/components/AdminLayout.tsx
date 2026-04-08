import { Link, useLocation } from "wouter";
import { LayoutDashboard, CheckSquare, Users, Building2, GitMerge, FileText, Settings, Bell, LogOut, Menu, PieChart } from "lucide-react";
import { useAuth } from "../contexts/AuthContext";
import { useData } from "../contexts/DataContext";
import { Button } from "@/components/ui/button";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { useState } from "react";
import { cn } from "@/lib/utils";

export function AdminLayout({ children }: { children: React.ReactNode }) {
  const [location] = useLocation();
  const { user, logout } = useAuth();
  const { notifications } = useData();
  const [collapsed, setCollapsed] = useState(false);

  const unreadCount = notifications.filter(n => !n.isRead).length;

  const navItems = [
    { name: "Dashboard", href: "/admin/dashboard", icon: LayoutDashboard },
    { name: "Tasks", href: "/admin/tasks", icon: CheckSquare },
    { name: "Workflows", href: "/admin/workflows", icon: GitMerge },
    { name: "Teams", href: "/admin/teams", icon: Building2 },
    { name: "Users", href: "/admin/users", icon: Users },
    { name: "Reports", href: "/admin/reports", icon: PieChart },
    { name: "Email Templates", href: "/admin/email-templates", icon: FileText },
    { name: "Settings", href: "/admin/settings", icon: Settings },
  ];

  return (
    <div className="flex h-screen bg-gray-50 dark:bg-gray-900 overflow-hidden">
      {/* Sidebar */}
      <aside 
        className={cn(
          "bg-sidebar flex flex-col transition-all duration-300 border-r border-sidebar-border",
          collapsed ? "w-20" : "w-64"
        )}
      >
        <div className="h-16 flex items-center justify-between px-4 border-b border-sidebar-border">
          {!collapsed && <span className="font-bold text-lg text-sidebar-foreground tracking-tight">FlowDesk</span>}
          <Button variant="ghost" size="icon" onClick={() => setCollapsed(!collapsed)} className="text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground ml-auto">
            <Menu className="h-5 w-5" />
          </Button>
        </div>

        <nav className="flex-1 overflow-y-auto py-4 px-2 space-y-1">
          {navItems.map((item) => {
            const isActive = location === item.href || location.startsWith(item.href + "/");
            return (
              <Link key={item.name} href={item.href}>
                <div
                  className={cn(
                    "flex items-center px-3 py-2 rounded-md transition-colors cursor-pointer group",
                    isActive 
                      ? "bg-primary text-primary-foreground" 
                      : "text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground",
                    collapsed ? "justify-center" : "justify-start"
                  )}
                >
                  <item.icon className={cn("h-5 w-5", !collapsed && "mr-3")} />
                  {!collapsed && <span className="font-medium text-sm">{item.name}</span>}
                </div>
              </Link>
            );
          })}
        </nav>

        <div className="p-4 border-t border-sidebar-border">
          <Link href="/admin/notifications">
            <div className={cn(
              "flex items-center mb-4 cursor-pointer text-sidebar-foreground hover:text-primary transition-colors",
              collapsed ? "justify-center" : "justify-between"
            )}>
              <div className="flex items-center relative">
                <Bell className="h-5 w-5" />
                {unreadCount > 0 && (
                  <span className="absolute -top-1 -right-1 flex h-3 w-3">
                    <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-destructive opacity-75"></span>
                    <span className="relative inline-flex rounded-full h-3 w-3 bg-destructive"></span>
                  </span>
                )}
                {!collapsed && <span className="ml-3 font-medium text-sm">Notifications</span>}
              </div>
              {!collapsed && unreadCount > 0 && (
                <span className="bg-destructive text-destructive-foreground text-xs px-2 py-0.5 rounded-full font-medium">
                  {unreadCount}
                </span>
              )}
            </div>
          </Link>

          <div className={cn("flex items-center", collapsed ? "justify-center" : "justify-between")}>
            <div className="flex items-center">
              <Avatar className="h-8 w-8 border border-sidebar-border">
                <AvatarImage src={user?.avatar} />
                <AvatarFallback>{user?.name.charAt(0)}</AvatarFallback>
              </Avatar>
              {!collapsed && (
                <div className="ml-3 overflow-hidden">
                  <p className="text-sm font-medium text-sidebar-foreground truncate">{user?.name}</p>
                  <p className="text-xs text-sidebar-foreground/70 capitalize truncate">{user?.role}</p>
                </div>
              )}
            </div>
            {!collapsed && (
              <Button variant="ghost" size="icon" onClick={logout} className="text-sidebar-foreground hover:text-destructive hover:bg-destructive/10">
                <LogOut className="h-4 w-4" />
              </Button>
            )}
          </div>
        </div>
      </aside>

      {/* Main Content */}
      <main className="flex-1 overflow-auto bg-gray-50 dark:bg-gray-900">
        <div className="p-8 max-w-7xl mx-auto">
          {children}
        </div>
      </main>
    </div>
  );
}
