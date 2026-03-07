# Permissions Quick Reference Card

## Helper Functions (Use in Blade Views)

```blade
{{-- Check single permission --}}
@if(can('properties.create'))
    <button>Create Property</button>
@endif

{{-- Check role --}}
@if(hasRole('admin'))
    <a href="/admin">Admin Panel</a>
@endif

{{-- Check multiple roles --}}
@if(hasAnyRole(['admin', 'owner']))
    <button>Advanced Options</button>
@endif
```

## Controller Methods

```php
// Check permission
if (auth()->user()->hasPermission('properties.create')) {
    // Allow action
}

// Check role
if (auth()->user()->hasRole('admin')) {
    // Allow action
}

// Get all user permissions
$permissions = auth()->user()->getAllPermissions();

// Assign role to user
$user->assignRole('agent');

// Remove role from user
$user->removeRole('agent');
```

## Route Protection

```php
// Single permission
Route::get('/properties', [PropertyController::class, 'index'])
    ->middleware('permission:properties.view');

// Permission group
Route::middleware('permission:properties.view')->group(function () {
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/properties/{property}', [PropertyController::class, 'show']);
});

// Role-based
Route::middleware('role:admin,owner')->group(function () {
    // Routes for admin or owner only
});
```

## Permission Slugs by Module

### Properties
- `properties.view`
- `properties.create`
- `properties.edit`
- `properties.delete`

### Projects
- `projects.view`
- `projects.create`
- `projects.edit`
- `projects.delete`

### Transactions
- `transactions.view`
- `transactions.create`
- `transactions.edit`
- `transactions.delete`

### Events
- `events.view`
- `events.create`
- `events.edit`
- `events.delete`

### Master Data
- `cities.*`
- `amenities.*`
- `features.*`
- `property-types.*`
- `builders.*`

### Content
- `banners.*`
- `media-assets.*`
- `collections.*`

### Admin
- `users.*`
- `roles.*`
- `settings.view`
- `settings.edit`

### Reports
- `reports.view`
- `reports.export`

## Role Capabilities Matrix

| Module | Admin | Owner | Agent | Viewer |
|--------|-------|-------|-------|--------|
| Properties | CRUD | CRUD | CRU | R |
| Projects | CRUD | CRUD | R | R |
| Transactions | CRUD | CRUD | CRU | R |
| Events | CRUD | CRUD | CRU | R |
| Cities | CRUD | CRUD | R | R |
| Amenities | CRUD | CRUD | R | R |
| Features | CRUD | CRUD | R | R |
| Property Types | CRUD | CRUD | R | R |
| Builders | CRUD | CRUD | R | R |
| Banners | CRUD | CRUD | - | R |
| Media Assets | CRUD | CRUD | CR | R |
| Collections | CRUD | CRUD | - | R |
| Users | CRUD | - | - | R |
| Roles | CRUD | - | - | R |
| Settings | RU | - | - | R |
| Reports | RX | R | R | R |

**Legend:**
- C = Create
- R = Read/View
- U = Update/Edit
- D = Delete
- X = Export
- \- = No Access

## Common Patterns

### Hide Create Button
```blade
@if(can('properties.create'))
    <a href="{{ route('properties.create') }}" class="btn btn-primary">
        Create Property
    </a>
@endif
```

### Hide Edit Button
```blade
@if(can('properties.edit'))
    <a href="{{ route('properties.edit', $property) }}" class="btn btn-secondary">
        Edit
    </a>
@endif
```

### Hide Delete Button
```blade
@if(can('properties.delete'))
    <form action="{{ route('properties.destroy', $property) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endif
```

### Admin-Only Section
```blade
@if(hasRole('admin'))
    <div class="admin-section">
        <!-- Admin-only content -->
    </div>
@endif
```

### Multiple Permission Check
```blade
@if(can('properties.edit') && can('properties.delete'))
    <div class="advanced-actions">
        <!-- Advanced actions -->
    </div>
@endif
```

## Tinker Commands

```bash
# Start tinker
php artisan tinker

# Get user
$user = App\Models\User::find(1);

# Assign role
$user->assignRole('admin');

# Check role
$user->hasRole('admin');

# Check permission
$user->hasPermission('properties.create');

# Get all permissions
$user->getAllPermissions()->pluck('slug');

# Get all roles
$user->roles->pluck('name');

# Remove role
$user->removeRole('agent');

# Sync roles (replace all)
$user->syncRoles(['admin']);
```

## Artisan Commands

```bash
# Seed roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reload autoload
composer dump-autoload
```

## Debugging

### Check User Permissions
```php
// In controller or tinker
$user = auth()->user();
dd($user->getAllPermissions()->pluck('slug'));
```

### Check User Roles
```php
$user = auth()->user();
dd($user->roles->pluck('name'));
```

### Check Role Permissions
```php
$role = App\Models\Role::where('slug', 'agent')->first();
dd($role->permissions->pluck('slug'));
```

### Test Permission
```php
$user = auth()->user();
dd($user->hasPermission('properties.create')); // true or false
```

## Error Handling

### 403 Forbidden
If you get a 403 error:
1. Check user has required role
2. Check role has required permission
3. Clear cache
4. Verify middleware is registered

### Permission Not Found
If permission check fails:
1. Verify permission slug is correct
2. Check permission exists in database
3. Ensure role has the permission
4. Run seeder again if needed

## Best Practices

1. ✅ Always check permissions in views
2. ✅ Use middleware for route protection
3. ✅ Use descriptive permission names
4. ✅ Group related permissions
5. ✅ Test with different roles
6. ❌ Don't hardcode role names
7. ❌ Don't skip permission checks
8. ❌ Don't expose admin routes

## Quick Setup

```bash
# 1. Autoload helpers
composer dump-autoload

# 2. Seed roles and permissions
php artisan db:seed --class=RolesAndPermissionsSeeder

# 3. Assign role to user (via tinker)
php artisan tinker
$user = App\Models\User::find(1);
$user->assignRole('admin');

# 4. Clear caches
php artisan cache:clear

# 5. Test!
```

## Support

- Full Guide: `ROLES_AND_PERMISSIONS_GUIDE.md`
- Setup: `SETUP_PERMISSIONS.md`
- Summary: `IMPLEMENTATION_SUMMARY.md`
