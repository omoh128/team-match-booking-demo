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

## 📸 Screenshots

| Register Team | Submit Availability | Challenge Team |
|---------------|---------------------|----------------|
| ![Team Form](screenshots/team-form.png) | ![Availability](screenshots/availability-form.png) | ![Challenge](screenshots/challenge-form.png) |

## 🚀 Demo

Live demo: [https://demo.yoursite.com](https://demo.yoursite.com)  
GitHub repo: [github.com/yourhandle/team-match-booking-demo](https://github.com/yourhandle/team-match-booking-demo)

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

## ✅ Status

This is a working MVP demo built as a proof of concept. It’s not production-ready but demonstrates my understanding of the core features required by the Footy Vision project.

## 👋 Author

**[Your Name]**  
[LinkedIn or Portfolio link]  
Email: [you@example.com]

---

Would you like me to scaffold the actual plugin PHP files as well to save you time?
