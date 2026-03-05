# Requirements Document

## Introduction

This document defines the requirements for a Builders/Developers Management feature in a real estate CRM system. The feature will centralize builder/developer information, replacing scattered text fields with a proper entity management system, and enable proper tracking of which builder/developer is associated with properties and projects.

## Glossary

- **System**: The real estate CRM application
- **Builder**: A company or entity that develops, constructs, or owns real estate properties and projects
- **Admin**: An authenticated user with administrative privileges who can manage builders, properties, and projects
- **Property**: A real estate listing (residential, commercial, etc.) that may be owned by a builder or individual
- **Project**: A real estate development project (e.g., apartment complex, township) that is developed by a builder
- **RERA**: Real Estate Regulatory Authority - a regulatory body for real estate sector
- **CRUD**: Create, Read, Update, Delete operations
- **Slug**: A URL-friendly version of a name (e.g., "abc-builders" from "ABC Builders")

## Requirements

### Requirement 1: Builder Entity Management

**User Story:** As an admin, I want to create and manage builder/developer profiles, so that I can maintain a centralized database of builders in the system.

#### Acceptance Criteria

1. THE System SHALL store builder information including company name, slug, logo URL, description, contact person name, phone, email, website, RERA registration number, established year, total projects completed, social media links, office address, city, status, and featured flag
2. WHEN an admin creates a builder, THE System SHALL generate a unique slug from the company name
3. WHEN an admin creates a builder with a duplicate slug, THE System SHALL append a numeric suffix to ensure uniqueness
4. THE System SHALL validate that company name is required and has a maximum length of 255 characters
5. THE System SHALL validate that email follows a valid email format when provided
6. THE System SHALL validate that phone number contains only digits, spaces, hyphens, and plus signs when provided
7. THE System SHALL validate that RERA registration number is alphanumeric when provided
8. THE System SHALL validate that established year is a four-digit number between 1800 and current year when provided
9. THE System SHALL validate that total projects completed is a non-negative integer when provided
10. THE System SHALL validate that status is either "active" or "inactive"
11. THE System SHALL set status to "active" by default when creating a new builder
12. THE System SHALL set featured flag to false by default when creating a new builder

### Requirement 2: Builder CRUD Operations

**User Story:** As an admin, I want to perform CRUD operations on builders, so that I can keep builder information up to date.

#### Acceptance Criteria

1. WHEN an admin navigates to the builders list page, THE System SHALL display all builders in a data table with columns for logo, name, contact person, phone, email, city, status, and actions
2. THE System SHALL provide search functionality to filter builders by name, contact person, email, or city
3. THE System SHALL provide pagination for the builders list with configurable items per page
4. WHEN an admin clicks create builder, THE System SHALL display a form with all builder fields
5. WHEN an admin submits a valid create builder form, THE System SHALL save the builder and redirect to the builders list with a success message
6. WHEN an admin clicks edit on a builder, THE System SHALL display a form pre-filled with the builder's current data
7. WHEN an admin submits a valid edit builder form, THE System SHALL update the builder and redirect to the builders list with a success message
8. WHEN an admin clicks delete on a builder, THE System SHALL display a confirmation modal
9. WHEN an admin confirms deletion of a builder, THE System SHALL delete the builder and refresh the list with a success message
10. THE System SHALL provide bulk delete functionality to delete multiple selected builders at once
11. WHEN an admin attempts to delete a builder linked to properties or projects, THE System SHALL prevent deletion and display an error message indicating the builder is in use

### Requirement 3: Builder-Property Association

**User Story:** As an admin, I want to optionally link properties to builders, so that I can track which properties belong to builders versus individual owners.

#### Acceptance Criteria

1. THE System SHALL add an optional builder_id foreign key column to the properties table
2. WHEN an admin creates or edits a property, THE System SHALL display a dropdown to select a builder
3. THE System SHALL populate the builder dropdown with active builders sorted alphabetically by name
4. THE System SHALL allow the builder field to remain empty for properties owned by individuals
5. WHEN a property has an associated builder, THE System SHALL display builder information on the property detail page including name, logo, contact details, and description
6. WHEN an admin filters properties, THE System SHALL provide an option to filter by builder
7. THE System SHALL maintain referential integrity between properties and builders

### Requirement 4: Builder-Project Association

**User Story:** As an admin, I want to link projects to builders, so that I can properly track which builder is developing each project.

#### Acceptance Criteria

1. THE System SHALL add a required builder_id foreign key column to the projects table
2. THE System SHALL remove the developer_name, developer_description, and developer_logo text columns from the projects table
3. WHEN an admin creates or edits a project, THE System SHALL display a required dropdown to select a builder
4. THE System SHALL populate the builder dropdown with active builders sorted alphabetically by name
5. WHEN an admin submits a project form without selecting a builder, THE System SHALL display a validation error
6. WHEN a project has an associated builder, THE System SHALL display builder information on the project detail page including name, logo, contact details, and description
7. WHEN an admin filters projects, THE System SHALL provide an option to filter by builder
8. THE System SHALL maintain referential integrity between projects and builders

