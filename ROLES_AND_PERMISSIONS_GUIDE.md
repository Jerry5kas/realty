# Roles and Permissions System - Implementation Guide

## Overview
This document explains the comprehensive roles and permissions system implemented in the Realty CRM application.

## System Architecture

### 1. Database Structure
- **roles** table: Stores role definitions
- **permissions** table: Stores permission definitions organized by modules
- **role_permission** pivot table: Links roles to permissions
- **user_role** pivot table: Links users to roles

### 2. Role Hierarchy

#### Admin (System Administrator)
- **Access**: Full system access
- **Permissions**: All permissions across all modules
- **Restrictions**: Can only be created via seeder, not through registration
- **Use Case**: System administrators who manage the entire platform

#### Owner (Property Owner)
- **Access**: Full property and content management
- **Permissions**: 
  - Properties: View, Create, Edit, Delete
  - Projects: View, Create, Edit, Delete
  - Transactions: View, Create, Edit, Delete
  - Events: View, Create, Edit, Delete
  - Builders, Cities, Amenities, Features, Property Types: Full access
  - Banners, Media Assets, Collections: Full access
  - Reports: View
- **Restrictions**: Cannot manage users or roles
- **Use Case**: Property owners who manage their listings and content

#### Agent (Real Estate Agent)
- **Access**: Limited property management and transaction handling
- **Permissions**:
  - Properties: View, Create, Edit (no delete)
  - Projects: View only
  - Transactions: View, Create, Edit
  - Events: View, Create, Edit
  - Master Data: View only (Builders, Cities, Amenities, Features, Property Types)
  - Media Assets: View, Create
  - Reports: View
- **Restrictions**: Cannot delete properties, cannot manage projects, users, or settings
- **Use Case**: Real estate agents who list properties and handle transactions

#### Viewer (Read-Only User)
- **Access**: Read-only access to all modules
- **Permissions**: All "view" permissions only
- **Restrictions**: Cannot create, edit, or delete anything
- **Use Case**: Stakeholders who need to view data without making changes

## Implementation Components

### 1. Middleware

#### CheckPermission Middleware
```php
// Usage in routes
Route::middleware('permission:properties.view')->group(function () {
    // Routes that require properties.view permission
});
```

#### CheckRole Middleware
```php
// Usage in routes
Route::middleware('role:admin,owner')->group(function () {
    // Routes that require admin OR owner role
});
```

### 2. Helper Functions

#### can($permission)
Check if the authenticated user has a specific permission:
```php
@if(can('properties.create'))
    <button>Create Property</button>
@endif
```

#### hasRole($role)
Check if the authenticated user has a specific role:
```php
@if(hasRole('admin'))
    <a href="{{ route('users.index') }}">Manage Users</a>
@endif
```

#### hasAnyRole($roles)
Check if the authenticated user has any of the given roles:
```php
@if(hasAnyRole(['admin', 'owner']))
    <button>Advanced Options</button>
@endif
```

### 3. Model Methods

#### User Model
```php
// Check permission
$user->hasPermission('properties.create');

// Check role
$user->hasRole('admin');

// Assign role
$user->assignRole('agent');

// Get all permissions
$permissions = $user->getAllPermissions();
```

#### Role Model
```php
// Give permission to role
$role->givePermissionTo('properties.create');

// Check if role has permission
$role->hasPermission('properties.view');

// Sync permissions
$role->syncPermissions([1, 2, 3]);
```

## Permission Modules

### Properties Module
- `properties.view` - View properties list and details
- `properties.create` - Create new properties
- `properties.edit` - Edit existing properties
- `properties.delete` - Delete properties

### Projects Module
- `projects.view` - View projects list and details
- `projects.create` - Create new projects
- `projects.edit` - Edit existing projects
- `projects.delete` - Delete projects

### Transactions Module
- `transactions.view` - View transactions
- `transactions.create` - Create transactions
- `transactions.edit` - Edit transactions
- `transactions.delete` - Delete transactions

### Events Module
- `events.view` - View calendar and events
- `events.create` - Create events
- `events.edit` - Edit events
- `events.delete` - Delete events

