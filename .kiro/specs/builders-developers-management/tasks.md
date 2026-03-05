# Implementation Plan: Builders/Developers Management

## Overview

This implementation plan breaks down the Builders/Developers Management feature into incremental, testable steps. The feature centralizes builder/developer information by creating a dedicated `builders` table with proper relationships to properties and projects, replacing scattered text fields with a structured entity management system.

The implementation follows Laravel's MVC architecture and reuses existing components (data-table, form-input, imagekit-uploader) for consistency. The plan includes database migrations with data migration from existing projects, model creation with relationships, CRUD operations, views, routing, and comprehensive testing.

## Tasks

- [x] 1. Create builders table migration
  - Create migration file `YYYY_MM_DD_HHMMSS_create_builders_table.php`
  - Define schema with all fields: id, company_name, slug, logo_url, description, contact_person_name, phone, email, website, rera_registration_number, established_year, total_projects_completed, social media URLs, office_address, city_id, status, is_featured, timestamps, soft deletes
  - Add indexes for status, is_featured, city_id, and slug (unique)
  - Add foreign key constraint for city_id referencing cities table with ON DELETE SET NULL
  - _Requirements: 1.1, 1.2, 1.10, 1.11, 1.12_

- [x] 2. Create data migration from projects to builders
  - Create migration file `YYYY_MM_DD_HHMMSS_migrate_project_developers_to_builders.php`
  - Extract unique developer names from projects table
  - Create builder records with company_name from developer_name
  - Generate unique slugs for each builder
  - Copy developer_description to builder description field
  - Copy developer_logo to builder logo_url field
  - Set status to 'active' and is_featured to false for all migrated builders
  - Wrap entire migration in database transaction for rollback capability
  - _Requirements: 10.1, 10.2, 10.3, 10.4, 10.6, 10.7_

- [x] 3. Update projects table schema
  - [x] 3.1 Add builder_id column to projects table
    - Create migration file `YYYY_MM_DD_HHMMSS_add_builder_id_to_projects_table.php`
    - Add builder_id as nullable BIGINT UNSIGNED column after city_id
    - Add index for builder_id
    - _Requirements: 4.1_
  
  - [x] 3.2 Assign builder_id to existing projects
    - Update each project's builder_id to match the builder created from its developer_name
    - Verify all projects have valid builder_id values
    - _Requirements: 10.5_
  
  - [x] 3.3 Make builder_id required and drop old columns
    - Modify builder_id column to NOT NULL
    - Add foreign key constraint for builder_id referencing builders table with ON DELETE RESTRICT
    - Drop developer_name, developer_description, and developer_logo columns
    - _Requirements: 4.1, 4.2_

- [x] 4. Add builder_id column to properties table
  - Create migration file `YYYY_MM_DD_HHMMSS_add_builder_id_to_properties_table.php`
  - Add builder_id as nullable BIGINT UNSIGNED column after project_id
  - Add index for builder_id
  - Add foreign key constraint for builder_id referencing builders table with ON DELETE SET NULL
  - _Requirements: 3.1, 3.7_

- [x] 5. Create Builder model with relationships
  - Create `app/Models/Builder.php` file
  - Define fillable fields matching database schema
  - Add casts for is_featured (boolean), total_projects_completed (integer), established_year (integer)
  - Implement SoftDeletes trait
  - Define belongsTo relationship with City model
  - Define hasMany relationships with Property and Project models
  - Implement active() scope for filtering active builders
  - Implement featured() scope for filtering featured builders
  - Create getInitialsAttribute() accessor for generating company initials from name
  - Implement static generateUniqueSlug() method with numeric suffix for duplicates
  - _Requirements: 1.1, 1.2, 1.3, 1.11, 1.12_

- [ ]* 5.1 Write property tests for Builder model
  - **Property 1: Unique Slug Generation** - For any company name, when creating a builder, the system should generate a URL-friendly slug that is unique across all builders
  - **Property 9: Default Status Value** - For any builder created without explicitly specifying a status, the system should set the status to "active" by default
  - **Property 10: Default Featured Flag** - For any builder created without explicitly specifying the featured flag, the system should set is_featured to false by default
  - **Validates: Requirements 1.2, 1.3, 1.11, 1.12**

- [x] 6. Update Property model with builder relationship
  - Add builder_id to fillable array in `app/Models/Property.php`
  - Define belongsTo relationship with Builder model
  - _Requirements: 3.1_

- [x] 7. Update Project model with builder relationship
  - Add builder_id to fillable array in `app/Models/Project.php`
  - Remove developer_name, developer_description, developer_logo from fillable array
  - Define belongsTo relationship with Builder model
  - _Requirements: 4.1, 4.2_

