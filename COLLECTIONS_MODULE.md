# Collections Module Documentation

## Overview
The Collections module allows you to create dynamic, filterable collections of properties and projects. You can group items based on various criteria like location, builder, price range, property type, and more.

## Features

### 1. **Flexible Collection Types**
- **Properties Only**: Collections containing only properties
- **Projects Only**: Collections containing only projects  
- **Mixed**: Collections with both properties and projects

### 2. **Two Collection Modes**

#### Automatic Mode (Filter-Based)
Dynamically query items based on filter criteria:
- **Location Filters**: City
- **Builder Filters**: Specific builder/developer
- **Property Filters**: 
  - Property type (Apartment, Villa, etc.)
  - Transaction type (Sale/Rent)
  - Bedrooms (1-5+ BHK)
  - Possession status (Ready to Move, Under Construction, Pre-Launch)
  - Furnishing status (Furnished, Semi-Furnished, Unfurnished)
  - Verified properties only
- **Project Filters**:
  - Project status (Upcoming, Ongoing, Completed)
- **Price Filters**: Min/Max price range
- **Date Filters**: Created after/before specific dates
- **Featured Items**: Show only featured items

#### Manual Mode
Manually select specific properties and projects to include in the collection.

### 3. **Display Settings**
- **Items Limit**: Control how many items to show (1-100)
- **Sort Options**: 
  - Date Created (newest/oldest first)
  - Price (low to high / high to low)
  - Title (A-Z / Z-A)
  - Manual order
- **Featured Collections**: Mark collections as featured for homepage display
- **Display Order**: Control the order collections appear

## Use Cases

### Example Collections You Can Create:

1. **New Properties in Bangalore**
   - Type: Property
   - Filter: City = Bangalore, Created After = Last 30 days
   - Sort: Date Created (Desc)

2. **Luxury Properties (High-End)**
   - Type: Property
   - Filter: Min Price = 1 Crore
   - Sort: Price (Desc)

3. **Ready to Move Properties**
   - Type: Property
   - Filter: Possession Status = Ready to Move
   - Sort: Date Created (Desc)

4. **Builder-Specific Collections**
   - Type: Mixed
   - Filter: Builder = Prestige Group
   - Shows all properties and projects by Prestige

5. **Completed Projects**
   - Type: Project
   - Filter: Project Status = Completed
   - Sort: Date Created (Desc)

6. **Affordable 2BHK Apartments**
   - Type: Property
   - Filter: Property Type = Apartment, Bedrooms = 2, Max Price = 50 Lakhs
   - Sort: Price (Asc)

7. **Furnished Rentals**
   - Type: Property
   - Filter: Transaction Type = Rent, Furnishing Status = Furnished
   - Sort: Price (Asc)

8. **Featured Properties**
   - Type: Property
   - Filter: Featured Only = Yes
   - Sort: Date Created (Desc)

## Installation & Setup

### 1. Run Migration
```bash
php artisan migrate
```

This creates the `collections` table with all necessary fields.

### 2. Access Admin Panel
Navigate to `/collections` (requires authentication)

### 3. Create Your First Collection

1. Click "Create Collection"
2. Fill in basic information:
   - Name (e.g., "New Properties in Bangalore")
   - Description (optional)
   - Image URL (optional)
   - Type (Property/Project/Mixed)
   - Status (Active/Inactive)
   - Featured checkbox

3. Choose Collection Mode:
   - **Automatic**: Select filter criteria
   - **Manual**: Select specific items

4. Set Display Settings:
   - Items Limit (how many to show)
   - Sort By (date, price, title)
   - Sort Order (ascending/descending)

5. Click "Create Collection"

## API Usage

### Get Collection Items in Code

```php
use App\Models\Collection;

// Get a collection by slug
$collection = Collection::where('slug', 'new-properties-bangalore')
    ->where('status', 'active')
    ->first();

// Get items in the collection
$items = $collection->getItems();

// Get item count
$count = $collection->getItemsCount();
```

### Display on Frontend

```php
// In your controller
$collection = Collection::where('slug', $slug)->firstOrFail();
$items = $collection->getItems();

return view('frontend.collection', compact('collection', 'items'));
```

## Frontend Routes

- **All Collections**: `/collections`
- **Single Collection**: `/collection/{slug}`

## Admin Routes

- **List Collections**: `/collections`
- **Create Collection**: `/collections/create`
- **Edit Collection**: `/collections/{id}/edit`
- **View Collection**: `/collections/{id}`
- **Delete Collection**: DELETE `/collections/{id}`

## Database Structure

### Collections Table Fields:
- `name`: Collection name
- `slug`: URL-friendly identifier
- `description`: Optional description
- `image`: Optional image URL
- `type`: property|project|mixed
- `status`: active|inactive
- `is_featured`: Boolean
- `display_order`: Integer for sorting
- `filters`: JSON array of filter criteria
- `manual_items`: JSON array of manually selected items
- `items_limit`: Max items to show
- `sort_by`: created_at|price|title|manual
- `sort_order`: asc|desc

## Filter Criteria JSON Structure

```json
{
  "city_id": 1,
  "builder_id": 2,
  "property_type": "apartment",
  "type": "sale",
  "project_status": "ongoing",
  "min_price": 5000000,
  "max_price": 10000000,
  "bedrooms": 3,
  "is_featured": true,
  "is_verified": true,
  "possession_status": "ready-to-move",
  "furnishing_status": "furnished",
  "created_after": "2024-01-01",
  "created_before": "2024-12-31"
}
```

## Manual Items JSON Structure

```json
[
  {"type": "property", "id": 1},
  {"type": "property", "id": 5},
  {"type": "project", "id": 3}
]
```

## Tips & Best Practices

1. **Use Descriptive Names**: Make collection names clear and descriptive
2. **Set Appropriate Limits**: Don't show too many items (12-24 is ideal)
3. **Use Featured Flag**: Mark important collections as featured for homepage
4. **Regular Updates**: For automatic collections, items update dynamically
5. **Test Filters**: Preview collections before making them active
6. **SEO-Friendly Slugs**: Use clear, keyword-rich slugs
7. **Add Images**: Collection images make them more appealing
8. **Organize with Display Order**: Use display_order to control sequence

## Future Enhancements

Potential features to add:
- Collection analytics (views, clicks)
- Scheduled collections (auto-activate/deactivate)
- Collection templates
- Bulk operations
- Export collections
- Collection sharing
- Related collections suggestions

## Support

For issues or questions about the Collections module, please refer to the main project documentation or contact the development team.
