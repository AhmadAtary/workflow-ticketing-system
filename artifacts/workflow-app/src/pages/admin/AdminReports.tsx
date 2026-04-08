import { useData } from "../../contexts/DataContext";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { useState } from "react";
import {
  BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer,
  LineChart, Line, PieChart, Pie, Cell, Legend
} from "recharts";
import { AlertTriangle, TrendingDown, CheckCircle2 } from "lucide-react";
import { format } from "date-fns";

export default function AdminReports() {
  const { tasks, teams, workflows } = useData();
  const [period, setPeriod] = useState("month");

  const tasksByStatus = [
    { name: "Open", value: tasks.filter(t => t.status === "open").length, color: "#3b82f6" },
    { name: "In Progress", value: tasks.filter(t => t.status === "in_progress").length, color: "#f59e0b" },
    { name: "On Hold", value: tasks.filter(t => t.status === "on_hold").length, color: "#8b5cf6" },
    { name: "Completed", value: tasks.filter(t => t.status === "completed").length, color: "#10b981" },
    { name: "Closed", value: tasks.filter(t => t.status === "closed").length, color: "#6b7280" },
  ];

  const teamPerformance = teams.map(team => {
    const teamTasks = tasks.filter(t => t.assignedTeamId === team.id);
    return {
      name: team.name,
      completed: teamTasks.filter(t => t.status === "completed").length,
      active: teamTasks.filter(t => t.status === "in_progress" || t.status === "open").length,
      overdue: teamTasks.filter(t => t.isOverdue).length,
    };
  });

  const completionTrend = [
    { date: "Week 1", created: 8, completed: 5 },
    { date: "Week 2", created: 12, completed: 9 },
    { date: "Week 3", created: 7, completed: 10 },
    { date: "Week 4", created: 15, completed: 12 },
    { date: "Week 5", created: 10, completed: 8 },
    { date: "Week 6", created: 14, completed: 13 },
  ];

  const workflowBottlenecks = workflows.map(wf => {
    const wfTasks = tasks.filter(t => t.workflowId === wf.id);
    const stuckTasks = wfTasks.filter(t => t.status === "in_progress" || t.status === "on_hold");
    const stepCounts = wf.steps?.reduce((acc, step) => {
      const count = stuckTasks.filter(t => t.currentStepId === step.id).length;
      if (count > 0) acc.push({ step: step.name, count, team: step.teamName });
      return acc;
    }, [] as any[]) || [];
    return { workflow: wf.name, bottlenecks: stepCounts };
  }).filter(w => w.bottlenecks.length > 0);

  const overdueTasks = tasks.filter(t => t.isOverdue);

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-foreground">Reports & Analytics</h1>
          <p className="text-sm text-muted-foreground mt-1">System-wide performance overview</p>
        </div>
        <Select value={period} onValueChange={setPeriod}>
          <SelectTrigger className="w-36"><SelectValue /></SelectTrigger>
          <SelectContent>
            <SelectItem value="week">This Week</SelectItem>
            <SelectItem value="month">This Month</SelectItem>
            <SelectItem value="quarter">This Quarter</SelectItem>
          </SelectContent>
        </Select>
      </div>

      {/* Task Overview */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold">Task Distribution</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={220}>
              <PieChart>
                <Pie data={tasksByStatus.filter(d => d.value > 0)} cx="50%" cy="50%" innerRadius={55} outerRadius={85} paddingAngle={2} dataKey="value">
                  {tasksByStatus.filter(d => d.value > 0).map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={entry.color} />
                  ))}
                </Pie>
                <Tooltip />
                <Legend />
              </PieChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>

        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold">Task Trend</CardTitle>
          </CardHeader>
          <CardContent>
            <ResponsiveContainer width="100%" height={220}>
              <LineChart data={completionTrend} margin={{ top: 5, right: 10, left: -20, bottom: 5 }}>
                <CartesianGrid strokeDasharray="3 3" stroke="hsl(var(--border))" />
                <XAxis dataKey="date" tick={{ fontSize: 11, fill: "hsl(var(--muted-foreground))" }} />
                <YAxis tick={{ fontSize: 11, fill: "hsl(var(--muted-foreground))" }} />
                <Tooltip contentStyle={{ background: "hsl(var(--card))", border: "1px solid hsl(var(--border))", borderRadius: 6 }} />
                <Line type="monotone" dataKey="created" stroke="#3b82f6" strokeWidth={2} dot={false} name="Created" />
                <Line type="monotone" dataKey="completed" stroke="#10b981" strokeWidth={2} dot={false} name="Completed" />
                <Legend />
              </LineChart>
            </ResponsiveContainer>
          </CardContent>
        </Card>
      </div>

      {/* Team Performance */}
      <Card className="border-border">
        <CardHeader className="pb-2">
          <CardTitle className="text-base font-semibold">Team Performance</CardTitle>
        </CardHeader>
        <CardContent>
          <ResponsiveContainer width="100%" height={250}>
            <BarChart data={teamPerformance} margin={{ top: 5, right: 10, left: -20, bottom: 5 }}>
              <CartesianGrid strokeDasharray="3 3" stroke="hsl(var(--border))" />
              <XAxis dataKey="name" tick={{ fontSize: 12, fill: "hsl(var(--muted-foreground))" }} />
              <YAxis tick={{ fontSize: 12, fill: "hsl(var(--muted-foreground))" }} />
              <Tooltip contentStyle={{ background: "hsl(var(--card))", border: "1px solid hsl(var(--border))", borderRadius: 6 }} />
              <Bar dataKey="completed" fill="#10b981" radius={[4, 4, 0, 0]} name="Completed" />
              <Bar dataKey="active" fill="#3b82f6" radius={[4, 4, 0, 0]} name="Active" />
              <Bar dataKey="overdue" fill="#ef4444" radius={[4, 4, 0, 0]} name="Overdue" />
              <Legend />
            </BarChart>
          </ResponsiveContainer>
        </CardContent>
      </Card>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Workflow Bottlenecks */}
        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold flex items-center gap-2">
              <TrendingDown className="h-4 w-4 text-amber-500" /> Workflow Bottlenecks
            </CardTitle>
          </CardHeader>
          <CardContent>
            {workflowBottlenecks.length === 0 ? (
              <div className="text-center py-8">
                <CheckCircle2 className="h-10 w-10 text-green-400 mx-auto mb-2" />
                <p className="text-muted-foreground text-sm">No bottlenecks detected</p>
              </div>
            ) : (
              <div className="space-y-4">
                {workflowBottlenecks.map((wf, i) => (
                  <div key={i}>
                    <p className="text-sm font-semibold text-foreground mb-2">{wf.workflow}</p>
                    {wf.bottlenecks.map((b, j) => (
                      <div key={j} className="flex items-center justify-between p-2 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800/30 rounded-lg mb-1">
                        <div>
                          <p className="text-sm font-medium text-foreground">{b.step}</p>
                          {b.team && <p className="text-xs text-muted-foreground">{b.team}</p>}
                        </div>
                        <span className="text-sm font-bold text-amber-700 dark:text-amber-400">{b.count} stuck</span>
                      </div>
                    ))}
                  </div>
                ))}
              </div>
            )}
          </CardContent>
        </Card>

        {/* Overdue Tasks */}
        <Card className="border-border">
          <CardHeader className="pb-2">
            <CardTitle className="text-base font-semibold flex items-center gap-2">
              <AlertTriangle className="h-4 w-4 text-red-500" /> Delayed Tasks
            </CardTitle>
          </CardHeader>
          <CardContent>
            {overdueTasks.length === 0 ? (
              <div className="text-center py-8">
                <CheckCircle2 className="h-10 w-10 text-green-400 mx-auto mb-2" />
                <p className="text-muted-foreground text-sm">No overdue tasks</p>
              </div>
            ) : (
              <div className="overflow-x-auto">
                <table className="w-full text-sm">
                  <thead>
                    <tr className="border-b border-border">
                      <th className="text-left py-2 font-medium text-muted-foreground">Task</th>
                      <th className="text-left py-2 font-medium text-muted-foreground">Team</th>
                      <th className="text-left py-2 font-medium text-muted-foreground">Due</th>
                    </tr>
                  </thead>
                  <tbody>
                    {overdueTasks.map(task => (
                      <tr key={task.id} className="border-b border-border last:border-0">
                        <td className="py-2.5 font-medium text-foreground">{task.title}</td>
                        <td className="py-2.5 text-muted-foreground">{task.assignedTeamName || "—"}</td>
                        <td className="py-2.5 text-red-500 font-medium">
                          {task.dueDate ? format(new Date(task.dueDate), "MMM d") : "—"}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
