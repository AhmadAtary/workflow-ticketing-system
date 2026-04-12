import { createRoot } from "react-dom/client";
import App from "./App";
import { initializeBrandingFromCache } from "@/app/branding";
import "./index.css";

initializeBrandingFromCache();

createRoot(document.getElementById("root")!).render(<App />);
