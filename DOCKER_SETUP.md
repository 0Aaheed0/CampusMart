# CampusMart Docker Setup Guide

## Overview
This Docker setup provides a complete containerized development environment for CampusMart, a campus marketplace platform built with Laravel. The setup includes:
- **PHP 8.2 FPM** - Application server
- **MySQL 8.0** - Database server
- **Persistent volumes** - Database data persistence
- **Health checks** - Automatic container monitoring
- **Environment configuration** - Easy setup on any machine

## Prerequisites
- Docker (version 20.10 or higher)
- Docker Compose (version 1.29 or higher)
- 4GB RAM minimum recommended
- 5GB disk space for dependencies and database

## Quick Start

### 1. Setup Environment File
```bash
# Copy the example environment file
cp .env.example .env

# Generate Laravel application key
docker-compose exec app php artisan key:generate
```

### 2. Start Docker Containers
```bash
# Build and start all services
docker-compose up -d

# View logs
docker-compose logs -f app
```

### 3. Initialize Database
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed demo data
docker-compose exec app php artisan db:seed
```

### 4. Access Application
- **Web Application**: http://localhost:8000
- **Database**: localhost:3306
  - Username: `campusmart_user`
  - Password: `campusmart_pass`
  - Database: `campusmart`

## Docker Services

### App Service (PHP-FPM + Laravel)
- **Container Name**: campusmart_app
- **Port**: 8000 (http://localhost:8000)
- **Working Directory**: /var/www/html
- **Health Check**: Enabled (checks every 30s)
- **Volumes**:
  - Entire project directory (for live code changes)
  - Storage logs (for log persistence)

#### Key Features:
- Automatic migrations on startup
- Automatic database seeding on startup
- Development mode enabled (APP_DEBUG=true)
- File-based caching and sessions
- Laravel Artisan CLI available

### Database Service (MySQL 8.0)
- **Container Name**: campusmart_db
- **Port**: 3306
- **Root Password**: root123
- **Username**: campusmart_user
- **Password**: campusmart_pass
- **Database**: campusmart
- **Health Check**: Enabled (checks every 10s)
- **Volume**: db_data (persistent storage)

#### Key Features:
- MySQL native password authentication
- Persistent data storage
- Automatic backup capability
- Health monitoring

## Common Commands

### View Running Containers
```bash
docker-compose ps
```

### View Logs
```bash
# View all logs
docker-compose logs

# View app logs only
docker-compose logs app

# View database logs only
docker-compose logs db

# Follow logs in real-time
docker-compose logs -f app
```

### Laravel Artisan Commands
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed database
docker-compose exec app php artisan db:seed

# Run specific seeder
docker-compose exec app php artisan db:seed --class=UserSeeder

# Clear cache
docker-compose exec app php artisan cache:clear

# Generate API documentation
docker-compose exec app php artisan tinker

# Create new controller
docker-compose exec app php artisan make:controller NameController
```

### Database Access
```bash
# Connect to MySQL via CLI
docker-compose exec db mysql -u campusmart_user -p campusmart

# Connect as root
docker-compose exec db mysql -u root -p root123 campusmart

# Backup database
docker-compose exec db mysqldump -u campusmart_user -p campusmart_pass campusmart > backup.sql

# Restore database
docker-compose exec db mysql -u campusmart_user -p campusmart_pass campusmart < backup.sql
```

### Compose Operations
```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Stop and remove volumes (WARNING: deletes data!)
docker-compose down -v

# Rebuild containers after Dockerfile changes
docker-compose build --no-cache

# Rebuild and start
docker-compose up -d --build

# View container resource usage
docker stats campusmart_app campusmart_db
```

## Environment Configuration

### Key Environment Variables
See `.env.example` for all available variables:

```env
APP_NAME=CampusMart
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=campusmart
DB_USERNAME=campusmart_user
DB_PASSWORD=campusmart_pass
```

### Database Configuration in Docker
- **Host**: `db` (Docker service name, not localhost)
- **Port**: `3306`
- **Root Password**: `root123`
- **Application User**: `campusmart_user` / `campusmart_pass`

**Note**: When connecting from inside a container, use service name `db` instead of `localhost`.

