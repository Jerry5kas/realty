# Quick Setup Guide - Roles & Permissions

## Step-by-Step Setup

### Step 1: Install Dependencies
```bash
composer dump-autoload
```

### Step 2: Run Migrations (if not already done)
```bash
php artisan migrate
```

### Step 3: Seed Roles and Permissions
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

### Step 4: Assign Roles to Existing Users

You have two options:

#### Option A: Via Tinker (Recommended for testing)
```bash
php artisan tinker
```

Then run:
```php
// Assign admin role to user ID 1
$user = App\Models\User::find(1);
$user->assignRole('admin');

// Assign owner role to user ID 2
$user = App\Models\User::find(2);
$user->assignRole('owner');

// Assign agent role to user ID 3
$user = App\Models\User::find(3);
$user->assignRole('agent');

// Assign viewer role to user ID 4
$user = App\Models\User::find(4);
$user->assignRole('viewer');
```

#### Option B: Via Database (Direct SQL)
```sql
-- Get role IDs first
SELECT id, slug FROM roles;

-- Assign admin role (role_id = 1) to user_id = 1
INSERT INTO user_role (user_id, role_id, created_at, updated_at) 
VALUES (1, 1, NOW(), NOW());

-- Assign owner role (role_id = 2) to user_id = 2
INSERT INTO user_role (user_id, role_id, created_at, updated_at) 
VALUES (2, 2, NOW(), NOW());
```

### Step 5: Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Step 6: Test the System

1. **Login as Admin**:
   - Should see all menu items
   - Can access /users, /roles, /settings
   - Can create, edit, delete everything

2. **Login as Owner**:
   - Should see most menu items except Users and Roles
   - Can manage properties, projects, content
   - Cannot access /users or /roles

3. **Login as Agent**:
   - Should see limited menu items
   - Can create properties and transactions
   - Cannot delete properties or access admin features

4. **Login as Viewer**:
   - Should see all menu items
   - Cannot see Create, Edit, or Delete buttons
   - All forms should be read-only

## Verification Checklist

- [ ] Middleware registered in `bootstrap/app.php`
- [ ] Helper functions loaded (run `composer dump-autoload`)
- [ ] Roles seeded in database
- [ ] Permissions seeded in database
- [ ] Role-permission relationships created
- [ ] At least one user assigned to each role
- [ ] Routes protected with permission middleware
- [ ] Sidebar shows/hides based on permissions
- [ ] 403 errors shown for unauthorized access

## Common Issues & Solutions

### Issue: "Permission denied" for all users
**Solution**: 
```bash
# Re-seed roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# Assign role to user
php artisan tinker
$user = App\Models\User::find(1);
$user->assignRole('admin');
```

### Issue: Sidebar not showing menu items
**Solution**:
```bash
# Reload helper functions
composer dump-autoload

# Clear all caches
php artisan cache:clear
php artisan view:clear
```

### Issue: Routes not protected
**Solution**:
Check that middleware is registered in `bootstrap/app.php`:
```php
$middleware->alias([
    'permission' => \App\Http\Middleware\CheckPermission::class,
    'role' => \App\Http\Middleware\CheckRole::class,
]);
```

### Issue: User has no permissions
**Solution**:
```bash
php artisan tinker

# Check user's roles
$user = App\Models\User::find(1);
$user->roles; // Should show assigned roles

# Check user's permissions
$user->getAllPermissions(); // Should show all permissions from roles

# If empty, assign a role
$user->assignRole('admin');
```

## Testing Different Roles

### Create Test Users for Each Role

```bash
php artisan tinker
```

```php
// Create Admin User
$admin = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
]);
$admin->assignRole('admin');

// Create Owner User
$owner = App\Models\User::create([
    'name' => 'Owner User',
    'email' => 'owner@example.com',
    'password' => bcrypt('password'),
]);
$owner->assignRole('owner');

// Create Agent User
$agent = App\Models\User::create([
    'name' => 'Agent User',
    'email' => 'agent@example.com',
    'password' => bcrypt('password'),
]);
$agent->assignRole('agent');

// Create Viewer User
$viewer = App\Models\User::create([
    'name' => 'Viewer User',
    'email' => 'viewer@example.com',
    'password' => bcrypt('password'),
]);
$viewer->assignRole('viewer');
```

## Quick Permission Check

Test if a user has specific permissions:

```bash
php artisan tinker
```

```php
$user = App\Models\User::find(1);

// Check single permission
$user->hasPermission('properties.create'); // true/false

// Check role
$user->hasRole('admin'); // true/false

// Get all permissions
$user->getAllPermissions()->pluck('slug');
```

## Next Steps

After setup is complete:

1. Review the `ROLES_AND_PERMISSIONS_GUIDE.md` for detailed documentation
2. Test each role by logging in with different users
3. Verify that unauthorized actions return 403 errors
4. Check that the sidebar correctly shows/hides menu items
5. Test create, edit, and delete operations for each role

## Support

If you encounter issues:
1. Check the `ROLES_AND_PERMISSIONS_GUIDE.md` troubleshooting section
2. Verify all steps in this guide were completed
3. Check Laravel logs: `storage/logs/laravel.log`
4. Clear all caches and try again
