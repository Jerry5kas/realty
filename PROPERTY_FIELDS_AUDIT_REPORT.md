# PROPERTY & PROJECT DETAIL PAGES - FIELD AUDIT REPORT

## PROPERTIES TABLE - FIELD AUDIT

### ✅ FIELDS CURRENTLY DISPLAYED

#### Header Section:
- title ✅
- locality ✅
- city (via relationship) ✅
- bedrooms ✅
- bathrooms ✅
- carpet_area ✅
- furnishing_status ✅
- price ✅

#### Overview Tab:
- description ✅
- highlights ❌ (field doesn't exist in properties table - only in projects)

#### Details Tab:
- propertyType (via relationship) ✅
- bedrooms ✅
- bathrooms ✅
- carpet_area ✅
- built_up_area ✅
- plot_area ❌ (field doesn't exist - should be super_built_up_area)
- furnishing_status ✅
- possession_status ✅
- floor_number ✅
- total_floors ✅
- parking ❌ (using wrong field - should be parking_covered + parking_open)
- facing ✅

#### Amenities Tab:
- amenities (via relationship) ✅

#### Location Tab:
- address ✅
- locality ✅
- city ✅
- pincode ✅
- latitude ✅
- longitude ✅

### ❌ MISSING FIELDS (NOT DISPLAYED)

#### Basic Info:
- slug (not needed in UI)
- type (sale/rent/lease/pg) ❌ MISSING - Should show
- sale_type (initial/resale/developer) ❌ MISSING - Should show
- category (residential/commercial/land) ❌ MISSING - Should show

#### Pricing:
- price_per_sqft ❌ MISSING - Should show
- maintenance_charges ❌ MISSING - Should show
- maintenance_period ❌ MISSING - Should show
- security_deposit ❌ MISSING - Should show (for rent)

#### Area:
- super_built_up_area ❌ MISSING - Should show
- area_unit ❌ MISSING - Should show

#### Property Details:
- balconies ❌ MISSING - Should show
- parking_covered ❌ MISSING - Should show separately
- parking_open ❌ MISSING - Should show separately
- age_of_property ❌ MISSING - Should show

#### Legal & Compliance:
- rera_number ❌ MISSING - Should show
- possession_date ❌ MISSING - Should show
- available_from ❌ MISSING - Should show (for rent)

#### Media:
- video_url ❌ MISSING - Should show if available
- virtual_tour_url ❌ MISSING - Should show if available

#### Relations:
- project (via relationship) ❌ MISSING - Should show if linked to project
- user/agent (via relationship) ❌ MISSING - Should show agent details

#### Status:
- status ❌ MISSING - Could show (Published/Sold/Rented)
- is_featured ❌ MISSING - Could show badge
- is_verified ❌ MISSING - Could show badge
- views ❌ MISSING - Could show view count

---

## PROJECTS TABLE - FIELD AUDIT

### ✅ FIELDS CURRENTLY DISPLAYED (Need to verify projects/show.blade.php)

### ❌ MISSING FIELDS (Need to check projects/show.blade.php)

---

## RECOMMENDATIONS

### HIGH PRIORITY - Must Add:
1. **type** - Show "For Sale" / "For Rent" / "For Lease" / "PG"
2. **sale_type** - Show "Initial Sale" / "Resale" / "By Developer"
3. **category** - Show "Residential" / "Commercial" / "Land"
4. **price_per_sqft** - Important for buyers
5. **super_built_up_area** - Complete area information
6. **balconies** - Important feature
7. **parking_covered** and **parking_open** - Show separately
8. **age_of_property** - Important for resale properties
9. **rera_number** - Legal compliance
10. **possession_date** - For under-construction properties

### MEDIUM PRIORITY - Should Add:
11. **maintenance_charges** and **maintenance_period** - For apartments
12. **security_deposit** - For rental properties
13. **available_from** - For rental properties
14. **video_url** - If available
15. **virtual_tour_url** - If available
16. **project** - Link to parent project if exists
17. **agent/user** - Show agent details

### LOW PRIORITY - Nice to Have:
18. **is_verified** - Show verified badge
19. **views** - Show view count
20. **area_unit** - Show unit (sqft/sqm)

---

## FIXES NEEDED

1. **Remove "plot_area"** - This field doesn't exist in properties table
2. **Fix "parking"** - Should use parking_covered + parking_open
3. **Remove "highlights"** - This field doesn't exist in properties table
4. **Add proper field grouping** - Group related fields together
