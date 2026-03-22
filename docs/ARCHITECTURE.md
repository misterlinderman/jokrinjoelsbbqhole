# Architecture Overview
## Jorkin' Joel's BBQ Hole — WordPress Theme + Plugin

---

## 1. High-Level Architecture

```
WordPress Install
├── wp-content/
│   ├── themes/
│   │   └── jjbbq-theme/          ← Custom theme (this repo)
│   └── plugins/
│       ├── advanced-custom-fields/   ← ACF Free (dependency)
│       └── jjbbq-manager/        ← Custom plugin (this repo)
```

The **theme** handles all visual presentation. The **plugin** handles data management (Custom Post Types, ACF field groups, admin UX for Joel). This separation means theme updates never break Joel's content data.

---

## 2. Theme Architecture (`jjbbq-theme/`)

### Directory Structure

```
jjbbq-theme/
├── style.css                  ← WP theme header (minimal styles here)
├── functions.php              ← Theme bootstrap: enqueue, supports, includes
├── index.php                  ← Fallback template
├── front-page.php             ← Homepage template
├── page.php                   ← Generic page template
├── single-jjbbq_event.php     ← Single pop-up event template
├── archive-jjbbq_event.php    ← Events archive (past pop-ups)
├── 404.php                    ← 404 page
│
├── template-parts/
│   ├── header.php             ← Site header / nav
│   ├── footer.php             ← Site footer
│   ├── hero.php               ← Homepage hero block
│   ├── next-popup.php         ← "Next Pop-Up" featured event card
│   ├── menu-section.php       ← Menu display partial
│   ├── event-card.php         ← Reusable event card component
│   └── catering-cta.php       ← Catering call-to-action block
│
├── assets/
│   ├── scss/
│   │   ├── _variables.scss    ← Brand colors, fonts, spacing tokens
│   │   ├── _reset.scss        ← Base reset
│   │   ├── _typography.scss   ← Font stacks, heading styles
│   │   ├── _layout.scss       ← Grid, container, section spacing
│   │   ├── _components.scss   ← Buttons, cards, badges
│   │   ├── _header.scss       ← Header/nav styles
│   │   ├── _footer.scss       ← Footer styles
│   │   ├── _hero.scss         ← Hero section
│   │   ├── _menu.scss         ← Menu section styles
│   │   ├── _events.scss       ← Pop-up schedule styles
│   │   ├── _catering.scss     ← Catering section styles
│   │   └── main.scss          ← Imports all partials
│   │
│   ├── css/
│   │   └── main.css           ← Compiled output (gitignored or committed)
│   │
│   └── js/
│       ├── main.js            ← Primary JS entry
│       └── nav.js             ← Mobile nav toggle
│
├── inc/
│   ├── theme-setup.php        ← add_theme_support, nav menus, image sizes
│   ├── enqueue.php            ← wp_enqueue_scripts
│   └── template-functions.php ← Helper functions (e.g., get_next_event())
│
└── package.json               ← Node scripts for SCSS compilation
```

### Key Theme Decisions

- **No block theme / FSE.** Classic PHP templates for simplicity and Joel's hosting environment compatibility.
- **No framework.** Pure SCSS with CSS custom properties. No Bootstrap, no Tailwind — keeps bundle tiny.
- **Template parts over page builders.** All sections are hardcoded partials controlled by the developer. Joel manages *content* (schedule, menu) not layout.

---

## 3. Plugin Architecture (`jjbbq-manager/`)

The plugin owns all data structures and admin UI. Theme reads from it.

### Directory Structure

```
jjbbq-manager/
├── jjbbq-manager.php          ← Plugin header + bootstrap
├── uninstall.php              ← Cleanup on delete
│
├── includes/
│   ├── cpt-events.php         ← Register jjbbq_event CPT
│   ├── cpt-menu-items.php     ← Register jjbbq_menu_item CPT
│   ├── acf-fields.php         ← Register ACF field groups programmatically
│   ├── admin-columns.php      ← Custom admin list columns
│   └── helpers.php            ← Shared query functions
│
└── assets/
    └── admin.css              ← Minimal admin UI polish
```

