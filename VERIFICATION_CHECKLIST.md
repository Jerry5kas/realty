# Roles & Permissions - Verification Checklist

## Pre-Implementation Checklist

- [x] Middleware files created
  - [x] `app/Http/Middleware/CheckPermission.php`
  - [x] `app/Http/Middleware/CheckRole.php`
- [x] Helper file created
  - [x] `app/Helpers/PermissionHelper.php`
- [x] Middleware registered in `bootstrap/app.php`
- [x] Helper autoloaded in `composer.json`
- [x] Routes updated with permission middleware
- [x] Admin sidebar updated with permission checks
- [x] Documentation created

## Setup Checklist

### Step 1: Autoload
- [ ] Run `composer dump-autoload`
- [ ] Verify no errors in output

### Step 2: Database
- [ ] Run migrations (if not done): `php artisan migrate`
- [ ] Run seeder: `php artisan db:seed --class=RolesAndPermissionsSeeder`
- [ ] Verify roles table has 4 roles (admin, owner, agent, viewer)
- [ ] Verify permissions table has ~70+ permissions
- [ ] Verify role_permission pivot table has entries

### Step 3: User Assignment
- [ ] Assign at least one user to 'admin' role
- [ ] Assign at least one user to 'owner' role
- [ ] Assign at least one user to 'agent' role
- [ ] Assign at least one user to 'viewer' role

### Step 4: Cache Clear
- [ ] Run `php artisan cache:clear`
- [ ] Run `php artisan config:clear`
- [ ] Run `php artisan route:clear`
- [ ] Run `php artisan view:clear`

## Functional Testing Checklist

### Test 1: Admin User
Login as admin user and verify:
- [ ] Dashboard accessible
- [ ] All sidebar menu items visible
- [ ] Properties: Can view list
- [ ] Properties: Can create new
- [ ] Properties: Can edit existing
- [ ] Properties: Can delete
- [ ] Projects: Full CRUD access
- [ ] Cities: Full CRUD access
- [ ] Users: Can access user management
- [ ] Roles: Can access role management
- [ ] Settings: Can access and edit

### Test 2: Owner User
Login as owner user and verify:
- [ ] Dashboard accessible
- [ ] Properties: Full CRUD access
- [ ] Projects: Full CRUD access
- [ ] Transactions: Full CRUD access
- [ ] Events: Full CRUD access
- [ ] Master Data: Full CRUD access
- [ ] Content: Full CRUD access
- [ ] Users: NOT visible in sidebar
- [ ] Users: Cannot access /users route (403 error)
- [ ] Roles: NOT visible in sidebar
- [ ] Roles: Cannot access /roles route (403 error)
- [ ] Settings: NOT visible in sidebar

### Test 3: Agent User
Login as agent user and verify:
- [ ] Dashboard accessible
- [ ] Properties: Can view list
- [ ] Properties: Can create new
- [ ] Properties: Can edit existing
- [ ] Properties: Delete button NOT visible
- [ ] Properties: Cannot delete (403 if trying direct route)
- [ ] Projects: Can view only (no create/edit/delete)
- [ ] Transactions: Can create and edit
- [ ] Events: Can create and edit
- [ ] Master Data: View only
- [ ] Banners: NOT visible in sidebar
- [ ] Collections: NOT visible in sidebar
- [ ] Users: NOT visible in sidebar
- [ ] Roles: NOT visible in sidebar
- [ ] Settings: NOT visible in sidebar

### Test 4: Viewer User
Login as viewer user and verify:
- [ ] Dashboard accessible
- [ ] All modules visible in sidebar
- [ ] Properties: Can view list and details
- [ ] Properties: Create button NOT visible
- [ ] Properties: Edit button NOT visible
- [ ] Properties: Delete button NOT visible
- [ ] Projects: Can view only
- [ ] All other modules: View only
- [ ] Cannot access any create routes (403 error)
- [ ] Cannot access any edit routes (403 error)
- [ ] Cannot access any delete routes (403 error)

## Route Protection Testing

Test these routes directly (via browser or Postman):

### Admin-Only Routes
- [ ] `/users` - Only admin can access
- [ ] `/users/create` - Only admin can access
- [ ] `/roles` - Only admin can access
- [ ] `/roles/create` - Only admin can access
- [ ] `/theme-settings` - Only admin can access

### Owner/Admin Routes
- [ ] `/properties/create` - Admin and Owner can access
- [ ] `/projects/create` - Admin and Owner can access
- [ ] `/banners/create` - Admin and Owner can access

### Agent Restricted Routes
- [ ] `/properties/create` - Agent can access
- [ ] `/properties/{id}/edit` - Agent can access
- [ ] `/properties/{id}` DELETE - Agent gets 403
- [ ] `/projects/create` - Agent gets 403
- [ ] `/users` - Agent gets 403

