# Design Document: Builders/Developers Management

## Overview

This design document outlines the technical implementation for the Builders/Developers Management feature in the real estate CRM system. The feature centralizes builder/developer information by creating a dedicated `builders` table and establishing proper relationships with properties and projects, replacing the current scattered text fields approach.

The implementation follows the existing architectural patterns used in the Cities, Amenities, Features, and Property Types modules, ensuring consistency across the codebase. The design includes database schema, migrations (including data migration from existing projects), Eloquent models with relationships, controllers following RESTful conventions, Blade views using existing components, and route definitions.

### Key Design Decisions

1. **Slug Generation**: Automatic slug generation from company name with uniqueness enforcement through numeric suffixes
2. **Soft Deletes**: Implement soft deletes to preserve historical data and prevent accidental data loss
3. **Referential Integrity**: Use foreign key constraints with cascade rules to maintain data consistency
4. **Migration Strategy**: Two-phase migration approach - first create builders from existing project data, then update schema
5. **Status Management**: Active/inactive status to control visibility without data deletion
6. **Featured Flag**: Boolean flag for highlighting premium builders in listings and dropdowns

## Architecture

### System Components

The feature follows Laravel's MVC architecture with these components:

- **Model Layer**: `Builder` Eloquent model with relationships to `Property` and `Project` models
- **Controller Layer**: `BuilderController` handling CRUD operations and bulk actions
- **View Layer**: Blade templates for index, create, edit, and show pages
- **Migration Layer**: Database migrations for schema creation and data migration
- **Route Layer**: RESTful routes with resource routing

### Integration Points

1. **Property Management**: Optional builder association via `builder_id` foreign key
2. **Project Management**: Required builder association replacing text fields
3. **Admin Navigation**: New menu item in the admin sidebar
4. **Shared Components**: Reuse of data-table, form-input, imagekit-uploader components

## Components and Interfaces

### Database Schema

#### Builders Table

```sql
CREATE TABLE builders (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    company_name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    logo_url VARCHAR(500) NULL,
    description TEXT NULL,
    contact_person_name VARCHAR(255) NULL,
    phone VARCHAR(20) NULL,
    email VARCHAR(255) NULL,
    website VARCHAR(500) NULL,
    rera_registration_number VARCHAR(100) NULL,
    established_year YEAR NULL,
    total_projects_completed INT UNSIGNED NULL DEFAULT 0,
    facebook_url VARCHAR(500) NULL,
    instagram_url VARCHAR(500) NULL,
    linkedin_url VARCHAR(500) NULL,
    twitter_url VARCHAR(500) NULL,
    office_address TEXT NULL,
    city_id BIGINT UNSIGNED NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    is_featured BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    
    INDEX idx_status (status),
    INDEX idx_featured (is_featured),
    INDEX idx_city (city_id),
    FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE SET NULL
);
```

#### Properties Table Updates

```sql
ALTER TABLE properties 
ADD COLUMN builder_id BIGINT UNSIGNED NULL AFTER project_id,
ADD CONSTRAINT fk_properties_builder 
    FOREIGN KEY (builder_id) REFERENCES builders(id) ON DELETE SET NULL;

CREATE INDEX idx_properties_builder ON properties(builder_id);
```

#### Projects Table Updates

```sql
-- Add new column
ALTER TABLE projects 
ADD COLUMN builder_id BIGINT UNSIGNED NULL AFTER city_id;

-- After data migration, make it required and drop old columns
ALTER TABLE projects 
MODIFY COLUMN builder_id BIGINT UNSIGNED NOT NULL,
ADD CONSTRAINT fk_projects_builder 
    FOREIGN KEY (builder_id) REFERENCES builders(id) ON DELETE RESTRICT,
DROP COLUMN developer_name,
DROP COLUMN developer_description,
DROP COLUMN developer_logo;

CREATE INDEX idx_projects_builder ON projects(builder_id);
```