### Custom Post Types

#### `jjbbq_event` — Pop-Up Events

| Field | Type | Notes |
|---|---|---|
| `event_date` | Date Picker | ACF — used for ordering and display |
| `event_time` | Text | e.g., "11am until sell-out" |
| `event_venue` | Text | Venue name |
| `event_address` | Text | Full address |
| `event_status` | Select | upcoming / past / sold-out |
| `event_partner` | Text | Optional — collaboration note (e.g., "Julia's Tamales") |
| `event_flyer` | Image | Optional — event flyer upload |

**Post title** = Event label (e.g., "Jukes Ale Works — March 2026")

#### `jjbbq_menu_item` — Menu Items

| Field | Type | Notes |
|---|---|---|
| `menu_category` | Select | Core / Specialty / Sides / Collab |
| `menu_price` | Text | e.g., "$22–$24" or "$14" |
| `menu_description` | Textarea | Short description |
| `menu_available` | True/False | Toggle to hide items without deleting |
| `menu_note` | Text | e.g., "with sides" / "no sides" |

**Post title** = Item name (e.g., "Sliced Brisket Plate")

### Plugin Query Helpers (`helpers.php`)

```php
// Get the next upcoming event
jjbbq_get_next_event()  → WP_Post or null

// Get all upcoming events (ordered by date ASC)
jjbbq_get_upcoming_events( $limit = 5 )  → WP_Query

// Get menu items by category
jjbbq_get_menu_items( $category = 'all' )  → WP_Query

// Format event date for display
jjbbq_format_event_date( $post_id )  → string
```

---

## 4. Page Structure & Templates

### Homepage (`front-page.php`)

Sections in order:

1. **Hero** — Logo lockup, tagline, "Find the Truck" CTA button
2. **Next Pop-Up** — Prominent card: date, venue, address, time. If no upcoming event, shows "Follow us on Instagram for the next date."
3. **About / Brand Story** — Short copy block. The sell-out model, bold personality.
4. **Menu Preview** — Core items with prices. Link to full menu page.
5. **Catering CTA** — Bold band: "Feed Your Crew." Button to catering inquiry.
6. **Past Pop-Ups / Social Proof** — Recent events listed. "Sell-out after sell-out."

### Menu Page (`page-menu.php` or shortcode)

- Tabbed or section-divided by category: Core / Specialty / Sides / Collaborations
- Each item: name, price, description, availability badge

### Catering Page (`page-catering.php`)

- Placeholder pending Joel's info
- Contact form (WP native or WPForms lite) for catering inquiries

### Find the Truck / Schedule (`archive-jjbbq_event.php`)

- Upcoming events listed chronologically
- Past events below (collapsed or separate tab)

---

## 5. Data Flow

```
Joel logs in to WP Admin
    ↓
Creates/edits jjbbq_event post
    ↓
ACF fields saved to post meta
    ↓
Theme calls jjbbq_get_next_event()
    ↓
front-page.php renders "Next Pop-Up" section
    ↓
Visitor sees updated schedule
```

Joel never touches code. He manages events and menu items like blog posts.

---

## 6. Performance & Hosting Considerations

- No heavy page builder markup
- CSS: single compiled file, ~20–30kb max
- JS: minimal, no framework — under 10kb
- Images: Joel's logo PNG + event flyers (WP handles uploads)
- Caching: compatible with standard host-level caching (WP Rocket, W3TC, or host caching)
- Hosting target: Flywheel, SiteGround, or WP Engine — any standard managed WP host

---

## 7. What This Project Does NOT Include

- E-commerce / online ordering (not in scope)
- User accounts or login for visitors
- Reservation system
- Mobile app
- Custom Gutenberg blocks (not needed for this site's simplicity)