## Troubleshooting

### Port Already in Use
```bash
# If port 8000 or 3306 is already in use, modify docker-compose.yml
# Change "8000:8000" to "8001:8000" for example
# Change "3306:3306" to "3307:3306"

# Then restart
docker-compose down
docker-compose up -d
```

### Container Won't Start
```bash
# Check logs
docker-compose logs app
docker-compose logs db

# Rebuild containers
docker-compose build --no-cache

# Restart
docker-compose down
docker-compose up -d
```

### Database Connection Error
```bash
# Ensure database is ready
docker-compose logs db

# Wait a few seconds for MySQL to fully start
sleep 10
docker-compose exec app php artisan migrate
```

### Permission Issues
```bash
# Fix storage permissions
docker-compose exec app chmod -R 755 storage
docker-compose exec app chmod -R 755 bootstrap/cache
```

### Memory Issues
If containers are crashing, increase Docker memory limits in Docker Desktop settings to 4GB+.

## Production Deployment

### Before Deploying
1. Change `APP_ENV` from `local` to `production`
2. Set `APP_DEBUG` to `false`
3. Generate a strong `APP_KEY`
4. Update database credentials
5. Set strong MySQL passwords (not root123)
6. Enable SSL/HTTPS
7. Add proper logging configuration

### Production Docker Compose
```yaml
environment:
  APP_ENV: production
  APP_DEBUG: false
  DB_PASSWORD: <strong-password>
```

## File Structure
```
CampusMart/
├── Dockerfile              # PHP-FPM container configuration
├── docker-compose.yml      # Docker services orchestration
├── .dockerignore           # Files to exclude from Docker build
├── .env.example            # Environment variable template
├── DOCKER_SETUP.md         # This file
├── app/                    # Laravel application code
├── database/               # Migrations and seeders
├── storage/                # Logs and cache
├── vendor/                 # Composer dependencies (in container)
└── ...
```

## Security Recommendations

1. **Change Default Passwords**
   - Update `MYSQL_ROOT_PASSWORD` in docker-compose.yml
   - Update `MYSQL_PASSWORD` in docker-compose.yml

2. **Set Strong APP_KEY**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

3. **Use Environment Secrets**
   - Never commit .env file to git
   - Use `.env.example` for reference
   - Use Docker secrets in production

4. **Network Isolation**
   - Use isolated Docker networks (already configured)
   - Don't expose unnecessary ports

5. **Regular Backups**
   ```bash
   docker-compose exec db mysqldump -u campusmart_user -p campusmart_pass campusmart > backup-$(date +%Y%m%d).sql
   ```

## Performance Tips

1. **Use Named Volumes**
   - Already configured for database persistence
   - Faster than bind mounts on some systems

2. **Limit Logging**
   - Set `LOG_LEVEL=warning` in production
   - Clear logs regularly

3. **Cache Optimization**
   - Use Redis for caching in production
   - Can be added to docker-compose.yml

4. **Database Optimization**
   - Regular backups
   - Index frequently queried columns
   - Optimize slow queries

## Health Checks

Both services include health checks:

### App Health Check
- Checks if Laravel is responsive
- Runs every 30 seconds
- Retries 3 times before marking unhealthy

### Database Health Check
- Checks if MySQL is responding
- Runs every 10 seconds
- Retries 5 times before marking unhealthy

View health status:
```bash
docker-compose ps
```

## Development Workflow

1. **Code Changes**
   - Edit files directly (mounted volume)
   - Changes reflect immediately (no rebuild needed)

2. **Dependency Changes**
   ```bash
   docker-compose exec app composer require package/name
   ```

3. **Database Changes**
   ```bash
   docker-compose exec app php artisan make:migration create_table_name
   docker-compose exec app php artisan migrate
   ```

4. **Testing**
   ```bash
   docker-compose exec app php artisan test
   docker-compose exec app ./vendor/bin/phpunit
   ```

## Support & Documentation

- **Laravel Documentation**: https://laravel.com/docs
- **Docker Documentation**: https://docs.docker.com
- **MySQL Documentation**: https://dev.mysql.com/doc/

## License
CampusMart - Campus Marketplace Platform