### Model Relationships

#### Builder Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Builder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'slug',
        'logo_url',
        'description',
        'contact_person_name',
        'phone',
        'email',
        'website',
        'rera_registration_number',
        'established_year',
        'total_projects_completed',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'office_address',
        'city_id',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'total_projects_completed' => 'integer',
        'established_year' => 'integer',
    ];

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->company_name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->company_name, 0, 2));
    }

    // Methods
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
```

#### Property Model Updates

```php
// Add to Property model
public function builder()
{
    return $this->belongsTo(Builder::class);
}
```

#### Project Model Updates

```php
// Add to Project model
public function builder()
{
    return $this->belongsTo(Builder::class);
}
```

### Controller Structure

#### BuilderController

```php
<?php

namespace App\Http\Controllers;

use App\Models\Builder;
use App\Models\City;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function index(Request $request)
    {
        $query = Builder::with('city');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_person_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('city', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === 'yes');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $builders = $query->orderBy('company_name')->paginate(20)->withQueryString();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('builders.index', compact('builders', 'cities'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('builders.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'contact_person_name' => 'nullable|string|max:255',
            'phone' => ['nullable', 'regex:/^[\d\s\-\+]+$/'],
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'rera_registration_number' => 'nullable|alpha_num|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'total_projects_completed' => 'nullable|integer|min:0',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'office_address' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Builder::generateUniqueSlug($request->company_name);
        $validated['is_featured'] = $request->has('is_featured');

        Builder::create($validated);

        return redirect()->route('builders.index')
            ->with('success', 'Builder created successfully.');
    }

    public function show(Builder $builder)
    {
        $builder->load(['city', 'properties', 'projects']);
        return view('builders.show', compact('builder'));
    }

    public function edit(Builder $builder)
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('builders.edit', compact('builder', 'cities'));
    }

    public function update(Request $request, Builder $builder)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'contact_person_name' => 'nullable|string|max:255',
            'phone' => ['nullable', 'regex:/^[\d\s\-\+]+$/'],
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'rera_registration_number' => 'nullable|alpha_num|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'total_projects_completed' => 'nullable|integer|min:0',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'office_address' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        if ($request->company_name !== $builder->company_name) {
            $validated['slug'] = Builder::generateUniqueSlug($request->company_name);
        }

        $validated['is_featured'] = $request->has('is_featured');

        $builder->update($validated);

        return redirect()->route('builders.index')
            ->with('success', 'Builder updated successfully.');
    }

    public function destroy(Builder $builder)
    {
        // Check if builder has associated properties or projects
        if ($builder->properties()->count() > 0 || $builder->projects()->count() > 0) {
            return redirect()->route('builders.index')
                ->with('error', 'Cannot delete builder. It is associated with ' . 
                    $builder->properties()->count() . ' properties and ' . 
                    $builder->projects()->count() . ' projects.');
        }

        $builder->delete();
        
        return redirect()->route('builders.index')
            ->with('success', 'Builder deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:builders,id'
        ]);

        $builders = Builder::whereIn('id', $request->ids)->get();
        $cannotDelete = [];
        $deleted = 0;

        foreach ($builders as $builder) {
            if ($builder->properties()->count() > 0 || $builder->projects()->count() > 0) {
                $cannotDelete[] = $builder->company_name;
            } else {
                $builder->delete();
                $deleted++;
            }
        }

        if (count($cannotDelete) > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Could not delete ' . count($cannotDelete) . ' builders as they are associated with properties or projects: ' . implode(', ', $cannotDelete)
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => $deleted . ' builders deleted successfully.'
        ]);
    }
}
```

### View Structure

#### Index View (builders/index.blade.php)

Following the pattern from cities/index.blade.php and features/index.blade.php:

- Data table component with columns: logo, company name, contact person, phone, email, city, status, actions
- Search bar for filtering
- Status and featured filters
- Bulk delete functionality
- Create new builder button
- Pagination

#### Create View (builders/create.blade.php)

Following the pattern from cities/create.blade.php:

- Form with all builder fields
- ImageKit uploader component for logo
- City dropdown
- Status radio buttons (active/inactive)
- Featured checkbox
- Social media URL inputs
- Validation error display
- Cancel and submit buttons

#### Edit View (builders/edit.blade.php)

Similar to create view but pre-filled with existing data:

- Same form structure as create
- Pre-populated fields
- Update button instead of create

#### Show View (builders/show.blade.php)

Following the pattern from projects/show.blade.php:

- Builder information display with logo
- Contact details section
- Social media links
- Associated properties list
- Associated projects list
- Edit and delete action buttons

### Route Definitions

```php
// In routes/web.php

