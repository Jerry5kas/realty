# Roles & Permissions System - Visual Diagrams

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                     USER AUTHENTICATION                      │
│                    (Laravel Auth System)                     │
└──────────────────────┬──────────────────────────────────────┘
                       │
                       ▼
┌─────────────────────────────────────────────────────────────┐
│                    MIDDLEWARE LAYER                          │
│  ┌──────────────────┐         ┌──────────────────┐         │
│  │ CheckPermission  │         │   CheckRole      │         │
│  │   Middleware     │         │   Middleware     │         │
│  └──────────────────┘         └──────────────────┘         │
└──────────────────────┬──────────────────────────────────────┘
                       │
                       ▼
┌─────────────────────────────────────────────────────────────┐
│                   PERMISSION CHECK                           │
│         User → Roles → Permissions → Access                  │
└──────────────────────┬──────────────────────────────────────┘
                       │
        ┌──────────────┴──────────────┐
        │                             │
        ▼                             ▼
┌──────────────┐              ┌──────────────┐
│   GRANTED    │              │   DENIED     │
│  (200 OK)    │              │  (403 Error) │
└──────────────┘              └──────────────┘
```

## Role Hierarchy

```
                    ┌─────────────┐
                    │    ADMIN    │
                    │  (All Access)│
                    └──────┬──────┘
                           │
            ┌──────────────┼──────────────┐
            │              │              │
            ▼              ▼              ▼
    ┌──────────┐   ┌──────────┐   ┌──────────┐
    │  OWNER   │   │  AGENT   │   │  VIEWER  │
    │(Full Mgmt)│   │(Limited) │   │(Read Only)│
    └──────────┘   └──────────┘   └──────────┘
```

## Permission Flow

```
┌──────────────────────────────────────────────────────────────┐
│                        USER REQUEST                           │
│              GET /properties/create                           │
└────────────────────────┬─────────────────────────────────────┘
                         │
                         ▼
┌──────────────────────────────────────────────────────────────┐
│                   ROUTE MIDDLEWARE                            │
│         middleware('permission:properties.create')            │
└────────────────────────┬─────────────────────────────────────┘
                         │
                         ▼
┌──────────────────────────────────────────────────────────────┐
│                  CHECK USER ROLES                             │
│              $user->roles->pluck('id')                        │
└────────────────────────┬─────────────────────────────────────┘
                         │
                         ▼
┌──────────────────────────────────────────────────────────────┐
│              CHECK ROLE PERMISSIONS                           │
│      $role->permissions->contains('slug', 'properties.create')│
└────────────────────────┬─────────────────────────────────────┘
                         │
            ┌────────────┴────────────┐
            │                         │
            ▼                         ▼
    ┌──────────────┐          ┌──────────────┐
    │  HAS PERM    │          │  NO PERM     │
    │  Allow       │          │  Deny (403)  │
    └──────────────┘          └──────────────┘
```

## Database Relationships

```
┌──────────────┐         ┌──────────────┐         ┌──────────────┐
│    USERS     │         │  USER_ROLE   │         │    ROLES     │
│              │         │  (Pivot)     │         │              │
│  - id        │◄───────►│  - user_id   │◄───────►│  - id        │
│  - name      │         │  - role_id   │         │  - name      │
│  - email     │         │              │         │  - slug      │
└──────────────┘         └──────────────┘         └──────┬───────┘
                                                          │
                                                          │
                         ┌──────────────┐                │
                         │ROLE_PERMISSION│               │
                         │  (Pivot)     │                │
                         │  - role_id   │◄───────────────┘
                         │  - perm_id   │
                         └──────┬───────┘
                                │
                                ▼
                         ┌──────────────┐
                         │ PERMISSIONS  │
                         │              │
                         │  - id        │
                         │  - name      │
                         │  - slug      │
                         │  - module    │
                         └──────────────┘
```

## Module Permission Structure

```
PROPERTIES MODULE
├── properties.view      (All roles)
├── properties.create    (Admin, Owner, Agent)
├── properties.edit      (Admin, Owner, Agent)
└── properties.delete    (Admin, Owner only)