- [x] 8. Create BuilderController with CRUD operations
  - [x] 8.1 Create controller file and implement index method
    - Create `app/Http/Controllers/BuilderController.php`
    - Implement index() method with eager loading of city relationship
    - Add search functionality across company_name, contact_person_name, email, phone, and city name
    - Add filters for status, featured, and city_id
    - Implement pagination with 20 items per page
    - Return builders.index view with builders and cities data
    - _Requirements: 2.1, 2.2, 2.3, 9.1, 9.2, 9.4, 9.5_
  
  - [x] 8.2 Implement create and store methods
    - Implement create() method to display form with active cities
    - Implement store() method with validation rules for all fields
    - Validate company_name (required, max 255)
    - Validate email format, phone format (digits/spaces/hyphens/plus), RERA alphanumeric
    - Validate established_year (1800 to current year), total_projects_completed (non-negative)
    - Validate status (active/inactive), social media URLs
    - Generate unique slug from company_name
    - Handle is_featured checkbox (default false)
    - Create builder record and redirect to index with success message
    - _Requirements: 1.4, 1.5, 1.6, 1.7, 1.8, 1.9, 1.10, 2.4, 2.5, 11.2_
  
  - [x] 8.3 Implement show method
    - Implement show() method with eager loading of city, properties, and projects relationships
    - Return builders.show view with builder data
    - _Requirements: 5.1, 5.2, 5.3, 5.4_
  
  - [x] 8.4 Implement edit and update methods
    - Implement edit() method to display form with builder data and active cities
    - Implement update() method with same validation rules as store
    - Regenerate slug only if company_name changed
    - Handle is_featured checkbox
    - Update builder record and redirect to index with success message
    - _Requirements: 2.6, 2.7_
  
  - [x] 8.5 Implement destroy method with association check
    - Implement destroy() method
    - Check if builder has associated properties or projects
    - If associations exist, prevent deletion and return error message with counts
    - If no associations, soft delete builder and return success message
    - _Requirements: 2.8, 2.9, 2.11_
  
  - [x] 8.6 Implement bulkDelete method
    - Implement bulkDelete() method accepting array of builder IDs
    - Validate IDs exist in builders table
    - Check each builder for property/project associations
    - Delete builders without associations
    - Return JSON response with success/error message and counts
    - _Requirements: 2.10, 2.11_

- [ ]* 8.7 Write property tests for BuilderController
  - **Property 11: Multi-Field Search** - For any search query on the builders list, the system should return builders where the query matches any part of the company name, contact person name, email, phone, or city name
  - **Property 13: Builder Creation Persistence** - For any valid builder data submitted through the create form, the system should persist the builder to the database with all provided fields correctly stored
  - **Property 14: Builder Update Persistence** - For any valid builder data submitted through the edit form, the system should update the existing builder record with all modified fields correctly stored
  - **Property 17: Deletion Protection** - For any builder that has associated properties or projects, the system should prevent deletion and display an error message indicating the builder is in use
  - **Property 35: Combined Filters** - For any combination of search query, status filter, featured filter, and city filter applied simultaneously, the system should return only builders that match all applied criteria
  - **Validates: Requirements 2.2, 2.5, 2.7, 2.9, 2.11, 9.1, 9.4**

- [x] 9. Create builders index view
  - Create `resources/views/builders/index.blade.php` file
  - Extend admin layout
  - Add page header with "Builders" title and "Create Builder" button
  - Implement search input with real-time filtering
  - Add filter dropdowns for status (all/active/inactive), featured (all/yes/no), and city
  - Add "Clear Filters" button
  - Use data-table component with columns: logo (with placeholder for missing), company_name, contact_person_name, phone, email, city name, status badge, actions (edit/delete)
  - Implement bulk delete functionality with checkboxes and confirm modal
  - Add pagination links
  - Display filtered results count
  - _Requirements: 2.1, 2.2, 2.3, 8.4, 8.5, 9.1, 9.2, 9.3, 9.4, 9.5, 9.6_

- [x] 10. Create builders create view
  - Create `resources/views/builders/create.blade.php` file
  - Extend admin layout
  - Add page header with "Create Builder" title
  - Create form with POST method to builders.store route
  - Add form-input components for company_name (required), contact_person_name, phone, email, website, rera_registration_number, established_year, total_projects_completed
  - Add form-textarea components for description and office_address
  - Add imagekit-uploader component for logo_url
  - Add city dropdown with active cities sorted alphabetically
  - Add status radio buttons (active/inactive) with active as default
  - Add featured checkbox with false as default
  - Add social media URL inputs (facebook_url, instagram_url, linkedin_url, twitter_url)
  - Display validation errors for each field
  - Add Cancel and Submit buttons
  - _Requirements: 2.4, 6.1, 7.1, 8.1, 11.1_