Route::middleware(['auth'])->group(function () {
    // Builder routes
    Route::resource('builders', BuilderController::class);
    Route::post('builders/bulk-delete', [BuilderController::class, 'bulkDelete'])
        ->name('builders.bulk-delete');
});
```

### Component Reuse

The following existing components will be reused:

1. **data-table**: For builders list with search, filters, and pagination
2. **form-input**: For text inputs (company name, contact person, phone, email, etc.)
3. **form-textarea**: For description and office address
4. **imagekit-uploader**: For logo upload
5. **confirm-modal**: For delete confirmations

## Data Models

### Builder Entity

```
Builder {
    id: bigint (PK)
    company_name: string(255) [required]
    slug: string(255) [unique, required]
    logo_url: string(500) [nullable]
    description: text [nullable]
    contact_person_name: string(255) [nullable]
    phone: string(20) [nullable]
    email: string(255) [nullable]
    website: string(500) [nullable]
    rera_registration_number: string(100) [nullable]
    established_year: year [nullable]
    total_projects_completed: int [nullable, default: 0]
    facebook_url: string(500) [nullable]
    instagram_url: string(500) [nullable]
    linkedin_url: string(500) [nullable]
    twitter_url: string(500) [nullable]
    office_address: text [nullable]
    city_id: bigint (FK) [nullable]
    status: enum('active', 'inactive') [required, default: 'active']
    is_featured: boolean [required, default: false]
    created_at: timestamp
    updated_at: timestamp
    deleted_at: timestamp [nullable]
}
```

### Relationships Diagram

```
Builder (1) ----< (N) Property
Builder (1) ----< (N) Project
City (1) ----< (N) Builder
```

### Validation Rules

```php
[
    'company_name' => 'required|string|max:255',
    'logo_url' => 'nullable|string|max:500',
    'description' => 'nullable|string',
    'contact_person_name' => 'nullable|string|max:255',
    'phone' => 'nullable|regex:/^[\d\s\-\+]+$/',
    'email' => 'nullable|email|max:255',
    'website' => 'nullable|url|max:500',
    'rera_registration_number' => 'nullable|alpha_num|max:100',
    'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
    'total_projects_completed' => 'nullable|integer|min:0',
    'facebook_url' => 'nullable|url|max:500',
    'instagram_url' => 'nullable|url|max:500',
    'linkedin_url' => 'nullable|url|max:500',
    'twitter_url' => 'nullable|url|max:500',
    'office_address' => 'nullable|string',
    'city_id' => 'nullable|exists:cities,id',
    'status' => 'required|in:active,inactive',
    'is_featured' => 'boolean',
]
```


## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system-essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property Reflection

After analyzing all acceptance criteria, I identified the following redundancies:

- Properties 2.2 and 9.1 both test multi-field search functionality - combined into one property
- Properties 3.3 and 4.4 both test builder dropdown population with active builders sorted alphabetically - combined into one property
- Properties 3.6 and 4.7 both test filtering by builder - kept separate as they apply to different entities (properties vs projects)
- Multiple UI rendering tests (examples) don't need separate properties as they test specific page layouts

### Property 1: Unique Slug Generation

*For any* company name, when creating a builder, the system should generate a URL-friendly slug that is unique across all builders.

**Validates: Requirements 1.2, 1.3**

### Property 2: Company Name Validation

*For any* builder creation or update, the system should reject empty company names and company names exceeding 255 characters.

**Validates: Requirements 1.4**

### Property 3: Email Format Validation

*For any* email address provided during builder creation or update, the system should accept only valid email formats and reject invalid formats.

**Validates: Requirements 1.5**

### Property 4: Phone Number Format Validation

*For any* phone number provided during builder creation or update, the system should accept only strings containing digits, spaces, hyphens, and plus signs, and reject strings with other characters.

**Validates: Requirements 1.6**

### Property 5: RERA Number Validation

*For any* RERA registration number provided during builder creation or update, the system should accept only alphanumeric characters and reject strings with special characters.

**Validates: Requirements 1.7**

### Property 6: Established Year Range Validation

*For any* established year provided during builder creation or update, the system should accept only four-digit years between 1800 and the current year, and reject years outside this range.

**Validates: Requirements 1.8**

### Property 7: Non-Negative Projects Validation

*For any* total projects completed value provided during builder creation or update, the system should accept only non-negative integers and reject negative values.

**Validates: Requirements 1.9**

### Property 8: Status Enum Validation

*For any* status value provided during builder creation or update, the system should accept only "active" or "inactive" and reject any other values.

**Validates: Requirements 1.10**

### Property 9: Default Status Value

*For any* builder created without explicitly specifying a status, the system should set the status to "active" by default.

**Validates: Requirements 1.11**

### Property 10: Default Featured Flag

*For any* builder created without explicitly specifying the featured flag, the system should set is_featured to false by default.

**Validates: Requirements 1.12**

### Property 11: Multi-Field Search

*For any* search query on the builders list, the system should return builders where the query matches any part of the company name, contact person name, email, phone, or city name.

**Validates: Requirements 2.2, 9.1**

### Property 12: Pagination Consistency

*For any* builders list with more items than the page size, the system should display the correct subset of builders on each page and maintain consistent total counts across pages.

**Validates: Requirements 2.3**

### Property 13: Builder Creation Persistence

*For any* valid builder data submitted through the create form, the system should persist the builder to the database with all provided fields correctly stored.

**Validates: Requirements 2.5**

### Property 14: Builder Update Persistence

*For any* valid builder data submitted through the edit form, the system should update the existing builder record with all modified fields correctly stored.

**Validates: Requirements 2.7**

### Property 15: Builder Deletion

*For any* builder without associated properties or projects, when deletion is confirmed, the system should remove the builder from the database.

**Validates: Requirements 2.9**

### Property 16: Bulk Deletion

*For any* set of selected builders without associated properties or projects, the bulk delete operation should remove all selected builders from the database.

**Validates: Requirements 2.10**

### Property 17: Deletion Protection

*For any* builder that has associated properties or projects, the system should prevent deletion and display an error message indicating the builder is in use.

**Validates: Requirements 2.11**

### Property 18: Active Builders in Dropdowns

*For any* builder dropdown in property or project forms, the system should display only builders with status "active", sorted alphabetically by company name, and exclude inactive builders.

**Validates: Requirements 3.3, 4.4**

### Property 19: Optional Property-Builder Association

*For any* property created or updated without selecting a builder, the system should successfully save the property with a null builder_id.

**Validates: Requirements 3.4**

### Property 20: Property Filtering by Builder

*For any* builder filter applied to the properties list, the system should return only properties where builder_id matches the selected builder.

**Validates: Requirements 3.6**

### Property 21: Required Project-Builder Association

*For any* project creation or update submitted without selecting a builder, the system should reject the submission and display a validation error.

**Validates: Requirements 4.5**

### Property 22: Project Filtering by Builder

*For any* builder filter applied to the projects list, the system should return only projects where builder_id matches the selected builder.

**Validates: Requirements 4.7**

### Property 23: Builder Properties Display

*For any* builder detail page, the system should display all properties where the property's builder_id matches the builder's id.

**Validates: Requirements 5.3**

### Property 24: Builder Projects Display

*For any* builder detail page, the system should display all projects where the project's builder_id matches the builder's id.

**Validates: Requirements 5.4**

### Property 25: Logo File Type Validation

*For any* file uploaded as a builder logo, the system should accept only files with extensions jpg, jpeg, png, gif, or webp, and reject files with other extensions.

**Validates: Requirements 6.2**

### Property 26: Logo File Size Validation

*For any* file uploaded as a builder logo, the system should accept only files with size less than or equal to 5MB, and reject larger files.

**Validates: Requirements 6.3**

### Property 27: Logo URL Persistence

*For any* logo uploaded during builder creation or update, the system should store the logo URL in the builder's logo_url field.

**Validates: Requirements 6.4**

### Property 28: Logo Placeholder Display

*For any* builder without a logo_url, the system should display a placeholder image or the company's initials in all views where the logo would appear.

**Validates: Requirements 6.6**

### Property 29: Featured Flag Persistence

*For any* builder where the featured toggle is checked during creation or update, the system should set is_featured to true; when unchecked, it should set is_featured to false.

**Validates: Requirements 7.2**

### Property 30: Featured Builders Filter

*For any* featured filter applied to the builders list, the system should return only builders where is_featured matches the filter value (true for "yes", false for "no").

**Validates: Requirements 7.3**

### Property 31: Featured Builders Sorting

*For any* builder dropdown that implements featured sorting, featured builders (is_featured = true) should appear before non-featured builders in the list.

**Validates: Requirements 7.4**

### Property 32: Inactive Builders Exclusion from Dropdowns

*For any* builder with status "inactive", the builder should not appear in dropdown selections on property and project forms.

**Validates: Requirements 8.2**

### Property 33: Inactive Builder Data Preservation

*For any* builder set to inactive status, all existing properties and projects associated with that builder should continue to display the builder's information.

**Validates: Requirements 8.3**

### Property 34: Status Filter

*For any* status filter applied to the builders list, the system should return only builders where the status field matches the selected filter value.

**Validates: Requirements 8.4**

### Property 35: Combined Filters

*For any* combination of search query, status filter, featured filter, and city filter applied simultaneously, the system should return only builders that match all applied criteria.

**Validates: Requirements 9.4**

### Property 36: Filtered Results Count

*For any* set of filters applied to the builders list, the displayed count should equal the number of builders matching all filter criteria.

**Validates: Requirements 9.5**

### Property 37: Unique Developer Extraction

*For any* set of existing projects with developer names, the migration script should create exactly one builder record for each unique developer name.

**Validates: Requirements 10.1, 10.2**

### Property 38: Migration Description Mapping

*For any* project with a non-null developer_description, the migration script should copy that description to the corresponding builder's description field.

**Validates: Requirements 10.3**

### Property 39: Migration Logo Mapping

*For any* project with a non-null developer_logo, the migration script should copy that logo URL to the corresponding builder's logo_url field.

**Validates: Requirements 10.4**

### Property 40: Migration Foreign Key Assignment

*For any* project after migration, the project's builder_id should reference the builder record that was created from that project's developer_name.

**Validates: Requirements 10.5**

### Property 41: Migration Data Preservation

*For any* project before and after migration, all project fields except developer_name, developer_description, and developer_logo should remain unchanged.

**Validates: Requirements 10.6**

### Property 42: Migration Rollback on Error

*For any* migration execution that encounters an error, the system should roll back all database changes and return the database to its pre-migration state.

**Validates: Requirements 10.7**

### Property 43: Social Media URL Validation

*For any* social media URL (Facebook, Instagram, LinkedIn, Twitter) provided during builder creation or update, the system should accept only valid URL formats and reject invalid formats.

**Validates: Requirements 11.2**


## Error Handling

### Validation Errors

**Input Validation Failures**:
- Display field-specific error messages below each form input
- Highlight invalid fields with red borders
- Preserve user input on validation failure
- Return HTTP 422 status with JSON error details for AJAX requests

**Example Error Messages**:
```
- "The company name field is required."
- "The company name may not be greater than 255 characters."
- "The email must be a valid email address."
- "The phone format is invalid."
- "The established year must be between 1800 and 2024."
- "The RERA registration number may only contain letters and numbers."
```

### Database Errors

**Foreign Key Constraint Violations**:
- Catch deletion attempts on builders with associated records
- Display user-friendly error: "Cannot delete builder. It is associated with X properties and Y projects."
- Log technical details for debugging
- Return HTTP 422 status

**Unique Constraint Violations**:
- Handle slug uniqueness through application logic (numeric suffix)
- Catch unexpected unique violations and display generic error
- Log full exception details

**Connection Failures**:
- Display generic error message: "Database connection error. Please try again."
- Log connection details for system administrators
- Return HTTP 500 status

### File Upload Errors

**Invalid File Type**:
- Validate file extension before upload
- Display error: "The logo must be a file of type: jpg, jpeg, png, gif, webp."
- Prevent upload attempt

**File Size Exceeded**:
- Validate file size before upload
- Display error: "The logo may not be greater than 5MB."
- Show current file size to user

**Upload Service Failures**:
- Catch ImageKit API errors
- Display error: "Failed to upload logo. Please try again."
- Log API response for debugging
- Allow form submission without logo

### Migration Errors

**Data Integrity Issues**:
- Wrap migration in database transaction
- Validate data before each operation
- Roll back on any failure
- Log detailed error information including:
  - Failed operation
  - Affected records
  - Error message and stack trace

**Rollback Failures**:
- Log critical error
- Alert system administrators
- Provide manual rollback instructions

### Authorization Errors

**Unauthenticated Access**:
- Redirect to login page
- Store intended URL for post-login redirect
- Display message: "Please log in to continue."

**Unauthorized Actions**:
- Return HTTP 403 status
- Display error: "You do not have permission to perform this action."
- Log unauthorized attempt

### Not Found Errors

**Builder Not Found**:
- Return HTTP 404 status
- Display error: "Builder not found."
- Provide link back to builders list

**Related Entity Not Found**:
- Display error: "The selected city is invalid."
- Highlight problematic field
- Preserve other form data

## Testing Strategy

### Dual Testing Approach

This feature will employ both unit testing and property-based testing to ensure comprehensive coverage:

- **Unit Tests**: Verify specific examples, edge cases, error conditions, and integration points
- **Property Tests**: Verify universal properties across randomized inputs

### Unit Testing

**Model Tests** (`tests/Unit/Models/BuilderTest.php`):
- Test relationship definitions (city, properties, projects)
- Test scope methods (active, featured)
- Test accessor methods (getInitialsAttribute)
- Test slug generation with specific examples:
  - "ABC Builders" → "abc-builders"
  - "XYZ Corp." → "xyz-corp"
  - Duplicate handling: "ABC Builders" (2nd) → "abc-builders-1"

**Controller Tests** (`tests/Feature/BuilderControllerTest.php`):
- Test index page renders with builders list
- Test create page renders form
- Test store creates builder with valid data
- Test store fails with invalid data
- Test edit page renders with builder data
- Test update modifies builder with valid data
- Test update fails with invalid data
- Test destroy deletes builder without associations
- Test destroy fails for builder with associations
- Test bulk delete removes multiple builders
- Test bulk delete fails for builders with associations

**Integration Tests**:
- Test property form displays builder dropdown
- Test project form displays builder dropdown
- Test property can be created with builder
- Test property can be created without builder
- Test project requires builder selection
- Test builder detail page shows associated properties
- Test builder detail page shows associated projects

**Edge Cases**:
- Empty database (no builders)
- Builder with no logo (placeholder display)
- Builder with all optional fields null
- Very long company names (255 characters)
- Special characters in company names
- International phone numbers
- Multiple builders with similar names

### Property-Based Testing

Property-based tests will use **Pest PHP** with the **pest-plugin-faker** for data generation. Each test will run a minimum of 100 iterations.

**Configuration**:
```php
// tests/Pest.php
uses(Tests\TestCase::class)->in('Feature', 'Unit');

