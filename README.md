# 🏆 Team Match Booking Demo (WordPress Plugin)

This is a simplified WordPress plugin demo of a frontend football team booking and match challenge system, inspired by the Footy Vision spec.

## ✨ Features

- Frontend team registration (Custom Post Type: `team`)
- Team availability submission with:
  - Preferred location (ACF Google Maps field)
  - Date/time availability
- Match challenge form (request another team for a match)
- Auto fixture generation on acceptance
- Custom user role: `team_manager`

## 🔧 Tech Stack

- WordPress (Plugin)
- ACF (Free or Pro)
- SportsPress (optional, or use a fixture CPT)
- Custom PHP for form handling
- Optional: Haversine formula for location-based filtering

## 🛠 Setup Instructions

1. Clone or download this repo into your WordPress `/wp-content/plugins/` directory.
2. Activate the plugin.
3. Import the ACF fields from `acf-fields.json`.
4. Use the shortcodes to embed forms:
   - `[register_team_form]`
   - `[team_availability_form]`
   - `[challenge_team_form]`

## 📁 File Structure

- `includes/` – Core logic (CPT registration, challenge handling, fixture generation)
- `templates/` – Form templates used in shortcodes
- `assets/` – JS & CSS (optional, for enhanced UX)
- `acf-fields.json` – Exported ACF field group



r

