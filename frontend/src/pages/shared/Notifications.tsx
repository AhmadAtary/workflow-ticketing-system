import React from "react";
import { useData } from "../../contexts/DataContext";
import { useAuth } from "../../contexts/AuthContext";
import { Link } from "wouter";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Bell, CheckCheck, CheckCircle2, XCircle, MessageSquare, AlertTriangle, MoveRight } from "lucide-react";
import { formatDistanceToNow } from "date-fns";
import { useToast } from "@/hooks/use-toast";

function NotificationIcon({ type }: { type: string }) {
  const icons: Record<string, React.ReactElement> = {
    assigned: <div className="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center"><Bell className="h-4 w-4 text-blue-600 dark:text-blue-400" /></div>,
    moved: <div className="h-8 w-8 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center"><MoveRight className="h-4 w-4 text-purple-600 dark:text-purple-400" /></div>,
    completed: <div className="h-8 w-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center"><CheckCircle2 className="h-4 w-4 text-green-600 dark:text-green-400" /></div>,
    rejected: <div className="h-8 w-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center"><XCircle className="h-4 w-4 text-red-600 dark:text-red-400" /></div>,
    comment: <div className="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center"><MessageSquare className="h-4 w-4 text-gray-600 dark:text-gray-400" /></div>,
    overdue: <div className="h-8 w-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center"><AlertTriangle className="h-4 w-4 text-amber-600 dark:text-amber-400" /></div>,
  };
  return icons[type] || icons.assigned;
}

export default function Notifications() {
  const { notifications, markNotificationRead, markAllRead } = useData();
  const { user } = useAuth();
  const { toast } = useToast();

  const userNotifications = notifications.filter(n => n.userId === user?.id || !n.userId);
  const unreadCount = userNotifications.filter(n => !n.isRead).length;
  const isAdmin = user?.role === "admin";

  const handleMarkRead = (id: string) => {
    markNotificationRead(id);
  };

  const handleMarkAllRead = () => {
    markAllRead();
    toast({ title: "All notifications marked as read" });
  };

  return (
    <div className="space-y-5">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Notifications</h1>
          <p className="text-sm text-muted-foreground mt-1">{unreadCount} unread</p>
        </div>
        {unreadCount > 0 && (
          <Button variant="outline" size="sm" onClick={handleMarkAllRead}>
            <CheckCheck className="h-4 w-4 mr-2" /> Mark all as read
          </Button>
        )}
      </div>

      {userNotifications.length === 0 ? (
        <div className="text-center py-16">
          <Bell className="h-12 w-12 mx-auto mb-3 text-muted-foreground opacity-40" />
          <p className="text-muted-foreground">No notifications yet</p>
        </div>
      ) : (
        <div className="space-y-2">
          {userNotifications.map(notif => (
            <Card key={notif.id}
              className={`border-border cursor-pointer transition-all hover:shadow-sm ${!notif.isRead ? "border-l-2 border-l-primary" : ""}`}
              onClick={() => !notif.isRead && handleMarkRead(notif.id)}>
              <CardContent className="pt-4 pb-4">
                <div className="flex items-start gap-3">
                  <NotificationIcon type={notif.type} />
                  <div className="flex-1 min-w-0">
                    <div className="flex items-start justify-between gap-2">
                      <p className={`text-sm ${!notif.isRead ? "font-semibold text-foreground" : "font-medium text-foreground"}`}>
                        {notif.title}
                      </p>
                      <div className="flex items-center gap-2 shrink-0">
                        {!notif.isRead && <div className="h-2 w-2 rounded-full bg-primary" />}
                        <span className="text-xs text-muted-foreground">
                          {formatDistanceToNow(new Date(notif.createdAt), { addSuffix: true })}
                        </span>
                      </div>
                    </div>
                    <p className="text-sm text-muted-foreground mt-0.5">{notif.message}</p>
                    {notif.taskId && (
                      <Link href={isAdmin ? `/admin/tasks/${notif.taskId}` : `/my-tasks/${notif.taskId}`}>
                        <span className="text-xs text-primary hover:underline mt-1 inline-block" onClick={e => e.stopPropagation()}>
                          View task: {notif.taskTitle}
                        </span>
                      </Link>
                    )}
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
      )}
    </div>
  );
}
