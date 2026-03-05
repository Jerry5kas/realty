# Users vs Clients - Understanding the Difference

## Users (System Access)
**Location**: Users & CRM → Users

Users are people who have login access to the Realty CRM system. They can log in and use the admin panel.

### User Roles:
1. **Admin** - System administrator (only created via seeder)
2. **Owner** - Property owner with full management access
3. **Agent** - Real estate agent managing properties
4. **Viewer** - Read-only access to view data

### User Features:
- Login credentials (email/password)
- Role-based permissions
- Access to admin panel
- Can perform actions based on their role

### Where to Find:
- Sidebar: "Users & CRM" → "Users"
- Route: `/users`
- Can create/edit/delete system users
- Assign roles and permissions

---

## Clients (CRM Feature - Coming Soon)
**Location**: Users & CRM → Clients (marked as "Soon")

Clients are customers, leads, or prospects who are interested in buying/renting properties. They do NOT have login access to the system.

### Client Types:
- Buyers
- Renters
- Leads
- Prospects

### Client Features:
- Contact information
- Property interests
- Transaction history
- Communication logs
- No login access
- Managed by Agents/Owners

### Where to Find:
- Sidebar: "Users & CRM" → "Clients" (coming soon)
- Will be used for CRM functionality
- Track customer interactions
- Manage leads and conversions

---

## Quick Comparison

| Feature | Users | Clients |
|---------|-------|---------|
| Login Access | ✅ Yes | ❌ No |
| Admin Panel | ✅ Yes | ❌ No |
| Roles/Permissions | ✅ Yes | ❌ No |
| Can Create Properties | ✅ Yes (based on role) | ❌ No |
| Tracked in CRM | ❌ No | ✅ Yes |
| Contact Management | ❌ No | ✅ Yes |
| Transaction History | ❌ No | ✅ Yes |

---

## Example Scenarios

### User Example:
- John is an **Agent** (User)
- He logs in to the system
- He can create properties, manage transactions
- He has email: john@realty.com and password

### Client Example:
- Sarah is a **Client** (Customer)
- She is interested in buying a property
- John (the Agent) manages her in the CRM
- She does NOT have login access
- Her contact info is stored in the Clients module

---

## Current Status

✅ **Users Module**: Fully functional
- Create/edit/delete users
- Assign roles (Admin, Owner, Agent, Viewer)
- Manage permissions

🔜 **Clients Module**: Coming Soon
- Will be built for CRM functionality
- Track customer leads
- Manage property interests
- Communication history

---

## Summary

- **Users** = People who work in the system (staff, agents, admins)
- **Clients** = Customers who are managed by the system (buyers, renters, leads)

Think of it like:
- **Users** = Your team
- **Clients** = Your customers
