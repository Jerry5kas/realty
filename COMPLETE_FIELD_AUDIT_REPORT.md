# COMPLETE FIELD AUDIT REPORT - PROPERTIES & PROJECTS

Generated: March 7, 2026

---

## PROPERTIES DETAIL PAGE AUDIT

### DATABASE FIELDS (from migration):
Total: 47 fields

### CURRENTLY DISPLAYED: 23 fields ✅

1. title ✅
2. description ✅
3. type ❌ (NOT SHOWN - Should show "For Sale/Rent/Lease/PG")
4. category ❌ (NOT SHOWN - Should show "Residential/Commercial/Land")
5. property_type ✅ (via propertyType relationship)
6. price ✅
7. price_per_sqft ❌ (NOT SHOWN)
8. carpet_area ✅
9. built_up_area ✅
10. super_built_up_area ❌ (NOT SHOWN - showing wrong "plot_area" instead)
11. bedrooms ✅
12. bathrooms ✅
13. balconies ❌ (NOT SHOWN)
14. floor_number ✅
15. total_floors ✅
16. furnishing_status ✅
17. facing ✅
18. parking_covered ❌ (NOT SHOWN - showing wrong "parking" field)
19. parking_open ❌ (NOT SHOWN)
20. age_of_property ❌ (NOT SHOWN)
21. city ✅ (via relationship)
22. locality ✅
23. address ✅
24. pincode ✅
25. latitude ✅
26. longitude ✅
27. rera_number ❌ (NOT SHOWN)
28. possession_status ✅
29. possession_date ❌ (NOT SHOWN)
30. available_from ❌ (NOT SHOWN)
31. images ✅
32. video_url ❌ (NOT SHOWN)
33. virtual_tour_url ❌ (NOT SHOWN)
34. project_id ❌ (NOT SHOWN - should link to project)
35. builder ✅ (via relationship)
36. user/agent ❌ (NOT SHOWN)
37. amenities ✅ (via relationship)
38. features ❌ (NOT SHOWN - relationship exists but not displayed)
39. sale_type ❌ (NOT SHOWN - NEW FIELD)
40. maintenance_charges ❌ (NOT SHOWN)
41. maintenance_period ❌ (NOT SHOWN)
42. security_deposit ❌ (NOT SHOWN)
43. area_unit ❌ (NOT SHOWN)
44. status ❌ (NOT SHOWN)
45. is_featured ❌ (NOT SHOWN)
46. is_verified ❌ (NOT SHOWN)
47. views ❌ (NOT SHOWN)

### BUGS FOUND:
1. **"plot_area"** - Field doesn't exist in database (should be super_built_up_area)
2. **"parking"** - Field doesn't exist (should be parking_covered + parking_open)
3. **"highlights"** - Field doesn't exist in properties table (only in projects)

---

## PROJECTS DETAIL PAGE AUDIT

### DATABASE FIELDS (from migration):
Total: 38 fields

### CURRENTLY DISPLAYED: 16 fields ✅

1. name ✅
2. description ✅
3. highlights ✅
4. developer_name ❌ (NOT SHOWN - using builder relationship instead)
5. developer_description ❌ (NOT SHOWN)
6. developer_logo ❌ (NOT SHOWN)
7. project_type ✅
8. status ✅
9. launch_date ❌ (NOT SHOWN)
10. possession_date ❌ (NOT SHOWN)
11. completion_percentage ❌ (NOT SHOWN)
12. total_units ✅
13. available_units ❌ (NOT SHOWN)
14. total_towers ❌ (NOT SHOWN)
15. total_floors ❌ (NOT SHOWN)
16. total_area ✅
17. min_price ✅
18. max_price ✅
19. price_range ❌ (NOT SHOWN)
20. city ✅ (via relationship)
21. locality ✅
22. address ✅
23. pincode ✅
24. latitude ✅
25. longitude ✅
26. rera_number ❌ (NOT SHOWN)
27. rera_valid_till ❌ (NOT SHOWN)
28. approved_banks ❌ (NOT SHOWN)
29. images ✅
30. brochure_url ❌ (NOT SHOWN)
31. video_url ❌ (NOT SHOWN)
32. master_plan_image ❌ (NOT SHOWN)
33. builder ✅ (via relationship)
34. amenities ✅ (via relationship)
35. is_featured ❌ (NOT SHOWN)
36. is_verified ❌ (NOT SHOWN)
37. views ❌ (NOT SHOWN)
38. publish_status ❌ (NOT SHOWN)

---

## CRITICAL MISSING FIELDS

### PROPERTIES - MUST ADD (High Priority):
1. **type** - "For Sale" / "For Rent" / "For Lease" / "PG"
2. **sale_type** - "Initial Sale" / "Resale" / "By Developer"
3. **category** - "Residential" / "Commercial" / "Land"
4. **price_per_sqft** - ₹X per sqft
5. **super_built_up_area** - Complete area info
6. **balconies** - Number of balconies
7. **parking_covered** - Covered parking spaces
8. **parking_open** - Open parking spaces
9. **age_of_property** - Property age in years
10. **rera_number** - RERA registration
11. **possession_date** - Expected possession
12. **maintenance_charges** - Monthly/yearly charges
13. **security_deposit** - For rentals
14. **available_from** - For rentals
15. **project** - Link to parent project
16. **features** - Property features (relationship exists)
17. **video_url** - Video tour link
18. **virtual_tour_url** - 360° tour link

### PROJECTS - MUST ADD (High Priority):
1. **launch_date** - Project launch date
2. **possession_date** - Expected possession
3. **completion_percentage** - Construction progress
4. **available_units** - Units still available
5. **total_towers** - Number of towers
6. **total_floors** - Floors per tower
7. **rera_number** - RERA registration
8. **rera_valid_till** - RERA validity
9. **approved_banks** - List of approved banks
10. **brochure_url** - Downloadable brochure
11. **video_url** - Video tour
12. **master_plan_image** - Master plan image
13. **developer_description** - About developer

---

## SUMMARY

### Properties Page:
- **Displayed**: 23/47 fields (49%)
- **Missing**: 24 fields (51%)
- **Bugs**: 3 fields using wrong names

### Projects Page:
- **Displayed**: 16/38 fields (42%)
- **Missing**: 22 fields (58%)

### Overall Status:
**INCOMPLETE** - Less than 50% of available data is being displayed to users.

---

## ACTION REQUIRED

I will now update both detail pages to display ALL relevant fields in a well-organized manner.