PROJECTS MODULE
├── projects.view        (All roles)
├── projects.create      (Admin, Owner only)
├── projects.edit        (Admin, Owner only)
└── projects.delete      (Admin, Owner only)

USERS MODULE
├── users.view           (Admin only)
├── users.create         (Admin only)
├── users.edit           (Admin only)
└── users.delete         (Admin only)

SETTINGS MODULE
├── settings.view        (Admin only)
└── settings.edit        (Admin only)
```

## Role Permission Matrix

```
┌─────────────────┬───────┬───────┬───────┬────────┐
│    MODULE       │ ADMIN │ OWNER │ AGENT │ VIEWER │
├─────────────────┼───────┼───────┼───────┼────────┤
│ Properties      │ CRUD  │ CRUD  │ CRU   │   R    │
│ Projects        │ CRUD  │ CRUD  │  R    │   R    │
│ Transactions    │ CRUD  │ CRUD  │ CRU   │   R    │
│ Events          │ CRUD  │ CRUD  │ CRU   │   R    │
│ Cities          │ CRUD  │ CRUD  │  R    │   R    │
│ Amenities       │ CRUD  │ CRUD  │  R    │   R    │
│ Features        │ CRUD  │ CRUD  │  R    │   R    │
│ Property Types  │ CRUD  │ CRUD  │  R    │   R    │
│ Builders        │ CRUD  │ CRUD  │  R    │   R    │
│ Banners         │ CRUD  │ CRUD  │  -    │   R    │
│ Media Assets    │ CRUD  │ CRUD  │ CR    │   R    │
│ Collections     │ CRUD  │ CRUD  │  -    │   R    │
│ Users           │ CRUD  │  -    │  -    │   R    │
│ Roles           │ CRUD  │  -    │  -    │   R    │
│ Settings        │  RU   │  -    │  -    │   R    │
│ Reports         │  RX   │  R    │  R    │   R    │
└─────────────────┴───────┴───────┴───────┴────────┘

Legend:
C = Create  │  R = Read  │  U = Update  │  D = Delete
X = Export  │  - = No Access
```

## Request Flow Example

### Scenario: Agent tries to create a property

```
1. USER ACTION
   ┌─────────────────────────────────┐
   │ Agent clicks "Create Property"  │
   └────────────┬────────────────────┘
                │
                ▼
