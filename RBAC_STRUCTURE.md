# RBAC (Role-Based Access Control) Structure

## Overview
Clean and simple role-based access control system for Realty CRM.

## Role Hierarchy

### 1. Admin (System Administrator)
- **Access**: Only via seeder/database - CANNOT register
- **Email**: admin@realty.com
- **Password**: 12345678
- **Permissions**: Full system access to ALL features including:
  - All property management modules
  - Users and Roles management
  - Owners module (CRM)
  - Settings and configuration
  - Everything in the system
- **Description**: System administrator with complete control over all modules, settings, users, and roles

### 2. Owner (Property Owner)
- **Access**: Can register and login
- **Email**: owner@realty.com (demo)
- **Password**: 12345678
- **Permissions**: Full property management access
  - Properties (view, create, edit, delete)
  - Projects (view, create, edit, delete)
  - Transactions (view, create, edit, delete)
  - Events (view, create, edit, delete)
  - Builders (view, create, edit, delete)
  - Cities (view, create, edit, delete)
  - Amenities (view, create, edit, delete)
  - Features (view, create, edit, delete)
  - Property Types (view, create, edit, delete)
  - Banners (view, create, edit, delete)
  - Media Assets (view, create, edit, delete)
  - Owners Module (view, create, edit, delete) - CRM feature
  - Reports (view, export)
- **Description**: Property owner with full access to manage properties, projects, transactions, and content

### 3. Agent (Real Estate Agent)
- **Access**: Can register and login
- **Email**: agent@realty.com (demo)
- **Password**: 12345678
- **Permissions**: Property and client management
  - Properties (view, create, edit)
  - Projects (view only)
  - Transactions (view, create, edit)
  - Events (view, create, edit)
  - Builders (view only)
  - Cities (view only)
  - Amenities (view only)
  - Features (view only)
  - Property Types (view only)
  - Media Assets (view, create)
  - Owners Module (view only) - CRM feature
  - Reports (view only)
- **Description**: Real estate agent who can manage properties, create transactions, and schedule events

### 4. Viewer (Property Viewer)
- **Access**: Can register and login
- **Email**: viewer@realty.com (demo)
- **Password**: 12345678
- **Permissions**: Read-only access
  - All modules (view only)
- **Description**: Read-only access to view properties and listings

## Registration Rules

### Can Register:
- Owner
- Agent
- Viewer

### Cannot Register (Admin Only):
- Admin (created via database seeder only)

## Permission Structure

Permissions are organized by module with CRUD operations:
- `module.view` - View/read access
- `module.create` - Create new records
- `module.edit` - Edit existing records
- `module.delete` - Delete records

### Modules:
- properties
- projects
- transactions
- events
- builders
- cities
- amenities
- features
- property-types
- banners
- media-assets
- owners (CRM module - coming soon)
- users
- roles
- settings
- reports

## Admin Panel Features

Admin can create additional custom roles via the admin panel with:
- Custom role name and description
- Granular permission selection
- Module-based permission grouping

## Database Structure

### Tables:
- `roles` - Role definitions
- `permissions` - Permission definitions
- `role_permission` - Role-permission relationships
- `user_role` - User-role relationships (many-to-many)

### User Model Methods:
- `hasRole($role)` - Check if user has specific role
- `hasAnyRole($roles)` - Check if user has any of given roles
- `hasPermission($permission)` - Check if user has specific permission
- `assignRole($role)` - Assign role to user
- `removeRole($role)` - Remove role from user
- `getAllPermissions()` - Get all permissions from user's roles

## Seeding

Run seeders in order:
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=UserSeeder
```

Or seed all:
```bash
php artisan db:seed
```

## Usage in Controllers

```php
// Check role
if (auth()->user()->hasRole('admin')) {
    // Admin only code
}

// Check permission
if (auth()->user()->hasPermission('properties.create')) {
    // Allow property creation
}

// Check multiple roles
if (auth()->user()->hasAnyRole(['admin', 'owner'])) {
    // Admin or Owner code
}
```

## Usage in Blade Views

```blade
@if(auth()->user()->hasRole('admin'))
    <!-- Admin only content -->
@endif

@if(auth()->user()->hasPermission('properties.create'))
    <a href="{{ route('properties.create') }}">Create Property</a>
@endif
```

## Notes

- Clean separation: Admin cannot register, others can
- No role override or confusion
- Clear permission hierarchy
- Admin can create custom management roles as needed
- All demo users use password: `12345678`