### Viewer Restricted Routes
- [ ] `/properties/create` - Viewer gets 403
- [ ] `/properties/{id}/edit` - Viewer gets 403
- [ ] `/properties/{id}` DELETE - Viewer gets 403
- [ ] All create routes - Viewer gets 403
- [ ] All edit routes - Viewer gets 403
- [ ] All delete routes - Viewer gets 403

## UI Testing Checklist

### Sidebar Visibility
- [ ] Admin: Sees all menu items
- [ ] Owner: Doesn't see Users, Roles
- [ ] Agent: Sees limited menu items
- [ ] Viewer: Sees all menu items

### Button Visibility
Test on Properties index page:
- [ ] Admin: Sees "Create Property" button
- [ ] Owner: Sees "Create Property" button
- [ ] Agent: Sees "Create Property" button
- [ ] Viewer: Does NOT see "Create Property" button

Test on Properties show/detail page:
- [ ] Admin: Sees Edit and Delete buttons
- [ ] Owner: Sees Edit and Delete buttons
- [ ] Agent: Sees Edit button, NOT Delete button
- [ ] Viewer: Does NOT see Edit or Delete buttons

## Helper Function Testing

Test in Tinker:
```bash
php artisan tinker
```

```php
// Test can() helper
$user = App\Models\User::find(1); // Admin user
auth()->login($user);
can('properties.create'); // Should return true

// Test hasRole() helper
hasRole('admin'); // Should return true

// Test hasAnyRole() helper
hasAnyRole(['admin', 'owner']); // Should return true
```

## Database Verification

Run these queries to verify data:

```sql
-- Check roles
SELECT * FROM roles;
-- Should show: admin, owner, agent, viewer

-- Check permissions count
SELECT COUNT(*) FROM permissions;
-- Should show: ~70+ permissions

-- Check role-permission relationships
SELECT r.name, COUNT(p.id) as permission_count
FROM roles r
LEFT JOIN role_permission rp ON r.id = rp.role_id
LEFT JOIN permissions p ON rp.permission_id = p.id
GROUP BY r.id, r.name;
-- Admin should have most permissions
-- Viewer should have only view permissions

-- Check user-role relationships
SELECT u.name, u.email, r.name as role
FROM users u
LEFT JOIN user_role ur ON u.id = ur.user_id
LEFT JOIN roles r ON ur.role_id = r.id;
-- Should show users with their assigned roles
```

## Error Handling Testing

### Test 403 Errors
- [ ] Agent accessing /users returns 403 page
- [ ] Viewer accessing /properties/create returns 403 page
- [ ] Agent trying to delete property returns 403 page

### Test Middleware
- [ ] Unauthenticated user redirected to login
- [ ] Authenticated user without permission gets 403
- [ ] Authenticated user with permission can access

## Performance Testing

- [ ] Page load times acceptable with permission checks
- [ ] No N+1 queries from permission checks
- [ ] Sidebar renders quickly with permission checks

## Security Testing

- [ ] Cannot bypass permission checks via direct URL
- [ ] Cannot bypass permission checks via form submission
- [ ] Cannot access admin routes by guessing URLs
- [ ] Session properly maintains user permissions
- [ ] Logout properly clears permissions

## Documentation Review

- [ ] Read `ROLES_AND_PERMISSIONS_GUIDE.md`
- [ ] Read `SETUP_PERMISSIONS.md`
- [ ] Read `IMPLEMENTATION_SUMMARY.md`
- [ ] Read `PERMISSIONS_QUICK_REFERENCE.md`
- [ ] Understand role hierarchy
- [ ] Understand permission structure

## Final Verification

- [ ] All tests passed
- [ ] No console errors
- [ ] No PHP errors in logs
- [ ] All roles working as expected
- [ ] All permissions enforced
- [ ] UI properly restricted
- [ ] Routes properly protected
- [ ] Documentation complete

## Sign-Off

- [ ] Developer tested and verified
- [ ] Ready for production use
- [ ] Team trained on permission system
- [ ] Documentation shared with team

## Notes

Use this space to note any issues or observations:

```
Date: _______________
Tester: _______________

Issues Found:
1. 
2. 
3. 

Resolved:
1. 
2. 
3. 

Additional Notes:


```

## Support

If any checklist item fails:
1. Review the specific section in `ROLES_AND_PERMISSIONS_GUIDE.md`
2. Check `SETUP_PERMISSIONS.md` for setup steps
3. Review `PERMISSIONS_QUICK_REFERENCE.md` for syntax
4. Check Laravel logs: `storage/logs/laravel.log`
5. Clear all caches and try again