// Set minimum iterations for property tests
function propertyTest(string $description, Closure $test): void
{
    test($description, function () use ($test) {
        for ($i = 0; $i < 100; $i++) {
            $test();
        }
    });
}
```

**Property Test Examples** (`tests/Property/BuilderPropertyTest.php`):

```php
// Property 1: Unique Slug Generation
// Feature: builders-developers-management, Property 1: For any company name, when creating a builder, the system should generate a URL-friendly slug that is unique across all builders.
propertyTest('slug generation creates unique slugs', function () {
    $name = fake()->company();
    $builder1 = Builder::factory()->create(['company_name' => $name]);
    $builder2 = Builder::factory()->create(['company_name' => $name]);
    
    expect($builder1->slug)->not->toBe($builder2->slug);
    expect($builder2->slug)->toMatch('/^' . Str::slug($name) . '-\d+$/');
});

// Property 2: Company Name Validation
// Feature: builders-developers-management, Property 2: For any builder creation or update, the system should reject empty company names and company names exceeding 255 characters.
propertyTest('company name validation rejects invalid lengths', function () {
    // Test empty name
    $response = $this->post(route('builders.store'), [
        'company_name' => '',
        'status' => 'active',
    ]);
    $response->assertSessionHasErrors('company_name');
    
    // Test too long name
    $response = $this->post(route('builders.store'), [
        'company_name' => str_repeat('a', 256),
        'status' => 'active',
    ]);
    $response->assertSessionHasErrors('company_name');
});

