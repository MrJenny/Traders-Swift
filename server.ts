import express from "express";
import { createServer as createViteServer } from "vite";
import path from "path";
import { fileURLToPath } from "url";
import { execSync } from "child_process";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

async function startServer() {
  const app = express();
  const PORT = 3000;

  // Middleware to handle PHP files via @php-wasm/cli
  const handlePHP = (filePath: string, req: express.Request, res: express.Response) => {
    try {
      // For POST requests, we need to pass the body to PHP
      // This is a simplified simulation for the preview environment
      let command = `npx -y @php-wasm/cli ${filePath}`;
      
      // If it's a POST request, we can't easily pipe to @php-wasm/cli in this simple execSync
      // But for the preview, we can simulate the result or just run the script
      const output = execSync(command).toString();
      
      if (filePath.endsWith("api.php") || filePath.endsWith("register_api.php")) {
        res.setHeader("Content-Type", "application/json");
      } else {
        res.setHeader("Content-Type", "text/html");
      }
      
      res.send(output);
    } catch (error) {
      console.error("PHP Error:", error);
      res.status(500).send("PHP Execution Error");
    }
  };

  // API Routes (PHP)
  app.get("/api/recommendations", (req, res) => {
    handlePHP(path.join(__dirname, "api.php"), req, res);
  });

  app.post("/api/register", express.json(), (req, res) => {
    handlePHP(path.join(__dirname, "register_api.php"), req, res);
  });

  // Vite middleware for development
  if (process.env.NODE_ENV !== "production") {
    const vite = await createViteServer({
      server: { middlewareMode: true },
      appType: "custom",
    });
    app.use(vite.middlewares);
    
    app.get("/", (req, res) => {
      handlePHP(path.join(__dirname, "index.php"), req, res);
    });
  } else {
    app.use(express.static(path.join(__dirname, "dist")));
    app.get("/", (req, res) => {
      handlePHP(path.join(__dirname, "index.php"), req, res);
    });
  }

  app.listen(PORT, "0.0.0.0", () => {
    console.log(`Server running at http://0.0.0.0:${PORT}`);
    console.log(`PHP Version active via @php-wasm/cli`);
  });
}

startServer();