### Requirement 5: Builder Detail Page

**User Story:** As an admin, I want to view comprehensive builder information, so that I can see all details and associated properties/projects in one place.

#### Acceptance Criteria

1. WHEN an admin clicks on a builder name, THE System SHALL display a builder detail page
2. THE System SHALL display all builder information including logo, company name, description, contact details, RERA number, established year, total projects, social media links, address, and status
3. THE System SHALL display a list of all properties associated with the builder
4. THE System SHALL display a list of all projects associated with the builder
5. THE System SHALL provide links to edit the builder from the detail page
6. THE System SHALL provide a link to delete the builder from the detail page with confirmation

### Requirement 6: Builder Logo Management

**User Story:** As an admin, I want to upload and manage builder logos, so that I can visually identify builders throughout the system.

#### Acceptance Criteria

1. WHEN an admin creates or edits a builder, THE System SHALL provide an image upload interface for the logo
2. THE System SHALL validate that uploaded logos are image files with extensions jpg, jpeg, png, gif, or webp
3. THE System SHALL validate that uploaded logos do not exceed 5MB in size
4. WHEN a logo is uploaded, THE System SHALL store the logo URL in the builder record
5. WHEN a builder has a logo, THE System SHALL display the logo in the builders list, builder detail page, property detail page, and project detail page
6. WHEN a builder does not have a logo, THE System SHALL display a placeholder image or company initials

### Requirement 7: Featured Builders

**User Story:** As an admin, I want to mark certain builders as featured, so that I can highlight premium or important builders in the system.

#### Acceptance Criteria

1. THE System SHALL provide a featured toggle on the builder create and edit forms
2. WHEN an admin marks a builder as featured, THE System SHALL set the featured flag to true
3. THE System SHALL provide a filter on the builders list to show only featured builders
4. WHEN displaying builders in dropdowns, THE System SHALL optionally show featured builders at the top of the list

### Requirement 8: Builder Status Management

**User Story:** As an admin, I want to activate or deactivate builders, so that I can control which builders are available for selection without deleting their data.

#### Acceptance Criteria

1. THE System SHALL provide a status toggle on the builder create and edit forms with options "active" and "inactive"
2. WHEN an admin sets a builder status to inactive, THE System SHALL exclude the builder from dropdown selections in property and project forms
3. WHEN an admin sets a builder status to inactive, THE System SHALL continue to display the builder information on existing properties and projects
4. THE System SHALL provide a filter on the builders list to show builders by status
5. WHEN displaying the builders list, THE System SHALL visually distinguish inactive builders with a badge or color indicator

### Requirement 9: Builder Search and Filtering

**User Story:** As an admin, I want to search and filter builders, so that I can quickly find specific builders in a large database.

#### Acceptance Criteria

1. THE System SHALL provide a search input that filters builders by company name, contact person, email, phone, or city
2. THE System SHALL update the builders list in real-time as the admin types in the search input
3. THE System SHALL provide filter options for status (active/inactive) and featured (yes/no)
4. THE System SHALL allow multiple filters to be applied simultaneously
5. THE System SHALL display the count of filtered results
6. THE System SHALL provide a clear filters button to reset all search and filter criteria

### Requirement 10: Builder Data Migration

**User Story:** As a system administrator, I want to migrate existing project developer data to the new builders table, so that no data is lost during the transition.

#### Acceptance Criteria

1. THE System SHALL provide a migration script that extracts unique developer names from existing projects
2. WHEN the migration script runs, THE System SHALL create builder records for each unique developer name
3. WHEN the migration script runs, THE System SHALL populate the builder description from developer_description when available
4. WHEN the migration script runs, THE System SHALL populate the builder logo from developer_logo when available
5. WHEN the migration script runs, THE System SHALL update each project's builder_id to reference the corresponding builder record
6. THE System SHALL preserve all existing project data during migration
7. IF the migration script encounters errors, THEN THE System SHALL roll back all changes and log the error details

### Requirement 11: Builder Social Media Links

**User Story:** As an admin, I want to store builder social media links, so that I can display them on builder profiles and enable users to connect with builders.

#### Acceptance Criteria

1. THE System SHALL store social media URLs for Facebook, Instagram, LinkedIn, and Twitter
2. THE System SHALL validate that social media URLs follow a valid URL format when provided
3. WHEN a builder has social media links, THE System SHALL display clickable icons on the builder detail page
4. WHEN a builder has social media links, THE System SHALL display clickable icons on property and project detail pages where the builder is associated
5. THE System SHALL open social media links in a new browser tab when clicked

### Requirement 12: Builder Admin Navigation

**User Story:** As an admin, I want easy access to the builders management section, so that I can navigate to it quickly from anywhere in the admin panel.

#### Acceptance Criteria

1. THE System SHALL add a "Builders" menu item to the admin navigation sidebar
2. THE System SHALL position the "Builders" menu item in the same section as Cities, Amenities, Features, and Property Types
3. WHEN an admin clicks the "Builders" menu item, THE System SHALL navigate to the builders list page
4. WHEN an admin is on any builders page, THE System SHALL highlight the "Builders" menu item as active