- [x] 11. Create builders edit view
  - Create `resources/views/builders/edit.blade.php` file
  - Extend admin layout
  - Add page header with "Edit Builder" title
  - Create form with PUT method to builders.update route
  - Pre-populate all form fields with existing builder data
  - Use same form structure as create view
  - Display validation errors for each field
  - Add Cancel and Update buttons
  - _Requirements: 2.6, 7.1, 8.1_

- [x] 12. Create builders show view
  - Create `resources/views/builders/show.blade.php` file
  - Extend admin layout
  - Add page header with builder company_name and action buttons (Edit, Delete with confirmation)
  - Display builder logo or placeholder with company initials
  - Create information sections: Basic Info (company name, status badge, featured badge), Contact Details (person, phone, email, website), Business Info (RERA, established year, total projects), Social Media (clickable icons opening in new tabs), Address (office address, city)
  - Display description in dedicated section
  - Create "Associated Properties" section with data table showing properties linked to this builder
  - Create "Associated Projects" section with data table showing projects linked to this builder
  - Add links to property and project detail pages
  - _Requirements: 5.1, 5.2, 5.3, 5.4, 5.5, 5.6, 6.5, 6.6, 11.3, 11.4, 11.5_

- [ ] 13. Update property create and edit views
  - Modify `resources/views/properties/create.blade.php` and `resources/views/properties/edit.blade.php`
  - Add builder dropdown after project field
  - Populate dropdown with active builders sorted alphabetically by company_name
  - Make builder field optional (allow null selection)
  - Add "-- Select Builder (Optional) --" as first option
  - _Requirements: 3.2, 3.3, 3.4_

- [ ]* 13.1 Write property test for property-builder association
  - **Property 18: Active Builders in Dropdowns** - For any builder dropdown in property or project forms, the system should display only builders with status "active", sorted alphabetically by company name, and exclude inactive builders
  - **Property 19: Optional Property-Builder Association** - For any property created or updated without selecting a builder, the system should successfully save the property with a null builder_id
  - **Validates: Requirements 3.2, 3.3, 3.4**

- [ ] 14. Update property show view
  - Modify `resources/views/properties/show.blade.php`
  - Add "Builder Information" section after project information (if builder exists)
  - Display builder logo, company name (linked to builder detail page), contact details, description
  - Display social media icons if builder has social media links
  - Show "No builder associated" message if builder_id is null
  - _Requirements: 3.5, 6.5, 11.4_

- [ ] 15. Update project create and edit views
  - Modify `resources/views/projects/create.blade.php` and `resources/views/projects/edit.blade.php`
  - Replace developer_name, developer_description, and developer_logo fields with builder dropdown
  - Populate dropdown with active builders sorted alphabetically by company_name
  - Make builder field required with validation
  - Add "-- Select Builder --" as first option
  - _Requirements: 4.3, 4.4_

- [ ]* 15.1 Write property test for project-builder association
  - **Property 21: Required Project-Builder Association** - For any project creation or update submitted without selecting a builder, the system should reject the submission and display a validation error
  - **Validates: Requirements 4.5**

- [ ] 16. Update project show view
  - Modify `resources/views/projects/show.blade.php`
  - Replace developer information section with "Builder Information" section
  - Display builder logo, company name (linked to builder detail page), contact details, description
  - Display social media icons if builder has social media links
  - _Requirements: 4.6, 6.5, 11.4_

- [ ] 17. Update PropertyController for builder filtering
  - Modify `app/Http/Controllers/PropertyController.php` index method
  - Add builder_id filter parameter
  - Filter properties by builder_id when provided
  - Pass builders list to view for filter dropdown
  - _Requirements: 3.6_

- [ ]* 17.1 Write property test for property filtering
  - **Property 20: Property Filtering by Builder** - For any builder filter applied to the properties list, the system should return only properties where builder_id matches the selected builder
  - **Validates: Requirements 3.6**

- [ ] 18. Update ProjectController for builder filtering
  - Modify `app/Http/Controllers/ProjectController.php` index method
  - Add builder_id filter parameter
  - Filter projects by builder_id when provided
  - Pass builders list to view for filter dropdown
  - _Requirements: 4.7_