// Property 11: Multi-Field Search
// Feature: builders-developers-management, Property 11: For any search query on the builders list, the system should return builders where the query matches any part of the company name, contact person name, email, phone, or city name.
propertyTest('search matches across multiple fields', function () {
    $city = City::factory()->create(['name' => 'TestCity']);
    $builder = Builder::factory()->create([
        'company_name' => 'ABC Builders',
        'contact_person_name' => 'John Doe',
        'email' => 'john@abc.com',
        'phone' => '+1234567890',
        'city_id' => $city->id,
    ]);
    
    $searchTerms = ['ABC', 'John', 'john@abc', '1234', 'TestCity'];
    $randomTerm = $searchTerms[array_rand($searchTerms)];
    
    $response = $this->get(route('builders.index', ['search' => $randomTerm]));
    $response->assertSee($builder->company_name);
});

// Property 17: Deletion Protection
// Feature: builders-developers-management, Property 17: For any builder that has associated properties or projects, the system should prevent deletion and display an error message indicating the builder is in use.
propertyTest('deletion prevented for builders with associations', function () {
    $builder = Builder::factory()->create();
    
    // Randomly associate with property or project
    if (rand(0, 1)) {
        Property::factory()->create(['builder_id' => $builder->id]);
    } else {
        Project::factory()->create(['builder_id' => $builder->id]);
    }
    
    $response = $this->delete(route('builders.destroy', $builder));
    $response->assertSessionHas('error');
    $this->assertDatabaseHas('builders', ['id' => $builder->id]);
});

