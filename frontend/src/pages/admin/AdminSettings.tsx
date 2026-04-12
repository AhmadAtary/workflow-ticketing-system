import { useEffect, useState } from "react";
import type { SystemSettingsDefaultLanguage, UpdateSettingsBody } from "@flowdesk/api-client";
import { Settings, Mail, Globe, Palette, Shield, Save } from "lucide-react";
import { useData } from "../../contexts/DataContext";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Switch } from "@/components/ui/switch";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { useToast } from "@/hooks/use-toast";

export default function AdminSettings() {
  const { settings, updateSettings } = useData();
  const { toast } = useToast();
  const [savingSection, setSavingSection] = useState<"general" | "mail" | "branding" | null>(null);
  const [general, setGeneral] = useState<{
    companyName: string;
    defaultLanguage: SystemSettingsDefaultLanguage;
    allowRegistration: boolean;
    requireEmailVerification: boolean;
  }>({
    companyName: settings?.companyName || "FlowDesk",
    defaultLanguage: settings?.defaultLanguage || "en",
    allowRegistration: settings?.allowRegistration || false,
    requireEmailVerification: settings?.requireEmailVerification || false,
  });
  const [mail, setMail] = useState({
    emailEnabled: settings?.emailEnabled || false,
    emailHost: settings?.emailHost || "",
    emailPort: settings?.emailPort || 587,
    emailFrom: settings?.emailFrom || "",
    emailUser: settings?.emailUser || "",
    emailPassword: "",
  });
  const [branding, setBranding] = useState({
    primaryColor: settings?.primaryColor || "#3b82f6",
    logoUrl: settings?.logoUrl || "",
  });

  useEffect(() => {
    if (!settings) {
      return;
    }

    setGeneral({
      companyName: settings.companyName || "FlowDesk",
      defaultLanguage: settings.defaultLanguage || "en",
      allowRegistration: settings.allowRegistration || false,
      requireEmailVerification: settings.requireEmailVerification || false,
    });

    setMail({
      emailEnabled: settings.emailEnabled || false,
      emailHost: settings.emailHost || "",
      emailPort: settings.emailPort || 587,
      emailFrom: settings.emailFrom || "",
      emailUser: settings.emailUser || "",
      emailPassword: "",
    });

    setBranding({
      primaryColor: settings.primaryColor || "#3b82f6",
      logoUrl: settings.logoUrl || "",
    });
  }, [settings]);

  const saveSettings = async (
    section: "general" | "mail" | "branding",
    payload: UpdateSettingsBody,
    successTitle: string,
  ) => {
    setSavingSection(section);

    try {
      await updateSettings(payload);
      toast({ title: successTitle });
    } catch {
      toast({
        title: "Failed to save settings",
        description: "Please review the values and try again.",
        variant: "destructive",
      });
    } finally {
      setSavingSection(null);
    }
  };

  const saveGeneral = async () => {
    await saveSettings("general", { ...general }, "General settings saved");
  };

  const saveMail = async () => {
    const payload: UpdateSettingsBody = {
      emailEnabled: mail.emailEnabled,
      emailHost: mail.emailHost,
      emailPort: mail.emailPort,
      emailFrom: mail.emailFrom,
      emailUser: mail.emailUser,
    };

    if (mail.emailPassword.trim()) {
      payload.emailPassword = mail.emailPassword;
    }

    await saveSettings("mail", payload, "Mail settings saved");
  };

  const saveBranding = async () => {
    await saveSettings("branding", { ...branding }, "Branding settings saved");
  };

  const roles = [
    { name: "Admin", permissions: ["Manage teams", "Manage users", "Create workflows", "View all tasks", "Manage settings", "View reports", "Manage email templates"], color: "bg-primary/10 text-primary" },
    { name: "User", permissions: ["View assigned tasks", "Complete steps", "Add comments", "View task details", "View notifications"], color: "bg-muted text-muted-foreground" },
  ];

  return (
    <div className="space-y-5">
      <div>
        <h1 className="text-2xl font-bold text-foreground">Settings</h1>
        <p className="text-sm text-muted-foreground mt-1">Manage system configuration</p>
      </div>

      <Tabs defaultValue="general">
        <TabsList className="border-b border-border bg-transparent rounded-none w-full justify-start p-0 h-auto gap-0">
          {[
            { value: "general", label: "General", icon: Settings },
            { value: "mail", label: "Mail", icon: Mail },
            { value: "branding", label: "Branding", icon: Palette },
            { value: "roles", label: "Roles", icon: Shield },
            { value: "language", label: "Language", icon: Globe },
          ].map((tab) => (
            <TabsTrigger key={tab.value} value={tab.value} className="rounded-none border-b-2 border-transparent data-[state=active]:border-primary data-[state=active]:text-primary pb-3 px-4 text-sm font-medium flex items-center gap-2">
              <tab.icon className="h-4 w-4" />{tab.label}
            </TabsTrigger>
          ))}
        </TabsList>

        <TabsContent value="general" className="mt-6">
          <Card className="border-border max-w-2xl">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">General Settings</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <Label>Company Name</Label>
                <Input value={general.companyName} onChange={(event) => setGeneral((current) => ({ ...current, companyName: event.target.value }))} className="mt-1 max-w-sm" />
              </div>
              <div className="flex items-center justify-between py-3 border-b border-border">
                <div>
                  <p className="text-sm font-medium text-foreground">Allow Self-Registration</p>
                  <p className="text-xs text-muted-foreground">Users can register without admin invite</p>
                </div>
                <Switch checked={general.allowRegistration} onCheckedChange={(value) => setGeneral((current) => ({ ...current, allowRegistration: value }))} />
              </div>
              <div className="flex items-center justify-between py-3">
                <div>
                  <p className="text-sm font-medium text-foreground">Require Email Verification</p>
                  <p className="text-xs text-muted-foreground">Users must verify email on registration</p>
                </div>
                <Switch checked={general.requireEmailVerification} onCheckedChange={(value) => setGeneral((current) => ({ ...current, requireEmailVerification: value }))} />
              </div>
              <Button onClick={() => void saveGeneral()} disabled={savingSection === "general"}>
                <Save className="h-4 w-4 mr-2" />
                {savingSection === "general" ? "Saving..." : "Save General Settings"}
              </Button>
            </CardContent>
          </Card>
        </TabsContent>

        <TabsContent value="mail" className="mt-6">
          <Card className="border-border max-w-2xl">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">Mail Settings</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="flex items-center justify-between py-2">
                <div>
                  <p className="text-sm font-medium text-foreground">Enable Email Notifications</p>
                  <p className="text-xs text-muted-foreground">Send automated email notifications</p>
                </div>
                <Switch checked={mail.emailEnabled} onCheckedChange={(value) => setMail((current) => ({ ...current, emailEnabled: value }))} />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label>SMTP Host</Label>
                  <Input value={mail.emailHost} onChange={(event) => setMail((current) => ({ ...current, emailHost: event.target.value }))} placeholder="smtp.gmail.com" className="mt-1" disabled={!mail.emailEnabled} />
                </div>
                <div>
                  <Label>SMTP Port</Label>
                  <Input type="number" value={mail.emailPort} onChange={(event) => setMail((current) => ({ ...current, emailPort: Number(event.target.value) }))} placeholder="587" className="mt-1" disabled={!mail.emailEnabled} />
                </div>
                <div>
                  <Label>From Email</Label>
                  <Input type="email" value={mail.emailFrom} onChange={(event) => setMail((current) => ({ ...current, emailFrom: event.target.value }))} placeholder="noreply@company.com" className="mt-1" disabled={!mail.emailEnabled} />
                </div>
                <div>
                  <Label>Username</Label>
                  <Input value={mail.emailUser} onChange={(event) => setMail((current) => ({ ...current, emailUser: event.target.value }))} placeholder="SMTP username" className="mt-1" disabled={!mail.emailEnabled} />
                </div>
                <div>
                  <Label>Password</Label>
                  <Input type="password" value={mail.emailPassword} onChange={(event) => setMail((current) => ({ ...current, emailPassword: event.target.value }))} placeholder="SMTP password" className="mt-1" disabled={!mail.emailEnabled} />
                </div>
              </div>
              <Button onClick={() => void saveMail()} disabled={savingSection === "mail"}>
                <Save className="h-4 w-4 mr-2" />
                {savingSection === "mail" ? "Saving..." : "Save Mail Settings"}
              </Button>
            </CardContent>
          </Card>
        </TabsContent>

        <TabsContent value="branding" className="mt-6">
          <Card className="border-border max-w-2xl">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">Branding</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <Label>Primary Brand Color</Label>
                <div className="flex items-center gap-3 mt-1">
                  <input type="color" value={branding.primaryColor} onChange={(event) => setBranding((current) => ({ ...current, primaryColor: event.target.value }))} className="h-9 w-16 rounded border border-border cursor-pointer p-0.5" />
                  <Input value={branding.primaryColor} onChange={(event) => setBranding((current) => ({ ...current, primaryColor: event.target.value }))} className="max-w-[140px] font-mono" />
                </div>
              </div>
              <div>
                <Label>Logo URL</Label>
                <Input value={branding.logoUrl} onChange={(event) => setBranding((current) => ({ ...current, logoUrl: event.target.value }))} placeholder="https://..." className="mt-1 max-w-sm" />
              </div>
              <Button onClick={() => void saveBranding()} disabled={savingSection === "branding"}>
                <Save className="h-4 w-4 mr-2" />
                {savingSection === "branding" ? "Saving..." : "Save Branding"}
              </Button>
            </CardContent>
          </Card>
        </TabsContent>

        <TabsContent value="roles" className="mt-6">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-3xl">
            {roles.map((role) => (
              <Card key={role.name} className="border-border">
                <CardHeader className="pb-2">
                  <CardTitle className="text-base font-semibold flex items-center gap-2">
                    <span className={`text-xs px-2 py-0.5 rounded-full font-medium ${role.color}`}>{role.name}</span>
                  </CardTitle>
                </CardHeader>
                <CardContent>
                  <ul className="space-y-1.5">
                    {role.permissions.map((permission) => (
                      <li key={permission} className="flex items-center gap-2 text-sm text-foreground">
                        <div className="h-1.5 w-1.5 rounded-full bg-primary shrink-0" />
                        {permission}
                      </li>
                    ))}
                  </ul>
                </CardContent>
              </Card>
            ))}
          </div>
        </TabsContent>

        <TabsContent value="language" className="mt-6">
          <Card className="border-border max-w-sm">
            <CardHeader className="pb-3">
              <CardTitle className="text-base font-semibold">Language Settings</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <Label>Default Language</Label>
                <Select
                  value={general.defaultLanguage}
                  onValueChange={(value) =>
                    setGeneral((current) => ({ ...current, defaultLanguage: value as SystemSettingsDefaultLanguage }))
                  }
                >
                  <SelectTrigger className="mt-1"><SelectValue /></SelectTrigger>
                  <SelectContent>
                    <SelectItem value="en">English</SelectItem>
                    <SelectItem value="ar">Arabic</SelectItem>
                  </SelectContent>
                </Select>
                <p className="text-xs text-muted-foreground mt-2">Sets the default interface language for new users</p>
              </div>
              <Button onClick={() => void saveGeneral()} disabled={savingSection === "general"}>
                <Save className="h-4 w-4 mr-2" />
                {savingSection === "general" ? "Saving..." : "Save Language"}
              </Button>
            </CardContent>
          </Card>
        </TabsContent>
      </Tabs>
    </div>
  );
}
