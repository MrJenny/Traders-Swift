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
      console.log(`Executing PHP: ${filePath} [${req.method}]`);
      
      // For the preview environment, we use @php-wasm/cli
      // Note: This CLI version has limitations with POST data (php://input)
      let command = `npx -y @php-wasm/cli ${filePath}`;
      
      const output = execSync(command).toString();
      
      if (filePath.endsWith("api.php") || filePath.endsWith("register_api.php")) {
        res.setHeader("Content-Type", "application/json");
      } else {
        res.setHeader("Content-Type", "text/html");
      }
      
      res.send(output);
    } catch (error: any) {
      console.error("PHP Execution Error:", error.message);
      if (error.stdout) console.log("PHP Stdout:", error.stdout.toString());
      if (error.stderr) console.error("PHP Stderr:", error.stderr.toString());
      
      res.status(500).json({
        success: false,
        message: "PHP Execution Error",
        debug: error.stderr ? error.stderr.toString() : error.message
      });
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