- [ ]* 18.1 Write property test for project filtering
  - **Property 22: Project Filtering by Builder** - For any builder filter applied to the projects list, the system should return only projects where builder_id matches the selected builder
  - **Validates: Requirements 4.7**

- [ ] 19. Update properties index view with builder filter
  - Modify `resources/views/properties/index.blade.php`
  - Add builder filter dropdown to filters section
  - Populate with all builders sorted alphabetically
  - Apply filter when selected
  - _Requirements: 3.6_

- [ ] 20. Update projects index view with builder filter
  - Modify `resources/views/projects/index.blade.php`
  - Add builder filter dropdown to filters section
  - Populate with all builders sorted alphabetically
  - Apply filter when selected
  - _Requirements: 4.7_

- [x] 21. Add builder routes to web.php
  - Add resource route for builders controller in `routes/web.php`
  - Add custom route for bulk delete (POST builders/bulk-delete)
  - Wrap routes in auth middleware
  - _Requirements: 2.1, 2.4, 2.6, 2.8, 2.10_

- [x] 22. Update admin navigation layout
  - Modify `resources/views/layouts/admin.blade.php`
  - Add "Builders" menu item in the same section as Cities, Amenities, Features, Property Types
  - Link to builders.index route
  - Add active state highlighting when on builders pages
  - Use appropriate icon (building or office icon)
  - _Requirements: 12.1, 12.2, 12.3, 12.4_

- [ ] 23. Create Builder factory for testing
  - Create `database/factories/BuilderFactory.php`
  - Define factory with fake data for all fields
  - Use faker methods: company() for company_name, name() for contact_person, phoneNumber(), companyEmail(), url(), etc.
  - Set reasonable defaults for status (active) and is_featured (false)
  - _Requirements: Testing support_

- [ ]* 24. Write unit tests for Builder model
  - Create `tests/Unit/Models/BuilderTest.php`
  - Test city relationship returns City instance
  - Test properties relationship returns collection of Property instances
  - Test projects relationship returns collection of Project instances
  - Test active scope filters only active builders
  - Test featured scope filters only featured builders
  - Test getInitialsAttribute returns correct initials for single and multi-word names
  - Test generateUniqueSlug creates URL-friendly slugs
  - Test generateUniqueSlug handles duplicates with numeric suffixes
  - _Requirements: 1.2, 1.3_

- [ ]* 25. Write unit tests for BuilderController
  - Create `tests/Feature/BuilderControllerTest.php`
  - Test index page renders with builders list
  - Test index page search filters builders correctly
  - Test index page status filter works
  - Test index page featured filter works
  - Test index page city filter works
  - Test create page renders form with cities
  - Test store creates builder with valid data
  - Test store validates required fields
  - Test store validates email format
  - Test store validates phone format
  - Test store validates established year range
  - Test store validates RERA alphanumeric
  - Test store generates unique slug
  - Test edit page renders with builder data
  - Test update modifies builder with valid data
  - Test update regenerates slug when name changes
  - Test show page displays builder with relationships
  - Test destroy deletes builder without associations
  - Test destroy prevents deletion of builder with properties
  - Test destroy prevents deletion of builder with projects
  - Test bulkDelete removes multiple builders
  - Test bulkDelete prevents deletion of builders with associations
  - _Requirements: 1.4, 1.5, 1.6, 1.7, 1.8, 2.1, 2.2, 2.3, 2.4, 2.5, 2.6, 2.7, 2.8, 2.9, 2.10, 2.11_

- [ ]* 26. Write validation property tests
  - Create `tests/Property/BuilderValidationPropertyTest.php`
  - **Property 2: Company Name Validation** - For any builder creation or update, the system should reject empty company names and company names exceeding 255 characters
  - **Property 3: Email Format Validation** - For any email address provided during builder creation or update, the system should accept only valid email formats and reject invalid formats
  - **Property 4: Phone Number Format Validation** - For any phone number provided during builder creation or update, the system should accept only strings containing digits, spaces, hyphens, and plus signs, and reject strings with other characters
  - **Property 5: RERA Number Validation** - For any RERA registration number provided during builder creation or update, the system should accept only alphanumeric characters and reject strings with special characters
  - **Property 6: Established Year Range Validation** - For any established year provided during builder creation or update, the system should accept only four-digit years between 1800 and the current year, and reject years outside this range
  - **Property 7: Non-Negative Projects Validation** - For any total projects completed value provided during builder creation or update, the system should accept only non-negative integers and reject negative values
  - **Property 8: Status Enum Validation** - For any status value provided during builder creation or update, the system should accept only "active" or "inactive" and reject any other values
  - **Property 43: Social Media URL Validation** - For any social media URL provided during builder creation or update, the system should accept only valid URL formats and reject invalid formats
  - **Validates: Requirements 1.4, 1.5, 1.6, 1.7, 1.8, 1.9, 1.10, 11.2**