2. ROUTE
   ┌─────────────────────────────────┐
   │ GET /properties/create          │
   │ middleware('permission:         │
   │   properties.create')           │
   └────────────┬────────────────────┘
                │
                ▼
3. MIDDLEWARE CHECK
   ┌─────────────────────────────────┐
   │ CheckPermission::handle()       │
   │ - Get authenticated user        │
   │ - Check hasPermission()         │
   └────────────┬────────────────────┘
                │
                ▼
4. USER MODEL
   ┌─────────────────────────────────┐
   │ User::hasPermission()           │
   │ - Get user's roles              │
   │ - Check each role's permissions │
   └────────────┬────────────────────┘
                │
                ▼
5. ROLE MODEL
   ┌─────────────────────────────────┐
   │ Role::hasPermission()           │
   │ - Check if 'agent' role has     │
   │   'properties.create' permission│
   └────────────┬────────────────────┘
                │
                ▼
6. RESULT
   ┌─────────────────────────────────┐
   │ ✅ Permission Found              │
   │ → Allow access                  │
   │ → Show create form              │
   └─────────────────────────────────┘
```

### Scenario: Agent tries to delete a property

```
1. USER ACTION
   ┌─────────────────────────────────┐
   │ Agent tries DELETE request      │
   └────────────┬────────────────────┘
                │
                ▼
2. ROUTE
   ┌─────────────────────────────────┐
   │ DELETE /properties/{id}         │
   │ middleware('permission:         │
   │   properties.delete')           │
   └────────────┬────────────────────┘
                │
                ▼
3. MIDDLEWARE CHECK
   ┌─────────────────────────────────┐
   │ CheckPermission::handle()       │
   │ - Get authenticated user        │
   │ - Check hasPermission()         │
   └────────────┬────────────────────┘
                │
                ▼
4. USER MODEL
   ┌─────────────────────────────────┐
   │ User::hasPermission()           │
   │ - Get user's roles (agent)      │
   │ - Check role's permissions      │
   └────────────┬────────────────────┘
                │
                ▼
5. ROLE MODEL
   ┌─────────────────────────────────┐
   │ Role::hasPermission()           │
   │ - Check if 'agent' role has     │
   │   'properties.delete' permission│
   └────────────┬────────────────────┘
                │
                ▼
6. RESULT
   ┌─────────────────────────────────┐
   │ ❌ Permission NOT Found          │
   │ → Deny access                   │
   │ → Return 403 Forbidden          │
   └─────────────────────────────────┘
```

## UI Permission Check Flow

```
BLADE VIEW RENDERING
┌─────────────────────────────────────┐
│ @if(can('properties.create'))       │
└────────────┬────────────────────────┘
             │
             ▼
┌─────────────────────────────────────┐
│ Helper Function: can()              │
│ - Check if user is authenticated    │
│ - Call auth()->user()->hasPermission│
└────────────┬────────────────────────┘
             │
             ▼
┌─────────────────────────────────────┐
│ User::hasPermission()               │
│ - Loop through user's roles         │
│ - Check each role's permissions     │
└────────────┬────────────────────────┘
             │
    ┌────────┴────────┐
    │                 │
    ▼                 ▼
┌─────────┐      ┌─────────┐
│  TRUE   │      │  FALSE  │
│ Show    │      │  Hide   │
│ Button  │      │ Button  │
└─────────┘      └─────────┘
```

## Sidebar Navigation Logic

```
ADMIN SIDEBAR
┌──────────────────────────────────────┐
│ @if(can('properties.view'))          │
│   <a href="/properties">Properties</a>│
│ @endif                                │
│                                       │
│ @if(can('users.view'))                │
│   <a href="/users">Users</a>          │
│ @endif                                │
│                                       │
│ @if(can('settings.view'))             │
│   <a href="/settings">Settings</a>    │
│ @endif                                │
└──────────────────────────────────────┘

RESULT FOR DIFFERENT ROLES:
┌─────────┬────────────┬──────────┬──────────┐
│  Menu   │   Admin    │  Owner   │  Agent   │
├─────────┼────────────┼──────────┼──────────┤
│Properties│ ✅ Visible │ ✅ Visible│ ✅ Visible│
│ Users   │ ✅ Visible │ ❌ Hidden │ ❌ Hidden │
│Settings │ ✅ Visible │ ❌ Hidden │ ❌ Hidden │
└─────────┴────────────┴──────────┴──────────┘
```

## Complete System Flow

```
┌─────────────┐
│    USER     │
│   LOGIN     │
└──────┬──────┘
       │
       ▼
┌─────────────────────────────────────┐
│  AUTHENTICATION                     │
│  - Verify credentials               │
│  - Load user with roles             │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  LOAD PERMISSIONS                   │
│  - Get user's roles                 │
│  - Get each role's permissions      │
│  - Cache in session                 │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  RENDER UI                          │
│  - Show/hide menu items             │
│  - Show/hide buttons                │
│  - Based on permissions             │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  USER CLICKS ACTION                 │
│  - Navigate to route                │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  MIDDLEWARE CHECK                   │
│  - Verify permission                │
│  - Allow or deny                    │
└──────┬──────────────────────────────┘
       │
   ┌───┴───┐
   │       │
   ▼       ▼
┌─────┐ ┌─────┐
│ALLOW│ │DENY │
│200  │ │403  │
└─────┘ └─────┘
```

## Legend

```
┌─────────────────────────────────────┐
│ SYMBOLS USED IN DIAGRAMS            │
├─────────────────────────────────────┤
│ ┌──┐  Box/Container                 │
│ │  │  Process/Component             │
│ └──┘                                │
│                                     │
│  →   Flow direction                 │
│  ▼   Downward flow                  │
│  ◄   Backward flow                  │
│                                     │
│  ✅   Success/Allowed                │
│  ❌   Failure/Denied                 │
│  -   Not applicable                 │
│                                     │
│ CRUD = Create, Read, Update, Delete │
│  C   = Create only                  │
│  R   = Read only                    │
│  U   = Update only                  │
│  D   = Delete only                  │
│  X   = Export                       │
└─────────────────────────────────────┘
```
