import { createContext, useContext, useEffect, type ReactNode } from "react";
import { useQuery, useQueryClient } from "@tanstack/react-query";
import type {
  ActivityItem,
  EmailTemplate,
  Notification,
  SystemSettings,
  UpdateSettingsBody,
  TaskDetail,
  Team,
  User,
  Workflow,
} from "@flowdesk/api-client";
import { useAuth } from "@/app/providers/AuthProvider";
import { applyBrandingFromSettings } from "@/app/branding";
import type { ApiEnvelope, ApiPaginatedEnvelope } from "@/shared/api/http";

type TaskLike = Partial<TaskDetail> & Pick<TaskDetail, "title" | "priority" | "workflowId">;
type UserLike = Partial<User> & Pick<User, "name" | "email" | "role"> & { password?: string };
type TeamLike = Partial<Team> & Pick<Team, "name">;
type WorkflowLike = Partial<Workflow> & Pick<Workflow, "name" | "steps">;
type EmailTemplateLike = Partial<EmailTemplate> & Pick<EmailTemplate, "name" | "subject" | "body" | "trigger">;

interface DataContextType {
  tasks: TaskDetail[];
  users: User[];
  teams: Team[];
  workflows: Workflow[];
  notifications: Notification[];
  emailTemplates: EmailTemplate[];
  settings: SystemSettings | null;
  activities: ActivityItem[];
  getTaskById: (id: string) => Promise<TaskDetail | null>;
  addTask: (task: TaskLike) => Promise<void>;
  updateTask: (id: string, updates: Partial<TaskDetail>) => Promise<void>;
  deleteTask: (id: string) => Promise<void>;
  addComment: (
    taskId: string,
    comment: Pick<NonNullable<TaskDetail["comments"]>[number], "content" | "isInternal">,
  ) => Promise<void>;
  addUser: (user: UserLike) => Promise<void>;
  updateUser: (id: string, updates: Partial<User> & { password?: string }) => Promise<void>;
  deleteUser: (id: string) => Promise<void>;
  addTeam: (team: TeamLike) => Promise<void>;
  updateTeam: (id: string, updates: Partial<Team>) => Promise<void>;
  deleteTeam: (id: string) => Promise<void>;
  addWorkflow: (workflow: WorkflowLike) => Promise<void>;
  updateWorkflow: (id: string, updates: Partial<Workflow>) => Promise<void>;
  deleteWorkflow: (id: string) => Promise<void>;
  markNotificationRead: (id: string) => Promise<void>;
  markAllRead: () => Promise<void>;
  addEmailTemplate: (template: EmailTemplateLike) => Promise<void>;
  updateEmailTemplate: (id: string, updates: Partial<EmailTemplate>) => Promise<void>;
  deleteEmailTemplate: (id: string) => Promise<void>;
  updateSettings: (updates: UpdateSettingsBody) => Promise<void>;
}

const DataContext = createContext<DataContextType | undefined>(undefined);
const PAGE_SIZE = 100;

function ensureTaskShape(task: Partial<TaskDetail>): TaskDetail {
  return {
    comments: [],
    internalNotes: [],
    activityLog: [],
    attachments: [],
    ...task,
  } as TaskDetail;
}

function normalizeOptionalId(value: string | null | undefined): string | undefined {
  return value && value.trim() !== "" ? value : undefined;
}