// Property 18: Active Builders in Dropdowns
// Feature: builders-developers-management, Property 18: For any builder dropdown in property or project forms, the system should display only builders with status "active", sorted alphabetically by company name, and exclude inactive builders.
propertyTest('only active builders appear in dropdowns', function () {
    $activeBuilder = Builder::factory()->create([
        'status' => 'active',
        'company_name' => 'A Active Builder',
    ]);
    $inactiveBuilder = Builder::factory()->create([
        'status' => 'inactive',
        'company_name' => 'B Inactive Builder',
    ]);
    
    $response = $this->get(route('properties.create'));
    $response->assertSee($activeBuilder->company_name);
    $response->assertDontSee($inactiveBuilder->company_name);
});

// Property 35: Combined Filters
// Feature: builders-developers-management, Property 35: For any combination of search query, status filter, featured filter, and city filter applied simultaneously, the system should return only builders that match all applied criteria.
propertyTest('combined filters return matching builders only', function () {
    $city = City::factory()->create();
    $matchingBuilder = Builder::factory()->create([
        'company_name' => 'Matching Builder',
        'status' => 'active',
        'is_featured' => true,
        'city_id' => $city->id,
    ]);
    $nonMatchingBuilder = Builder::factory()->create([
        'company_name' => 'Other Builder',
        'status' => 'inactive',
        'is_featured' => false,
        'city_id' => $city->id,
    ]);
    
    $response = $this->get(route('builders.index', [
        'search' => 'Matching',
        'status' => 'active',
        'featured' => 'yes',
        'city_id' => $city->id,
    ]));
    
    $response->assertSee($matchingBuilder->company_name);
    $response->assertDontSee($nonMatchingBuilder->company_name);
});
```

**Migration Property Tests** (`tests/Property/BuilderMigrationPropertyTest.php`):

```php
// Property 37: Unique Developer Extraction
// Feature: builders-developers-management, Property 37: For any set of existing projects with developer names, the migration script should create exactly one builder record for each unique developer name.
propertyTest('migration creates one builder per unique developer', function () {
    $developerName = fake()->company();
    Project::factory()->count(rand(2, 5))->create([
        'developer_name' => $developerName,
    ]);
    
    Artisan::call('migrate:builders-from-projects');
    
    $builderCount = Builder::where('company_name', $developerName)->count();
    expect($builderCount)->toBe(1);
});

