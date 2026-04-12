import { Link, useLocation } from "wouter";
import { LayoutDashboard, CheckSquare, Bell, LogOut } from "lucide-react";
import { useAuth } from "../contexts/AuthContext";
import { useData } from "../contexts/DataContext";
import { useBranding } from "@/app/branding";
import { Button } from "@/components/ui/button";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { cn } from "@/lib/utils";

export function UserLayout({ children }: { children: React.ReactNode }) {
  const [location] = useLocation();
  const { user, logout } = useAuth();
  const { notifications } = useData();
  const { companyName, logoUrl } = useBranding();

  const unreadCount = notifications.filter(n => !n.isRead).length;

  const navItems = [
    { name: "Dashboard", href: "/dashboard", icon: LayoutDashboard },
    { name: "My Tasks", href: "/my-tasks", icon: CheckSquare },
  ];

  return (
    <div className="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col">
      {/* Top Navigation */}
      <header className="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-30">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-16">
            <div className="flex">
              <div className="flex-shrink-0 flex items-center">
                <div className="flex items-center gap-2 min-w-0">
                  {logoUrl ? (
                    <img
                      src={logoUrl}
                      alt={`${companyName} logo`}
                      className="h-8 w-8 rounded object-contain bg-white p-0.5"
                      onError={(event) => {
                        event.currentTarget.style.display = "none";
                      }}
                    />
                  ) : null}
                  <span className="font-bold text-xl text-primary tracking-tight truncate">{companyName}</span>
                </div>
              </div>
              <nav className="hidden sm:ml-8 sm:flex sm:space-x-4">
                {navItems.map((item) => {
                  const isActive = location === item.href || location.startsWith(item.href + "/");
                  return (
                    <Link key={item.name} href={item.href}>
                      <div
                        className={cn(
                          "inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors cursor-pointer h-full",
                          isActive
                            ? "border-primary text-gray-900 dark:text-white"
                            : "border-transparent text-gray-500 dark:text-gray-400 hover:border-gray-300 dark:hover:border-gray-700 hover:text-gray-700 dark:hover:text-gray-300"
                        )}
                      >
                        <item.icon className="h-4 w-4 mr-2" />
                        {item.name}
                      </div>
                    </Link>
                  );
                })}
              </nav>
            </div>
            
            <div className="flex items-center space-x-4">
              <Link href="/notifications">
                <Button variant="ghost" size="icon" className="relative text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                  <Bell className="h-5 w-5" />
                  {unreadCount > 0 && (
                    <span className="absolute top-1 right-1 flex h-2 w-2">
                      <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-destructive opacity-75"></span>
                      <span className="relative inline-flex rounded-full h-2 w-2 bg-destructive"></span>
                    </span>
                  )}
                </Button>
              </Link>
              
              <div className="flex items-center border-l border-gray-200 dark:border-gray-800 pl-4 space-x-3">
                <div className="hidden md:flex flex-col items-end">
                  <span className="text-sm font-medium text-gray-900 dark:text-white">{user?.name}</span>
                  <span className="text-xs text-gray-500 dark:text-gray-400 capitalize">{user?.teamName || user?.role}</span>
                </div>
                <Avatar className="h-8 w-8 border border-gray-200 dark:border-gray-700">
                  <AvatarImage src={user?.avatar} />
                  <AvatarFallback>{user?.name.charAt(0)}</AvatarFallback>
                </Avatar>
                <Button variant="ghost" size="icon" onClick={logout} className="text-gray-500 hover:text-destructive">
                  <LogOut className="h-4 w-4" />
                </Button>
              </div>
            </div>
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">
        {children}
      </main>
    </div>
  );
}
