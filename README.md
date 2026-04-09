# Sahayata Portal (Standalone Subdomain System)

A modular Laravel-style scaffold for a standalone Sahayata portal with:

- **Team Management** (admin CRUD + public team directory)
- **Member Management** (admin CRUD + status lifecycle)
- **Admin Dashboard** (widgets + AI insights panel)
- **AI-assisted UI/UX** across admin and frontend pages
- **Bootstrap 5.3 channel CDN** for modern responsive design

## Modules Included

### 1) Team Management
- Add/edit/delete team members
- Role-based structure (Patron to Volunteer)
- Status control (active/inactive)
- Contact visibility toggle
- District and bio metadata

### 2) Member Management
- Add/edit/delete members from admin panel
- Search by name/mobile/district
- Status filter (active/inactive/blocked)

### 3) Admin Dashboard
- Widget cards for active cases, contributions, approvals, team/member counts
- AI Insights panel (trend, risk alert, engagement score)

### 4) Frontend Team Directory
- Leadership Team section
- State/District Team section
- Volunteer section
- AI quick search with role + district filters

### 5) AI UX Helpers (Starter)
- Form quality score while typing
- Bio tone/punctuation formatting
- Image upload quality hinting
- Smart search hints for team/member filters

## Data Model
- `sahayata_team` table (team profiles)
- `sahayata_members` table (community member records)

## Route Map
- `GET /team` → Public Team Frontend
- `GET /admin/dashboard` → Admin Dashboard
- `GET|POST|PUT|DELETE /admin/team*` → Team CRUD
- `GET|POST|PUT|DELETE /admin/members*` → Member CRUD

## Security Controls Included
- Server-side validation for all admin writes
- Role whitelist validation for team designations
- Image MIME + file size checks
- Middleware placeholders (`auth`, `can:manage-sahayata`)

## Next Steps
1. Integrate with full Laravel app bootstrap (`composer`, `.env`, auth guards).
2. Connect real Sahayata case/contribution tables for live dashboard widgets.
3. Add queue workers for reminders/notifications (SMS/email/WhatsApp).
4. Add fraud detection service hooks and audit logging.
5. Add feature/unit tests + CI.