- [ ]* 27. Write migration property tests
  - Create `tests/Property/BuilderMigrationPropertyTest.php`
  - **Property 37: Unique Developer Extraction** - For any set of existing projects with developer names, the migration script should create exactly one builder record for each unique developer name
  - **Property 38: Migration Description Mapping** - For any project with a non-null developer_description, the migration script should copy that description to the corresponding builder's description field
  - **Property 39: Migration Logo Mapping** - For any project with a non-null developer_logo, the migration script should copy that logo URL to the corresponding builder's logo_url field
  - **Property 40: Migration Foreign Key Assignment** - For any project after migration, the project's builder_id should reference the builder record that was created from that project's developer_name
  - **Property 41: Migration Data Preservation** - For any project before and after migration, all project fields except developer_name, developer_description, and developer_logo should remain unchanged
  - **Validates: Requirements 10.1, 10.2, 10.3, 10.4, 10.5, 10.6**

- [ ]* 28. Write feature property tests
  - Create `tests/Property/BuilderFeaturePropertyTest.php`
  - **Property 12: Pagination Consistency** - For any builders list with more items than the page size, the system should display the correct subset of builders on each page and maintain consistent total counts across pages
  - **Property 15: Builder Deletion** - For any builder without associated properties or projects, when deletion is confirmed, the system should remove the builder from the database
  - **Property 16: Bulk Deletion** - For any set of selected builders without associated properties or projects, the bulk delete operation should remove all selected builders from the database
  - **Property 23: Builder Properties Display** - For any builder detail page, the system should display all properties where the property's builder_id matches the builder's id
  - **Property 24: Builder Projects Display** - For any builder detail page, the system should display all projects where the project's builder_id matches the builder's id
  - **Property 29: Featured Flag Persistence** - For any builder where the featured toggle is checked during creation or update, the system should set is_featured to true; when unchecked, it should set is_featured to false
  - **Property 30: Featured Builders Filter** - For any featured filter applied to the builders list, the system should return only builders where is_featured matches the filter value
  - **Property 32: Inactive Builders Exclusion from Dropdowns** - For any builder with status "inactive", the builder should not appear in dropdown selections on property and project forms
  - **Property 33: Inactive Builder Data Preservation** - For any builder set to inactive status, all existing properties and projects associated with that builder should continue to display the builder's information
  - **Property 34: Status Filter** - For any status filter applied to the builders list, the system should return only builders where the status field matches the selected filter value
  - **Property 36: Filtered Results Count** - For any set of filters applied to the builders list, the displayed count should equal the number of builders matching all filter criteria
  - **Validates: Requirements 2.3, 2.9, 2.10, 5.3, 5.4, 7.2, 7.3, 8.2, 8.3, 8.4, 9.5**

- [ ] 29. Checkpoint - Run all tests and verify migrations
  - Run `php artisan migrate:fresh` to verify all migrations execute successfully
  - Run `php artisan test` to execute all unit and feature tests
  - Verify all tests pass
  - Check database schema matches design specifications
  - Ensure all tests pass, ask the user if questions arise

- [ ] 30. Final integration testing and cleanup
  - Test complete workflow: create builder → associate with property → associate with project → view all pages
  - Test edge cases: builder with no logo, builder with all optional fields null, very long company names
  - Test deletion protection: try to delete builder with associations
  - Test status management: set builder inactive and verify dropdown exclusion
  - Test featured functionality: mark builder as featured and verify sorting
  - Test search and filters: apply multiple filters simultaneously
  - Verify navigation menu item works correctly
  - Check responsive design on mobile devices
  - Review code for consistency with existing patterns
  - Remove any debug code or console logs
  - Ensure all tests pass, ask the user if questions arise

## Notes

- Tasks marked with `*` are optional and can be skipped for faster MVP delivery
- Each task references specific requirements for traceability
- Checkpoints ensure incremental validation and catch issues early
- Property tests validate universal correctness properties across randomized inputs
- Unit tests validate specific examples, edge cases, and integration points
- The migration strategy uses a two-phase approach to safely migrate existing project data
- All views reuse existing components (data-table, form-input, imagekit-uploader) for consistency
- The implementation follows Laravel conventions and existing architectural patterns in the codebase