export function DataProvider({ children }: { children: ReactNode }) {
  const { user, request } = useAuth();
  const queryClient = useQueryClient();
  const isAdmin = user?.role === "admin";
  const isAuthenticated = Boolean(user);

  const tasksQuery = useQuery({
    queryKey: ["tasks", user?.id],
    enabled: isAuthenticated,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<TaskDetail[]>>(`/tasks?perPage=${PAGE_SIZE}`);
      return response.data.map(ensureTaskShape);
    },
  });

  const notificationsQuery = useQuery({
    queryKey: ["notifications", user?.id],
    enabled: isAuthenticated,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<Notification[]>>(`/notifications?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  const usersQuery = useQuery({
    queryKey: ["users"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<User[]>>(`/users?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  const teamsQuery = useQuery({
    queryKey: ["teams"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<Team[]>>(`/teams?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  const workflowsQuery = useQuery({
    queryKey: ["workflows"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<Workflow[]>>(`/workflows?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  const emailTemplatesQuery = useQuery({
    queryKey: ["email-templates"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<EmailTemplate[]>>(`/email-templates?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  const settingsQuery = useQuery({
    queryKey: ["settings"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiEnvelope<SystemSettings>>("/settings");
      return response.data;
    },
  });

  const activitiesQuery = useQuery({
    queryKey: ["activity-feed"],
    enabled: isAuthenticated && isAdmin,
    queryFn: async () => {
      const response = await request<ApiPaginatedEnvelope<ActivityItem[]>>(`/reports/activity-feed?perPage=${PAGE_SIZE}`);
      return response.data;
    },
  });

  useEffect(() => {
    if (!isAuthenticated) {
      return;
    }

    applyBrandingFromSettings(settingsQuery.data);
  }, [isAuthenticated, settingsQuery.data]);

  const invalidateTaskRelated = async () => {
    await Promise.all([
      queryClient.invalidateQueries({ queryKey: ["tasks"] }),
      queryClient.invalidateQueries({ queryKey: ["notifications"] }),
      queryClient.invalidateQueries({ queryKey: ["activity-feed"] }),
    ]);
  };

  const getCurrentTask = (id: string) =>
    tasksQuery.data?.find((task) => task.id === id) ?? null;

  const getTaskById = async (id: string): Promise<TaskDetail | null> => {
    try {
      const response = await request<ApiEnvelope<TaskDetail>>(`/tasks/${id}`);
      return ensureTaskShape(response.data);
    } catch (error) {
      console.error("Failed to load task", error);
      return null;
    }
  };

  const addTask = async (task: TaskLike) => {
    try {
      await request("/tasks", {
        method: "POST",
        body: {
          title: task.title,
          description: task.description,
          priority: task.priority,
          workflowId: task.workflowId,
          assignedUserId: task.assignedUserId,
          dueDate: task.dueDate,
        },
      });

      await invalidateTaskRelated();
    } catch (error) {
      console.error("Failed to create task", error);
    }
  };

  const updateTask = async (id: string, updates: Partial<TaskDetail>) => {
    const currentTask = getCurrentTask(id);

    try {
      if (updates.status === "closed") {
        await request(`/tasks/${id}/close`, { method: "POST" });
      } else if (updates.status === "on_hold") {
        await request(`/tasks/${id}/hold`, { method: "POST" });
      } else if (
        typeof updates.currentStepIndex === "number" &&
        currentTask &&
        updates.currentStepIndex > currentTask.currentStepIndex
      ) {
        await request(`/tasks/${id}/complete-step`, {
          method: "POST",
          body: { notes: null },
        });
      } else if (
        typeof updates.currentStepIndex === "number" &&
        currentTask &&
        updates.currentStepIndex < currentTask.currentStepIndex
      ) {
        await request(`/tasks/${id}/send-back`, {
          method: "POST",
          body: { targetStepId: updates.currentStepId },
        });
      } else {
        await request(`/tasks/${id}`, {
          method: "PUT",
          body: {
            title: updates.title,
            description: updates.description,
            priority: updates.priority,
            workflowId: updates.workflowId,
            assignedUserId: updates.assignedUserId,
            dueDate: updates.dueDate,
            status: updates.status,
          },
        });
      }

      await invalidateTaskRelated();
    } catch (error) {
      console.error("Failed to update task", error);
    }
  };

  const deleteTask = async (id: string) => {
    try {
      await request(`/tasks/${id}`, { method: "DELETE" });
      await invalidateTaskRelated();
    } catch (error) {
      console.error("Failed to delete task", error);
    }
  };

  const addComment = async (
    taskId: string,
    comment: Pick<NonNullable<TaskDetail["comments"]>[number], "content" | "isInternal">,
  ) => {
    try {
      await request(`/tasks/${taskId}/comments`, {
        method: "POST",
        body: {
          content: comment.content,
          isInternal: comment.isInternal,
        },
      });

      await invalidateTaskRelated();
    } catch (error) {
      console.error("Failed to add comment", error);
    }
  };

  const addUser = async (userInput: UserLike) => {
    await request("/users", {
      method: "POST",
      body: {
        name: userInput.name,
        email: userInput.email,
        password: userInput.password || "ChangeMe123!",
        role: userInput.role,
        teamId: normalizeOptionalId(userInput.teamId),
      },
    });

    await queryClient.invalidateQueries({ queryKey: ["users"] });
  };

  const updateUser = async (id: string, updates: Partial<User> & { password?: string }) => {
    await request(`/users/${id}`, {
      method: "PUT",
      body: {
        name: updates.name,
        email: updates.email,
        role: updates.role,
        teamId: normalizeOptionalId(updates.teamId),
        status: updates.status,
        password: updates.password,
      },
    });

    await queryClient.invalidateQueries({ queryKey: ["users"] });
  };

  const deleteUser = async (id: string) => {
    await request(`/users/${id}`, { method: "DELETE" });
    await queryClient.invalidateQueries({ queryKey: ["users"] });
  };

  const addTeam = async (team: TeamLike) => {
    try {
      await request("/teams", {
        method: "POST",
        body: {
          name: team.name,
          description: team.description,
          color: team.color,
        },
      });

      await queryClient.invalidateQueries({ queryKey: ["teams"] });
    } catch (error) {
      console.error("Failed to create team", error);
    }
  };

  const updateTeam = async (id: string, updates: Partial<Team>) => {
    try {
      await request(`/teams/${id}`, {
        method: "PUT",
        body: {
          name: updates.name,
          description: updates.description,
          color: updates.color,
        },
      });

      await queryClient.invalidateQueries({ queryKey: ["teams"] });
    } catch (error) {
      console.error("Failed to update team", error);
    }
  };

  const deleteTeam = async (id: string) => {
    try {
      await request(`/teams/${id}`, { method: "DELETE" });
      await queryClient.invalidateQueries({ queryKey: ["teams"] });
    } catch (error) {
      console.error("Failed to delete team", error);
    }
  };

  const addWorkflow = async (workflow: WorkflowLike) => {
    await request("/workflows", {
      method: "POST",
      body: {
        name: workflow.name,
        description: workflow.description,
        status: workflow.status,
        steps: (workflow.steps || []).map((step, index) => ({
          id: step.id?.startsWith("new-") ? undefined : step.id,
          name: step.name,
          description: step.description,
          teamId: normalizeOptionalId(step.teamId),
          stepType: step.stepType,
          required: step.required,
          order: index + 1,
        })),
      },
    });

    await queryClient.invalidateQueries({ queryKey: ["workflows"] });
  };

  const updateWorkflow = async (id: string, updates: Partial<Workflow>) => {
    await request(`/workflows/${id}`, {
      method: "PUT",
      body: {
        name: updates.name,
        description: updates.description,
        status: updates.status,
        steps: updates.steps?.map((step, index) => ({
          id: step.id?.startsWith("new-") ? undefined : step.id,
          name: step.name,
          description: step.description,
          teamId: normalizeOptionalId(step.teamId),
          stepType: step.stepType,
          required: step.required,
          order: index + 1,
        })),
      },
    });

    await queryClient.invalidateQueries({ queryKey: ["workflows"] });
  };

  const deleteWorkflow = async (id: string) => {
    await request(`/workflows/${id}`, { method: "DELETE" });
    await queryClient.invalidateQueries({ queryKey: ["workflows"] });
  };

  const markNotificationRead = async (id: string) => {
    try {
      await request(`/notifications/${id}/read`, { method: "POST" });
      await queryClient.invalidateQueries({ queryKey: ["notifications"] });
    } catch (error) {
      console.error("Failed to mark notification as read", error);
    }
  };

  const markAllRead = async () => {
    try {
      await request("/notifications/mark-all-read", { method: "POST" });
      await queryClient.invalidateQueries({ queryKey: ["notifications"] });
    } catch (error) {
      console.error("Failed to mark all notifications as read", error);
    }
  };

  const addEmailTemplate = async (template: EmailTemplateLike) => {
    try {
      await request("/email-templates", {
        method: "POST",
        body: {
          name: template.name,
          subject: template.subject,
          body: template.body,
          trigger: template.trigger,
          variables: template.variables || [],
          isActive: template.isActive,
        },
      });

      await queryClient.invalidateQueries({ queryKey: ["email-templates"] });
    } catch (error) {
      console.error("Failed to create email template", error);
    }
  };

  const updateEmailTemplate = async (id: string, updates: Partial<EmailTemplate>) => {
    try {
      await request(`/email-templates/${id}`, {
        method: "PUT",
        body: {
          name: updates.name,
          subject: updates.subject,
          body: updates.body,
          trigger: updates.trigger,
          variables: updates.variables,
          isActive: updates.isActive,
        },
      });

      await queryClient.invalidateQueries({ queryKey: ["email-templates"] });
    } catch (error) {
      console.error("Failed to update email template", error);
    }
  };

  const deleteEmailTemplate = async (id: string) => {
    try {
      await request(`/email-templates/${id}`, { method: "DELETE" });
      await queryClient.invalidateQueries({ queryKey: ["email-templates"] });
    } catch (error) {
      console.error("Failed to delete email template", error);
    }
  };

  const updateSettings = async (updates: UpdateSettingsBody) => {
    await request("/settings", {
      method: "PUT",
      body: { ...updates },
    });

    await queryClient.invalidateQueries({ queryKey: ["settings"] });
  };

  return (
    <DataContext.Provider
      value={{
        tasks: tasksQuery.data ?? [],
        users: usersQuery.data ?? [],
        teams: teamsQuery.data ?? [],
        workflows: workflowsQuery.data ?? [],
        notifications: notificationsQuery.data ?? [],
        emailTemplates: emailTemplatesQuery.data ?? [],
        settings: settingsQuery.data ?? null,
        activities: activitiesQuery.data ?? [],
        getTaskById,
        addTask,
        updateTask,
        deleteTask,
        addComment,
        addUser,
        updateUser,
        deleteUser,
        addTeam,
        updateTeam,
        deleteTeam,
        addWorkflow,
        updateWorkflow,
        deleteWorkflow,
        markNotificationRead,
        markAllRead,
        addEmailTemplate,
        updateEmailTemplate,
        deleteEmailTemplate,
        updateSettings,
      }}
    >
      {children}
    </DataContext.Provider>
  );
}

export function useData() {
  const context = useContext(DataContext);

  if (!context) {
    throw new Error("useData must be used within a DataProvider");
  }

  return context;
}