### Master Data Modules
- `cities.*` - City management
- `amenities.*` - Amenity management
- `features.*` - Feature management
- `property-types.*` - Property type management
- `builders.*` - Builder management

### Content Modules
- `banners.*` - Banner management
- `media-assets.*` - Media asset management
- `collections.*` - Collection management

### User Management Modules
- `users.*` - User management (Admin/Owner only)
- `roles.*` - Role and permission management (Admin only)

### Settings Module
- `settings.view` - View settings
- `settings.edit` - Edit settings (Admin only)

### Reports Module
- `reports.view` - View reports
- `reports.export` - Export reports

## Route Protection

All admin routes are protected with permission middleware:

```php
// Example: Properties routes
Route::middleware('permission:properties.view')->group(function () {
    Route::get('/properties', [PropertyController::class, 'index']);
    
    Route::get('/properties/create', [PropertyController::class, 'create'])
        ->middleware('permission:properties.create');
    
    Route::post('/properties', [PropertyController::class, 'store'])
        ->middleware('permission:properties.create');
    
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])
        ->middleware('permission:properties.edit');
    
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])
        ->middleware('permission:properties.delete');
});
```

## UI Restrictions

The admin sidebar automatically shows/hides menu items based on user permissions:

```blade
@if(can('properties.view'))
    <a href="{{ route('properties.index') }}">
        Properties
    </a>
@endif
```

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Seed Roles and Permissions
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

### 3. Autoload Helper Functions
```bash
composer dump-autoload
```

### 4. Assign Roles to Users
```php
// In your UserSeeder or manually
$user = User::find(1);
$user->assignRole('admin');
```

## Testing Permissions

### Test as Different Roles

1. **Admin User**: Can access everything
2. **Owner User**: Can manage properties and content, but not users
3. **Agent User**: Can create properties and transactions, but cannot delete
4. **Viewer User**: Can only view data, no create/edit/delete actions

### Verify Route Protection

Try accessing restricted routes:
- `/users` - Should be blocked for Agent and Viewer
- `/roles` - Should be blocked for everyone except Admin
- `/properties/create` - Should be blocked for Viewer

### Verify UI Restrictions

Check the sidebar:
- Admin: Sees all menu items
- Owner: Sees all except Users and Roles
- Agent: Sees limited menu items
- Viewer: Sees all menu items but no create/edit/delete buttons

## Best Practices

1. **Always check permissions in controllers**:
```php
public function create()
{
    if (!auth()->user()->hasPermission('properties.create')) {
        abort(403);
    }
    // ... rest of the code
}
```

2. **Use permission checks in views**:
```blade
@if(can('properties.edit'))
    <a href="{{ route('properties.edit', $property) }}">Edit</a>
@endif
```

3. **Group related permissions**:
```php
Route::middleware('permission:properties.view')->group(function () {
    // All routes that require viewing properties
});
```

4. **Use descriptive permission names**:
- Format: `module.action`
- Examples: `properties.create`, `users.delete`, `settings.edit`

## Troubleshooting

### Permission Denied Errors

If you get 403 errors:
1. Check if the user has the required role assigned
2. Verify the role has the required permission
3. Clear cache: `php artisan cache:clear`
4. Check middleware is properly registered in `bootstrap/app.php`

### Sidebar Not Showing Menu Items

1. Verify helper functions are loaded: `composer dump-autoload`
2. Check user has proper roles assigned
3. Verify permission slugs match in seeder and views

### Routes Not Protected

1. Ensure middleware is registered in `bootstrap/app.php`
2. Check route definitions include proper middleware
3. Verify permission slugs are correct

## Future Enhancements

1. **Dynamic Permission Management**: UI for creating custom permissions
2. **Permission Groups**: Group permissions for easier management
3. **Activity Logging**: Track permission-based actions
4. **Permission Caching**: Cache user permissions for better performance
5. **API Permissions**: Extend to API routes with token-based auth

## Support

For issues or questions about the roles and permissions system, please refer to:
- Laravel Documentation: https://laravel.com/docs/authorization
- This guide
- Your development team
