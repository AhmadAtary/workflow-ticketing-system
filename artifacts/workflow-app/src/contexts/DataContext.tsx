import React, { createContext, useContext, useState, ReactNode } from "react";
import {
  mockTasks, mockUsers, mockTeams, mockWorkflows,
  mockNotifications, mockEmailTemplates, mockSettings
} from "../services/mockData";
import type { TaskDetail, User, Team, Workflow, Notification, EmailTemplate, SystemSettings, ActivityItem } from "@workspace/api-client-react";
import { ActivityItemType } from "@workspace/api-client-react";

interface DataContextType {
  tasks: TaskDetail[];
  users: User[];
  teams: Team[];
  workflows: Workflow[];
  notifications: Notification[];
  emailTemplates: EmailTemplate[];
  settings: SystemSettings | null;
  activities: ActivityItem[];

  addTask: (task: TaskDetail) => void;
  updateTask: (id: string, updates: Partial<TaskDetail>) => void;
  deleteTask: (id: string) => void;

  addComment: (taskId: string, comment: any) => void;

  addUser: (user: User) => void;
  updateUser: (id: string, updates: Partial<User>) => void;
  deleteUser: (id: string) => void;

  addTeam: (team: Team) => void;
  updateTeam: (id: string, updates: Partial<Team>) => void;
  deleteTeam: (id: string) => void;

  addWorkflow: (workflow: Workflow) => void;
  updateWorkflow: (id: string, updates: Partial<Workflow>) => void;
  deleteWorkflow: (id: string) => void;

  markNotificationRead: (id: string) => void;
  markAllRead: () => void;
  addNotification: (notif: Notification) => void;

  addEmailTemplate: (template: EmailTemplate) => void;
  updateEmailTemplate: (id: string, updates: Partial<EmailTemplate>) => void;
  deleteEmailTemplate: (id: string) => void;

  updateSettings: (updates: Partial<SystemSettings>) => void;
}

const mockActivities: ActivityItem[] = [
  {
    id: "act-1",
    type: ActivityItemType.task_created,
    userId: "user-3",
    userName: "Jane Smith",
    taskId: "task-1",
    taskTitle: "Deploy Auth Service v2",
    description: "created the task",
    createdAt: new Date(Date.now() - 86400000).toISOString(),
  },
  {
    id: "act-2",
    type: ActivityItemType.step_completed,
    userId: "user-3",
    userName: "Jane Smith",
    taskId: "task-1",
    taskTitle: "Deploy Auth Service v2",
    description: "completed step: Code Review",
    createdAt: new Date(Date.now() - 40000000).toISOString(),
  },
  {
    id: "act-3",
    type: ActivityItemType.task_created,
    userId: "user-4",
    userName: "Bob Jones",
    taskId: "task-2",
    taskTitle: "Design Dashboard UI",
    description: "created the task",
    createdAt: new Date(Date.now() - 100000).toISOString(),
  },
  {
    id: "act-4",
    type: ActivityItemType.task_created,
    userId: "user-1",
    userName: "Admin User",
    taskId: "task-3",
    taskTitle: "Fix Payment Gateway Bug",
    description: "created the task",
    createdAt: new Date(Date.now() - 172800000).toISOString(),
  },
  {
    id: "act-5",
    type: ActivityItemType.step_completed,
    userId: "user-1",
    userName: "Admin User",
    taskId: "task-4",
    taskTitle: "Update User Settings Page",
    description: "completed all steps",
    createdAt: new Date(Date.now() - 200000000).toISOString(),
  },
];

const DataContext = createContext<DataContextType | undefined>(undefined);

export function DataProvider({ children }: { children: ReactNode }) {
  const [tasks, setTasks] = useState<TaskDetail[]>(mockTasks);
  const [users, setUsers] = useState<User[]>(mockUsers);
  const [teams, setTeams] = useState<Team[]>(mockTeams);
  const [workflows, setWorkflows] = useState<Workflow[]>(mockWorkflows);
  const [notifications, setNotifications] = useState<Notification[]>(mockNotifications);
  const [emailTemplates, setEmailTemplates] = useState<EmailTemplate[]>(mockEmailTemplates);
  const [settings, setSettings] = useState<SystemSettings | null>(mockSettings);
  const [activities, setActivities] = useState<ActivityItem[]>(mockActivities);

  const addTask = (task: TaskDetail) => setTasks(prev => [task, ...prev]);
  const updateTask = (id: string, updates: Partial<TaskDetail>) =>
    setTasks(prev => prev.map(t => t.id === id ? { ...t, ...updates } : t));
  const deleteTask = (id: string) => setTasks(prev => prev.filter(t => t.id !== id));

  const addComment = (taskId: string, comment: any) =>
    setTasks(prev => prev.map(t => {
      if (t.id !== taskId) return t;
      if (comment.isInternal) {
        return { ...t, internalNotes: [...(t.internalNotes || []), comment] };
      }
      return { ...t, comments: [...(t.comments || []), comment], commentCount: (t.commentCount || 0) + 1 };
    }));

  const addUser = (user: User) => setUsers(prev => [...prev, user]);
  const updateUser = (id: string, updates: Partial<User>) =>
    setUsers(prev => prev.map(u => u.id === id ? { ...u, ...updates } : u));
  const deleteUser = (id: string) => setUsers(prev => prev.filter(u => u.id !== id));

  const addTeam = (team: Team) => setTeams(prev => [...prev, team]);
  const updateTeam = (id: string, updates: Partial<Team>) =>
    setTeams(prev => prev.map(t => t.id === id ? { ...t, ...updates } : t));
  const deleteTeam = (id: string) => setTeams(prev => prev.filter(t => t.id !== id));

  const addWorkflow = (workflow: Workflow) => setWorkflows(prev => [...prev, workflow]);
  const updateWorkflow = (id: string, updates: Partial<Workflow>) =>
    setWorkflows(prev => prev.map(w => w.id === id ? { ...w, ...updates } : w));
  const deleteWorkflow = (id: string) => setWorkflows(prev => prev.filter(w => w.id !== id));

  const markNotificationRead = (id: string) =>
    setNotifications(prev => prev.map(n => n.id === id ? { ...n, isRead: true } : n));
  const markAllRead = () => setNotifications(prev => prev.map(n => ({ ...n, isRead: true })));
  const addNotification = (notif: Notification) => setNotifications(prev => [notif, ...prev]);

  const addEmailTemplate = (template: EmailTemplate) => setEmailTemplates(prev => [...prev, template]);
  const updateEmailTemplate = (id: string, updates: Partial<EmailTemplate>) =>
    setEmailTemplates(prev => prev.map(t => t.id === id ? { ...t, ...updates } : t));
  const deleteEmailTemplate = (id: string) => setEmailTemplates(prev => prev.filter(t => t.id !== id));

  const updateSettings = (updates: Partial<SystemSettings>) =>
    setSettings(prev => prev ? { ...prev, ...updates } : null);

  return (
    <DataContext.Provider value={{
      tasks, users, teams, workflows, notifications,
      emailTemplates, settings, activities,
      addTask, updateTask, deleteTask,
      addComment,
      addUser, updateUser, deleteUser,
      addTeam, updateTeam, deleteTeam,
      addWorkflow, updateWorkflow, deleteWorkflow,
      markNotificationRead, markAllRead, addNotification,
      addEmailTemplate, updateEmailTemplate, deleteEmailTemplate,
      updateSettings,
    }}>
      {children}
    </DataContext.Provider>
  );
}

export function useData() {
  const context = useContext(DataContext);
  if (context === undefined) {
    throw new Error("useData must be used within a DataProvider");
  }
  return context;
}
