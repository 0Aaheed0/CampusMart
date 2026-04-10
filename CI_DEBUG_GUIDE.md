# 🔧 CI Failures - Diagnosis & Fix Guide

## What's Happening

Your PR is failing CI checks:
- ❌ **PHP Lint & Code Style** - Failing after 11s
- ❌ **Tests** - Failing after 39s

---

## 🚨 Common Causes

### Cause 1: PHP Linting/Code Style Issues
**Symptoms:**
- Laravel Pint shows code style violations
- Spaces/tabs inconsistency
- Formatting issues

**Most Common Issues:**
- Trailing whitespace in PHP files
- Incorrect indentation (spaces vs tabs)
- Missing space after `if`, `for`, etc.
- Unused variables/imports

### Cause 2: Test Failures
**Symptoms:**
- PHPUnit tests failing
- Database connection errors
- Validation errors
- Missing migrations

**Most Common Issues:**
- Database setup problems in CI
- Missing test data setup
- Failing assertions
- Configuration issues

---

## ✅ How to Fix (FAST)

### Step 1: Fix Code Style Locally
```bash
cd "D:\CampusMart\cse-31000\CampusMart-develop"

# Fix all code style issues automatically
composer run lint

# Check if it passes now
composer run lint:check
```

### Step 2: Run Tests Locally
```bash
# Clear cache first
php artisan config:clear
php artisan cache:clear

# Run all tests
php artisan test

# Run specific test file if needed
php artisan test tests/Feature/ReportTest.php
```

### Step 3: View CI Error Details on GitHub

**To see what's failing:**

1. Go to your GitHub repository
2. Click **"Pull Requests"** tab
3. Click your PR (to issue-39)
4. Scroll down to **"Checks"** section
5. Click **"Code Quality & Linting"** or **"Tests"**
6. Click **"Details"**
7. You'll see the exact error message

**Screenshot navigation:**
```
GitHub Repo → Pull Requests 
  → Your PR #39 
    → Checks section (scroll down)
      → Click failing check "Details"
        → See full error log
```

---

## 🐛 Debugging Each Failure

### If Code Quality Fails

**See the exact errors:**
```
GitHub PR → Checks → Code Quality & Linting → Details
Scroll to see:
  "Run Laravel Pint" section with error messages
  or
  "Run PHPStan" section with analysis issues
```

**Common fixes:**

1. **Trailing whitespace:**
   ```bash
   # Files have extra spaces at end of lines
   # Pint can auto-fix this
   composer run lint
   ```

2. **Indentation issues:**
   ```bash
   # Check modified files have consistent indentation
   # Pint can auto-fix this
   composer run lint
   ```

3. **Style violations:**
   ```bash
   # Check for missing spaces around operators, etc.
   # Pint can auto-fix this
   composer run lint
   ```

### If Tests Fail

**See the exact errors:**
```
GitHub PR → Checks → Run Tests → Details
Scroll to see:
  "Run tests" section with:
    - Which test failed
    - Error message
    - Line number
```

**Common fixes:**

1. **Test data not found:**
   ```bash
   # Maybe test expects specific database state
   php artisan migrate:fresh --seed
   php artisan test
   ```

2. **Database connection:**
   ```bash
   # Check .env DB settings
   # Verify MySQL running
   php artisan migrate
   php artisan test
   ```

3. **Assertion failed:**
   ```bash
   # Check what the test expects
   # Your code might not match expectation
   # Fix the code or the test
   php artisan test
   ```

---

## 🎯 Quick Fix Workflow

### If You Just Want It Working Fast:

```bash
# 1. Fix all code style issues
composer run lint

# 2. Clear cache
php artisan config:clear

# 3. Run tests locally
php artisan test

# 4. Push again
git add .
git commit -m "Fix: CI linting and test issues"
git push origin issue-39

# 5. Go to GitHub PR and wait for CI to re-run
```

That's it! CI should pass now.

---

## 📋 Detailed Error Messages

### To Get Full Error Messages:

**From CI (GitHub Actions):**
1. PR → Checks → Failing check → Details
2. Scroll down to find:
   - "Run Laravel Pint" or "Run PHPStan"
   - "Run tests"
3. Look for red error messages

**From Local (Terminal):**
```bash
# Fix linting
composer run lint:check

# Run tests
php artisan test --verbose
```

---

## 🔍 What Modified Files Might Have Issues

Check these files since they were recently changed:
- `config/google.php` - New file, might have linting issues
- `resources/views/auth/login.blade.php` - Blade view changes
- `resources/views/auth/register.blade.php` - Blade view changes
- `resources/views/products/report.blade.php` - JavaScript changes
- `.github/workflows/tests.yml` - YAML syntax issues?
- `.github/workflows/lint.yml` - YAML syntax issues?

---

## 🚀 Fast Resolution Path

1. **Immediately run locally:**
   ```bash
   composer run lint
   php artisan test
   ```

2. **Fix any errors shown**

3. **Push again:**
   ```bash
   git add .
   git commit -m "Fix: CI issues"
   git push origin issue-39
   ```

4. **Wait for CI to re-run** (2-5 minutes)

5. **Check PR again** → Checks should now show ✅

---

## ⚠️ If Still Failing

If errors persist after local fixes:

1. **Get full error from GitHub:**
   - PR → Checks → Details → Scroll down to see full error

2. **Search for the error message** in your code

3. **Fix the specific issue**

4. **Test locally again**

5. **Push once more**

---

## 💡 Pro Tips

**Tip 1: Don't Push Until Tests Pass Locally**
```bash
composer run lint:check  # Always pass this
php artisan test         # Always pass this
# THEN git push
```

**Tip 2: Clear Cache Before Testing**
```bash
php artisan config:clear
php artisan cache:clear
php artisan test
```

**Tip 3: Read Error Messages Carefully**
- They tell you exactly what's wrong
- Line numbers and file paths
- What was expected vs what happened

**Tip 4: Fix One Error at a Time**
- Don't try to fix everything at once
- Fix, test, commit, repeat

---

## 📞 If You're Stuck

**Option 1: Show me the error**
- Go to PR → Checks → Details
- Copy the full error message
- Tell me exactly what it says

**Option 2: Run this locally and share output**
```bash
composer run lint:check
php artisan test
```

**Option 3: Check GitHub Actions directly**
- GitHub → Actions tab
- Click the failing workflow
- Click the failed job
- Scroll to see all error details

---

## ✅ Goal: Get CI to Pass

Once all CI checks show ✅ green:
1. You can safely merge to develop
2. Then merge develop to main
3. Code is production-ready

**Let's get your PR passing! 🚀**