// Property 40: Migration Foreign Key Assignment
// Feature: builders-developers-management, Property 40: For any project after migration, the project's builder_id should reference the builder record that was created from that project's developer_name.
propertyTest('migration assigns correct builder_id to projects', function () {
    $developerName = fake()->company();
    $project = Project::factory()->create([
        'developer_name' => $developerName,
    ]);
    
    Artisan::call('migrate:builders-from-projects');
    
    $project->refresh();
    $builder = Builder::where('company_name', $developerName)->first();
    
    expect($project->builder_id)->toBe($builder->id);
});
```

### Test Coverage Goals

- **Line Coverage**: Minimum 80% for all new code
- **Branch Coverage**: Minimum 75% for conditional logic
- **Property Test Iterations**: Minimum 100 per property test

### Continuous Integration

- Run all tests on every pull request
- Block merge if tests fail
- Generate coverage reports
- Alert on coverage decrease

### Manual Testing Checklist

- [ ] Create builder with all fields populated
- [ ] Create builder with only required fields
- [ ] Upload various image formats for logo
- [ ] Test slug generation with special characters
- [ ] Test slug uniqueness with duplicate names
- [ ] Search builders by different fields
- [ ] Apply multiple filters simultaneously
- [ ] Create property with builder
- [ ] Create property without builder
- [ ] Create project with builder (required)
- [ ] Try to create project without builder (should fail)
- [ ] View builder detail page with properties and projects
- [ ] Edit builder and verify changes
- [ ] Try to delete builder with associations (should fail)
- [ ] Delete builder without associations
- [ ] Bulk delete multiple builders
- [ ] Set builder to inactive and verify dropdown exclusion
- [ ] Verify inactive builder still shows on existing properties/projects
- [ ] Mark builder as featured and verify sorting
- [ ] Test navigation menu item
- [ ] Run migration on test database
- [ ] Verify all project data preserved after migration

