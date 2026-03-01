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
  const handlePHP = (filePath: string, res: express.Response) => {
    try {
      // Use npx @php-wasm/cli to execute the PHP file
      const output = execSync(`npx -y @php-wasm/cli ${filePath}`).toString();
      
      if (filePath.endsWith("api.php")) {
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

  // API Route (PHP)
  app.get("/api/recommendations", (req, res) => {
    handlePHP(path.join(__dirname, "api.php"), res);
  });

  // Vite middleware for development
  if (process.env.NODE_ENV !== "production") {
    const vite = await createViteServer({
      server: { middlewareMode: true },
      appType: "custom",
    });
    app.use(vite.middlewares);
    
    app.get("/", (req, res) => {
      handlePHP(path.join(__dirname, "index.php"), res);
    });
  } else {
    app.use(express.static(path.join(__dirname, "dist")));
    app.get("/", (req, res) => {
      handlePHP(path.join(__dirname, "index.php"), res);
    });
  }

  app.listen(PORT, "0.0.0.0", () => {
    console.log(`Server running at http://0.0.0.0:${PORT}`);
    console.log(`PHP Version active via @php-wasm/cli`);
  });
}

startServer();
