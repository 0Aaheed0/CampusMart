# 🐳 CampusMart Docker Complete Guide

## What is Docker?
Docker is a containerization platform that packages your entire application with all its dependencies into containers. This means the application runs the same way on your PC, your friend's PC, or a server.

---

## 📋 What's in CampusMart Docker Setup?

### Files Included:

1. **`Dockerfile`** ⚙️
   - Defines how to build the PHP-FPM application container
   - Installs all PHP extensions needed for Laravel
   - Sets up proper permissions
   - Configures application environment

2. **`docker-compose.yml`** 🔧
   - Orchestrates multiple containers (App + Database)
   - Sets up networking between containers
   - Defines volumes for persistent data
   - Configures environment variables
   - Adds health checks

3. **`.dockerignore`** 📦
   - Specifies which files to exclude from Docker image
   - Reduces image size
   - Prevents unnecessary files from being copied

4. **`.env.example`** 🔐
   - Template for environment variables
   - Shows all configurable options
   - Safe to commit to version control

5. **`DOCKER_SETUP.md`** 📖
   - Detailed technical documentation
   - Command reference
   - Troubleshooting guide

---

## 🚀 Quick Start (5 Minutes)

### Step 1: Install Docker
- **Windows/Mac**: Download [Docker Desktop](https://www.docker.com/products/docker-desktop)
- **Linux**: `sudo apt install docker.io docker-compose`

### Step 2: Setup Environment
```bash
# Copy environment template
cp .env.example .env

# Generate Laravel key
docker-compose exec app php artisan key:generate
```

### Step 3: Run Docker
```bash
# Start all containers
docker-compose up -d

# Check if running
docker-compose ps
```

### Step 4: Initialize Database
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed demo data
docker-compose exec app php artisan db:seed
```

### Step 5: Access Application
- **App**: http://localhost:8000
- **Database**: localhost:3306

✅ **Done! Your CampusMart is running!**

---

## 📦 What Each Service Does

### 🎯 `campusmart_app` (PHP-FPM Application)
```
Purpose: Runs your Laravel application
Port: 8000 (http://localhost:8000)
Image: PHP 8.2-FPM
What happens:
  ✅ Executes PHP code
  ✅ Handles HTTP requests
  ✅ Communicates with database
  ✅ Runs Laravel commands
```

### 💾 `campusmart_db` (MySQL Database)
```
Purpose: Stores all application data
Port: 3306 (localhost:3306)
Image: MySQL 8.0
What happens:
  ✅ Stores users, products, orders
  ✅ Maintains data persistence (even if container stops)
  ✅ Handles queries from the app
```

### 🔗 `campusmart_network` (Docker Network)
```
Purpose: Allows containers to communicate
What happens:
  ✅ Containers can talk using service names (app, db)
  ✅ Isolated from other Docker networks
```

### 💾 `db_data` (Docker Volume)
```
Purpose: Persistent database storage
What happens:
  ✅ Database data survives container restarts
  ✅ Stored in Docker's managed location
  ✅ Backup-friendly
```

---

## 🎮 Common Docker Commands

### Start & Stop
```bash
# Start containers (first time builds them)
docker-compose up -d

# View running containers
docker-compose ps

# Stop containers
docker-compose down

# Stop and delete data (⚠️ WARNING: Deletes database!)
docker-compose down -v

# Restart containers
docker-compose restart
```

### Logs & Debugging
```bash
# View all logs
docker-compose logs

# Follow logs in real-time
docker-compose logs -f app

# View specific container logs
docker-compose logs db

# View last 50 lines
docker-compose logs --tail=50
```

### Laravel Commands
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed database
docker-compose exec app php artisan db:seed

# Clear cache
docker-compose exec app php artisan cache:clear

# Access Laravel tinker (interactive shell)
docker-compose exec app php artisan tinker

# View routes
docker-compose exec app php artisan route:list
```

### Database Commands
```bash
# Access MySQL
docker-compose exec db mysql -u campusmart_user -p campusmart
# Enter password: campusmart_pass

# Backup database
docker-compose exec db mysqldump -u campusmart_user -p campusmart_pass campusmart > backup.sql

# Restore database
docker-compose exec db mysql -u campusmart_user -p campusmart_pass campusmart < backup.sql
```

---

## 🏗️ Docker Architecture Diagram

```
┌─────────────────────────────────────────────────────┐
│         Your Computer / Server                      │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │       Docker Host Machine                    │   │
│  │                                              │   │
│  │  ┌────────────────────────────────────────┐ │   │
│  │  │  campusmart_network (Docker Network)   │ │   │
│  │  │  ├─────────────────────────────────┐  │ │   │
│  │  │  │ campusmart_app (PHP-FPM)       │  │ │   │
│  │  │  │ • Port 8000:8000               │  │ │   │
│  │  │  │ • Laravel code runs here       │  │ │   │
│  │  │  │ • Connects to: db service      │  │ │   │
│  │  │  └─────────────────────────────────┘  │ │   │
│  │  │                                        │ │   │
│  │  │  ┌─────────────────────────────────┐  │ │   │
│  │  │  │ campusmart_db (MySQL 8.0)      │  │ │   │
│  │  │  │ • Port 3306:3306               │  │ │   │
│  │  │  │ • Database runs here           │  │ │   │
│  │  │  │ • Volume: db_data (persistent) │  │ │   │
│  │  │  └─────────────────────────────────┘  │ │   │
│  │  └────────────────────────────────────────┘ │   │
│  │                                              │   │
│  └─────────────────────────────────────────────┘   │
│                                                     │
│  Access Points:                                    │
│  • Browser: http://localhost:8000                  │
│  • MySQL Client: localhost:3306                    │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## 🔑 Key Features

### ✅ Automatic Setup
```bash
# Just run:
docker-compose up -d

# Automatically:
# ✓ Builds app image
# ✓ Pulls MySQL image
# ✓ Creates volumes
# ✓ Creates network
# ✓ Starts containers
# ✓ Runs migrations
# ✓ Seeds demo data
```

### ✅ Health Checks
```
App Health Check:
- Every 30 seconds
- Checks if Laravel responds to requests
- Auto-restarts if unhealthy

Database Health Check:
- Every 10 seconds
- Checks if MySQL is responsive
- Auto-restarts if unhealthy
```

### ✅ Persistent Storage
```
Database Volume:
- Data survives container restarts
- Data survives docker-compose down
- Only deleted with: docker-compose down -v
- Can be backed up easily
```

### ✅ Development-Friendly
```
Live Code Reloading:
- Edit files on your PC
- Changes visible immediately (no rebuild)
- PHP files auto-reload
- Database persists between restarts
```

---

## 🌍 Access Points

| Service | URL/Host | Port | Purpose |
|---------|----------|------|---------|
| **Web App** | http://localhost:8000 | 8000 | Browse CampusMart |
| **MySQL** | localhost | 3306 | Database connection |
| **MySQL User** | - | - | `campusmart_user` |
| **MySQL Pass** | - | - | `campusmart_pass` |
| **MySQL DB** | - | - | `campusmart` |

---

## 📊 Data Flow

```
User visits browser
        ↓
http://localhost:8000
        ↓
Docker Port 8000 (host machine)
        ↓
Routes to Port 8000 (inside app container)
        ↓
Laravel processes request
        ↓
Needs data? Queries database
        ↓
Connects to db service (Docker network)
        ↓
MySQL container processes query
        ↓
Response goes back to Laravel
        ↓
HTML returned to browser
```

---

## 🔧 Environment Variables Explained

### Key Variables in `.env`

```env
# Application Configuration
APP_NAME=CampusMart          # Application name
APP_ENV=local                # Environment (local/production)
APP_DEBUG=true               # Debug mode (set to false in production)
APP_URL=http://localhost:8000  # Application URL

# Database Configuration
DB_CONNECTION=mysql          # Database type
DB_HOST=db                   # Docker service name (NOT localhost!)
DB_PORT=3306                 # MySQL port
DB_DATABASE=campusmart       # Database name
DB_USERNAME=campusmart_user  # MySQL user
DB_PASSWORD=campusmart_pass  # MySQL password

# Cache & Session
CACHE_DRIVER=file            # Cache storage
SESSION_DRIVER=file          # Session storage
```

### Important Notes:
- **DB_HOST=db** (NOT localhost) - Inside Docker, use service name
- **DB_USERNAME** must match docker-compose.yml MYSQL_USER
- **DB_PASSWORD** must match docker-compose.yml MYSQL_PASSWORD

---

## 🐛 Troubleshooting

### Problem: Port 8000 Already in Use
```bash
# Solution 1: Stop other applications using port 8000
# Solution 2: Change port in docker-compose.yml
# Change "8000:8000" to "8001:8000"
# Then restart: docker-compose down && docker-compose up -d
```

### Problem: Container Won't Start
```bash
# Check logs
docker-compose logs app
docker-compose logs db

# Rebuild
docker-compose build --no-cache

# Restart
docker-compose down
docker-compose up -d
```

### Problem: Database Connection Error
```bash
# Check if database container is running
docker-compose ps db

# Wait for database to start
sleep 10
docker-compose exec app php artisan migrate
```

### Problem: Permission Error in Storage
```bash
# Fix permissions
docker-compose exec app chmod -R 755 storage
docker-compose exec app chmod -R 755 bootstrap/cache
```

---

## 📈 Performance Tips

### Optimize Docker
```bash
# Use specific Docker resources
# In Docker Desktop settings:
# - RAM: 4GB
# - CPU: 4 cores
# - Disk: 50GB
```

### Cache Optimization
```bash
# Clear Laravel cache
docker-compose exec app php artisan cache:clear

# Clear view cache
docker-compose exec app php artisan view:clear

# Optimize autoloader
docker-compose exec app composer dump-autoload -o
```

### Database Optimization
```bash
# Regular backups
docker-compose exec db mysqldump -u campusmart_user -p campusmart_pass campusmart > backup-$(date +%Y%m%d).sql

# Add indexes for frequently queried columns
docker-compose exec db mysql -u campusmart_user -p campusmart_pass campusmart
# SQL: CREATE INDEX idx_user_email ON users(email);
```

---

## 🔐 Security Notes

### Development (Current Setup)
✅ Good for local development
⚠️ NOT suitable for production
- APP_DEBUG=true shows sensitive info
- Default passwords used
- No SSL/HTTPS

### For Production
```env
# Change these:
APP_ENV=production
APP_DEBUG=false
MYSQL_ROOT_PASSWORD=<strong-password>
MYSQL_PASSWORD=<strong-password>

# Add SSL/HTTPS configuration
# Use proper secrets management
# Enable firewall rules
```

---

## 📚 Docker Best Practices

### 1. Always Use docker-compose
```bash
# ✅ Good - Uses docker-compose.yml
docker-compose up -d

# ❌ Bad - Manual container management
docker run -p 8000:8000 campusmart_app
```

### 2. Use Named Volumes
```bash
# ✅ Good - Persistent data
volumes:
  - db_data:/var/lib/mysql

# ❌ Bad - Data lost when container stops
# No volume definition
```

### 3. Set Health Checks
```bash
# ✅ Good - Auto-recovery
healthcheck:
  test: ["CMD", "curl", "-f", "http://localhost:8000/"]
  interval: 30s

# ❌ Bad - No health monitoring
# No healthcheck defined
```

### 4. Use .dockerignore
```bash
# ✅ Good - Smaller image, faster builds
node_modules
vendor
.git

# ❌ Bad - Larger image, slower builds
# Copy everything
```

---

## 🎯 Real-World Scenarios

### Scenario 1: Share with Classmates
```
1. Push to GitHub with docker-compose.yml, Dockerfile, .env.example
2. Classmate clones repo
3. Classmate runs: docker-compose up -d
4. App runs on their machine automatically!
```

### Scenario 2: Deploy to Server
```
1. Push to GitHub
2. Server pulls repo
3. Server runs: docker-compose up -d
4. App runs on server!
```

### Scenario 3: Database Backup & Restore
```
# Backup
docker-compose exec db mysqldump -u campusmart_user -p campusmart_pass campusmart > backup.sql

# Restore
docker-compose down -v
docker-compose up -d
docker-compose exec db mysql -u campusmart_user -p campusmart_pass campusmart < backup.sql
```

---

## ✅ Verification Checklist

After running `docker-compose up -d`:

- [ ] `docker-compose ps` shows 2 containers (app, db) - both "Up"
- [ ] Can access http://localhost:8000 in browser
- [ ] Can see home page or login page
- [ ] Can access MySQL on localhost:3306
- [ ] Database `campusmart` exists
- [ ] Demo data (users, products) are in database

---

## 🚀 Next Steps

1. **Customize Environment**
   - Edit `.env` with your settings
   - Change passwords for production

2. **Add More Services**
   - Redis for caching
   - Nginx for reverse proxy
   - PhpMyAdmin for GUI database management

3. **Deploy to Production**
   - Follow Docker production best practices
   - Use proper secrets management
   - Enable SSL/HTTPS

4. **Team Collaboration**
   - Share DOCKER_SETUP.md with team
   - Standardize development environment
   - Everyone runs same setup!

---

## 📞 Support

For detailed information, see:
- 📖 `DOCKER_SETUP.md` - Technical reference
- 🐳 Docker Docs: https://docs.docker.com
- 🎯 Laravel + Docker: https://laravel.com/docs

---

## Summary

✅ **What Docker Does:**
- Containerizes your application
- Ensures same setup on all computers
- Makes deployment easy
- Includes database and app together

✅ **What's Inside:**
- Dockerfile - Application setup
- docker-compose.yml - Services orchestration
- .dockerignore - Files to exclude
- .env.example - Configuration template
- DOCKER_SETUP.md - Technical docs

✅ **How to Use:**
1. `cp .env.example .env`
2. `docker-compose up -d`
3. Visit http://localhost:8000
4. Done! 🎉

**That's it! Your CampusMart is ready with Docker!**
