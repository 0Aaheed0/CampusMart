# 🔐 Google OAuth Setup & Troubleshooting Guide

## Issue Resolution

### Problem: "Missing required parameter: client_id"

**Root Cause:** `GOOGLE_CLIENT_ID` not configured in `.env` file

**Solution:** Follow steps below to get your Google OAuth credentials

---

## Step 1: Get Google OAuth Credentials

### A. Create a Google Cloud Project
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Sign in with your Google account
3. Click **"Select a Project"** dropdown (top)
4. Click **"NEW PROJECT"**
5. Name: `CampusMart`
6. Click **CREATE**
7. Wait for project creation (1-2 minutes)

### B. Enable Google+ API
1. In Google Cloud Console, go to **APIs & Services**
2. Click **"ENABLE APIS AND SERVICES"** (or search box at top)
3. Search for **"Google+ API"**
4. Click on it
5. Click **ENABLE**
6. Wait for enablement

### C. Create OAuth Credentials
1. Go to **APIs & Services → Credentials** (left sidebar)
2. Click **"+ CREATE CREDENTIALS"** button (top)
3. Select **"OAuth client ID"**
4. If prompted: Create consent screen first
   - Click **"CONFIGURE CONSENT SCREEN"**
   - Choose **"External"** (User Type)
   - Click **CREATE**
   - Fill in:
     - App name: `CampusMart`
     - User support email: `your@email.com`
     - Developer contact: `your@email.com`
   - Click **SAVE AND CONTINUE** (skip scopes and contacts)
   - Click **BACK TO DASHBOARD**

5. Now create OAuth client ID:
   - Click **"+ CREATE CREDENTIALS"** again
   - Select **"OAuth client ID"**
   - Application type: **Web application**
   - Name: `CampusMart Web Client`
   - Authorized JavaScript origins:
     - Add: `http://localhost`
     - Add: `http://localhost:8000`
     - Add: `http://127.0.0.1`
     - Add: `http://127.0.0.1:8000`
   - Authorized redirect URIs:
     - Add: `http://localhost/auth/google-callback`
     - Add: `http://localhost:8000/auth/google-callback`
     - Add: `http://127.0.0.1/auth/google-callback`
     - Add: `http://127.0.0.1:8000/auth/google-callback`
   - Click **CREATE**
6. You'll see a popup with your credentials:
   - **Client ID** (looks like: `123456789.apps.googleusercontent.com`)
   - **Client Secret** (keep this secret!)
   - Click **CLOSE** or download JSON file

---

## Step 2: Add Credentials to `.env`

1. Open `.env` file in your project root
2. Find or add these lines:
   ```env
   GOOGLE_CLIENT_ID=your_client_id_here
   GOOGLE_CLIENT_SECRET=your_client_secret_here
   ```
3. Replace with your actual values:
   - Example: `GOOGLE_CLIENT_ID=12345678901-abc123def456ghi789.apps.googleusercontent.com`
   - Example: `GOOGLE_CLIENT_SECRET=GOCSPX-AbCdEfGhIjKlMnOpQrStUvWxYz`

4. Save `.env` file

---

## Step 3: Restart Your Application

1. If using Docker:
   ```bash
   docker-compose down
   docker-compose up -d
   ```

2. If running locally:
   - Stop any running Laravel server (Ctrl+C)
   - Run: `php artisan serve`

3. Clear config cache:
   ```bash
   php artisan config:clear
   ```

---

## Step 4: Test Google Login

1. Go to your app: `http://localhost:8000`
2. Click **"Login"** or **"Sign Up"**
3. Click **"Sign in/up with Google"** button
4. You should see:
   - ✅ Account picker showing your Google accounts
   - ✅ Ability to select an account
   - ✅ Redirected to dashboard after selection

---

## Common Issues & Solutions

### Issue 1: Still Getting "Missing required parameter: client_id"
**Fix:**
```bash
# Clear config cache
php artisan config:clear

# Clear app cache
php artisan cache:clear

# Restart server
```

### Issue 2: "Unauthorized redirect_uri"
**Fix:** The redirect URL doesn't match what you added in Google Console
- Go back to Google Cloud Console
- APIs & Services → Credentials
- Edit your OAuth client
- Add more authorized redirect URIs (including your domain)

### Issue 3: "Origin mismatch" Error
**Fix:** You need to add your exact domain to JavaScript origins
- Google Console → Credentials → Edit your client
- Add your exact URL to "Authorized JavaScript origins"
- Examples to add:
  - `http://localhost:8000`
  - `http://yourdomain.com`
  - `https://yourdomain.com`

### Issue 4: Accounts Not Showing
**Fix:** Make sure you removed `auto_select: true`
- Check `resources/views/auth/login.blade.php` line ~314
- Should NOT have `auto_select: true`
- Already fixed in latest code

---

## Verifying It's Working

### ✅ Signs of Success
1. Click "Sign in with Google" button
2. Google account picker popup appears
3. Can select from multiple accounts
4. After selection, redirected to dashboard
5. User logged in with selected email

### ❌ Signs of Failure
1. Blank screen / nothing happens
2. Error popup with "client_id" mentioned
3. "Origin mismatch" error
4. Accounts don't show (auto-select kicks in)

---

## Production Deployment

When deploying to production:

1. Update `.env` with production domain
2. Add production URL to Google Console:
   - Go to Credentials
   - Edit OAuth client
   - Add under "Authorized JavaScript origins":
     - `https://yourdomain.com`
   - Add under "Authorized redirect URIs":
     - `https://yourdomain.com/auth/google-callback`

3. Verify on production that it works

---

## For Help

If you still have issues after following this guide:

1. Check Google Cloud Console:
   - APIs & Services → Credentials → View your OAuth client
   - Verify Client ID and Secret in your `.env`

2. Check browser console for errors:
   - Right-click → Inspect → Console tab
   - Look for error messages

3. Check Laravel logs:
   - `storage/logs/laravel.log`
   - Look for authentication errors

---

## Quick Reference

| Item | Location |
|------|----------|
| Client ID | `.env` - `GOOGLE_CLIENT_ID` |
| Client Secret | `.env` - `GOOGLE_CLIENT_SECRET` |
| Config file | `config/google.php` |
| Login view | `resources/views/auth/login.blade.php` |
| Register view | `resources/views/auth/register.blade.php` |
| OAuth controller | `app/Http/Controllers/Auth/GoogleOneTapController.php` |
