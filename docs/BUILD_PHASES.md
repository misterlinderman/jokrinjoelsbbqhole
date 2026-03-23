# Build Phases & Cursor Prompts
## Jorkin' Joel's BBQ Hole — WordPress Theme + Plugin

> Each phase below includes a Cursor-ready prompt. Feed these in sequence. Do not skip phases — each builds on the last.

---

## Phase 0 — Project Scaffolding

**Goal:** Create the complete directory structure for both the theme and plugin so all subsequent phases have a home.

**Cursor Prompt:**

```
Create the WordPress theme directory structure for a custom theme called `jjbbq-theme` and a companion plugin called `jjbbq-manager`.

Theme structure:
jjbbq-theme/
├── style.css (WordPress theme header only — no actual styles)
├── functions.php (empty bootstrap with require_once stubs)
├── index.php (minimal WP fallback)
├── front-page.php (stub)
├── page.php (stub)
├── single-jjbbq_event.php (stub)
├── archive-jjbbq_event.php (stub)
├── 404.php (stub)
├── template-parts/ (empty dir with .gitkeep)
├── assets/scss/ (empty dir)
├── assets/css/ (empty dir)
├── assets/js/ (empty dir)
├── inc/ (empty dir)
└── package.json (with sass compile script)

Plugin structure:
jjbbq-manager/
├── jjbbq-manager.php (plugin header + bootstrap)
├── uninstall.php
└── includes/ (empty dir)

Create all files with correct WordPress file headers. The theme name is "Jorkin' Joel's BBQ Hole". The plugin name is "JJBBQ Manager". Use PHP 8.0 compatible syntax throughout.
```

---

## Phase 1 — Brand Tokens & Base SCSS

**Goal:** Establish all brand variables, reset, and typography as SCSS partials. This is the design system foundation — get it right here.

**Cursor Prompt:**

```
In the jjbbq-theme/assets/scss/ directory, create the following SCSS files:

_variables.scss — Define CSS custom properties AND SCSS variables for:
- Colors: official brand values in `assets/scss/_variables.scss` — red `#dd2c2f`, gold `#f7b112`, pink light `#fa968d`, pink dark `#fb4d51`, black `#000000`, white `#ffffff`, plus UI tokens (cream light-bg, dark-bg, text-on-red). Photoshop references: `reference-images/Initial Build and Client Identity/jjbbq-*.png`.
- Font families: --font-display (Bangers from Google Fonts), --font-body (Inter)
- Spacing scale: --space-xs through --space-xxl
- Container max-width: 1200px
- Border radius: --radius-sm, --radius-md

_reset.scss — Modern CSS reset (box-sizing, margin reset, img max-width, etc.)

_typography.scss — Base heading styles (h1–h4), body text, link styles. Headings should feel bold and punchy — uppercase tracking on h1/h2. Body text is dark on light, white on dark.

_layout.scss — .container class (max-width + padding), section padding utility classes, basic responsive grid (.grid-2, .grid-3), flexbox utility classes.

_components.scss — Style these components:
- .btn-primary: Red background, gold text, bold, uppercase, chunky padding, slight text-shadow. Hover: gold background, black text.
- .btn-secondary: Gold background, black text. Hover: red background, white text.
- .badge: small pill label (used for "Upcoming", "Sold Out", menu categories)
- .card: white background, black border, box-shadow. Dark variant .card--dark.
- .section-band: full-width colored section (dark red bg, white text)

main.scss — Import all partials in correct order. Add @import for Google Fonts (Bangers + Inter).

After creating SCSS files, update package.json with a sass watch script: `"watch": "sass --watch assets/scss/main.scss:assets/css/main.css"` and a build script.
```

---

## Phase 2 — Theme Setup & Functions

**Goal:** Wire up the WordPress theme — supports, menus, image sizes, script/style enqueues.

**Cursor Prompt:**

```
Build out the WordPress theme bootstrap in jjbbq-theme/:

inc/theme-setup.php — Create function jjbbq_theme_setup() hooked to after_setup_theme:
- add_theme_support for: title-tag, post-thumbnails, html5 (search-form, comment-form, gallery, caption, style, script)
- Register nav menus: 'primary' => 'Primary Navigation', 'footer' => 'Footer Navigation'
- Add image sizes: 'event-thumb' (800x600 crop), 'event-hero' (1600x800 crop)

inc/enqueue.php — Create function jjbbq_enqueue_assets() hooked to wp_enqueue_scripts:
- Enqueue assets/css/main.css with theme version as cache buster
- Enqueue assets/js/nav.js in footer
- Enqueue assets/js/main.js in footer
- Conditionally enqueue Google Fonts: Bangers + Inter

inc/template-functions.php — Create helper functions:
- jjbbq_get_next_event(): queries jjbbq_event CPT, status=upcoming, ordered by event_date ASC, returns first result or null
- jjbbq_get_upcoming_events($limit=5): same query, returns WP_Query
- jjbbq_get_menu_items($category='all'): queries jjbbq_menu_item CPT filtered by menu_category and menu_available=1
- jjbbq_format_event_date($post_id): returns formatted date string from event_date ACF field (e.g., "Saturday, March 24")

functions.php — Require all inc/ files in correct order. Add wp_head() and wp_footer() reminders in comments.

assets/js/nav.js — Mobile nav toggle: when .nav-toggle button is clicked, toggle .is-open class on .site-nav. Accessible (aria-expanded).
```

---

## Phase 3 — Plugin: CPTs, ACF Fields, Admin

**Goal:** Register the two Custom Post Types and all ACF field groups programmatically. Joel's admin experience lives here.

**Cursor Prompt:**

```
Build the jjbbq-manager plugin:

includes/cpt-events.php — Register custom post type `jjbbq_event`:
- Labels: singular "Pop-Up Event", plural "Pop-Up Events"
- Supports: title, editor (optional notes), thumbnail
- Public: true, show_in_rest: true
- Menu icon: dashicons-calendar-alt
- Rewrite slug: 'pop-ups'
- Capability type: post

includes/cpt-menu-items.php — Register custom post type `jjbbq_menu_item`:
- Labels: singular "Menu Item", plural "Menu Items"  
- Supports: title, thumbnail
- Public: false (only shown in admin, not on front-end archive)
- Menu icon: dashicons-food
- Rewrite slug: 'menu-items'

includes/acf-fields.php — Register ACF field groups programmatically using acf_add_local_field_group():

Field Group 1: "Pop-Up Event Details" — location: post_type == jjbbq_event
Fields:
- event_date: date_picker, required, display format "F j, Y", return format "Ymd"
- event_time: text, placeholder "e.g., 11am until sell-out"
- event_venue: text, required
- event_address: text
- event_status: select, choices: upcoming/Upcoming, past/Past, sold-out/Sold Out — default: upcoming
- event_partner: text, label "Collaboration Partner", instructions "Optional — e.g., Julia's Tamales"
- event_flyer: image, return format: id, label "Event Flyer (optional)"

Field Group 2: "Menu Item Details" — location: post_type == jjbbq_menu_item
Fields:
- menu_category: select, choices: core/Core Menu, specialty/Specialty Items, sides/Sides, collab/Collaborations
- menu_price: text, placeholder "e.g., $14 or $22–$24"
- menu_description: textarea, rows 3
- menu_available: true_false, default 1, message "Show on website menu"
- menu_note: text, placeholder "e.g., served with 2 sides"

includes/admin-columns.php — Add custom admin columns:
- For jjbbq_event list: show event_date, event_venue, event_status columns. Make sortable by event_date.
- For jjbbq_menu_item list: show menu_category, menu_price, menu_available columns.

includes/helpers.php — Implement all helper functions documented in ARCHITECTURE.md (jjbbq_get_next_event, jjbbq_get_upcoming_events, jjbbq_get_menu_items, jjbbq_format_event_date).

jjbbq-manager.php — Bootstrap file: define constants (JJBBQ_PLUGIN_PATH, JJBBQ_PLUGIN_URL, JJBBQ_VERSION), require all includes files, hook CPT registration to init.

Add a friendly admin notice if ACF is not active: "JJBBQ Manager requires Advanced Custom Fields to be installed and active."
```

---

## Phase 4 — Template Parts: Header & Footer

**Goal:** Build the site chrome — header with nav and footer with social links.

**Cursor Prompt:**

```
Create the following template parts in jjbbq-theme/template-parts/:

header.php:
- Site header with class .site-header (sticky on scroll via JS class toggle)
- Logo: display site logo image if set (custom logo support), fallback to site name as text
- Primary nav: wp_nav_menu with container class .site-nav
- Mobile hamburger button .nav-toggle with aria-label and three-bar icon (CSS or SVG)
- Header should be brand red (`#dd2c2f`) background, white/gold text
- On mobile (<768px): nav collapses, hamburger visible

footer.php:
- Site footer with class .site-footer, dark background (#1A0000)
- Three columns (stack on mobile):
  Column 1: Logo + tagline "Pop-up BBQ. Sell-out quality."
  Column 2: Footer nav (wp_nav_menu, 'footer' location) 
  Column 3: Social links (Instagram — placeholder href, can be set via Customizer or hardcoded with TODO comment), plus "Follow for pop-up announcements"
- Copyright bar: "© [year] Jorkin' Joel's BBQ Hole. Built with smoke and pixels."
- Gold accent border at top of footer

Also create assets/js/main.js:
- On scroll, if window.scrollY > 80, add class .scrolled to .site-header (for style change on scroll)
- Import/call nav.js toggle logic
```

---

## Phase 5 — Homepage Template

**Goal:** Build the full homepage — the most important page on the site.

**Cursor Prompt:**

```
Build the homepage in jjbbq-theme/front-page.php and all required template-parts.

front-page.php structure (call get_template_part() for each section):
1. get_header()
2. template-parts/hero
3. template-parts/next-popup
4. template-parts/about-strip
5. template-parts/menu-section (preview mode)
6. template-parts/catering-cta
7. template-parts/past-events
8. get_footer()

template-parts/hero.php:
- Full-width section, brand red background (`#dd2c2f`)
- Large logo display (using get_theme_mod or hardcoded img tag with TODO)
- Headline: "Pop-Up BBQ. Sell-Out Quality." (h1)
- Subhead: "Smoked in Omaha. Gone before you know it."
- Two buttons: "Find the Truck" (scrolls to next-popup section) and "See the Menu"
- Big bold energy. No subtle anything.

template-parts/next-popup.php:
- Section ID: "find-the-truck"
- Gold/black section band
- Heading: "Next Pop-Up"
- Call jjbbq_get_next_event() — if event exists:
  Display: date (formatted), venue name, address, time, partner note if set
  Show flyer image if attached
  Show "More Pop-Ups Coming" Instagram follow CTA
- If no event: "Follow us on Instagram for the next date announcement" with IG icon/link
- This section must be visually prominent — it's the primary user goal

template-parts/about-strip.php:
- Dark background section (#1A0000), white text
- Short punchy copy: 3–4 sentences about Jorkin' Joel's — the pop-up model, quality smoked meats, sell-out every time. Write in the brand voice (bold, local, unapologetic).
- Optional: pig mascot icon or decorative element

template-parts/menu-section.php (homepage preview):
- Light background section
- Heading: "What's on the Truck"
- Show first 6 menu items from jjbbq_get_menu_items('core') using a responsive grid
- Each item: name (bold), price, brief description if available
- "Full Menu" link/button at bottom

template-parts/catering-cta.php:
- Full-width section band, red background, gold text
- Heading: "Feed Your Crew"
- Subhead: "Catering available for events big and small. Let's talk."
- Button: "Get a Catering Quote" (links to /catering/)
- Make it loud. This is a revenue driver.

template-parts/past-events.php:
- Light section
- Heading: "Where We've Been" 
- Query last 5 jjbbq_events with status=past, display as simple list (venue, date)
- Subtext: "We sell out every time. Next one's yours."
```

---

## Phase 6 — Menu Page & Event Archive

**Goal:** Full menu page and the pop-up schedule/archive page.

**Cursor Prompt:**

```
Create the following templates in jjbbq-theme/:

page-menu.php (or use template-parts/menu-full.php called from page.php with custom page template):
- Full menu display
- Tabbed navigation (CSS tabs, no JS library): Core Menu | Specialty Items | Sides | Collaborations
- Each tab section: grid of menu items
- Each item card: name, price badge, description, availability (hide if menu_available = false)
- Note at bottom: "Menu varies by event. Follow us on Instagram for event-specific menus."
- Match brand aesthetic: red/gold accents, chunky headings

archive-jjbbq_event.php:
- Page heading: "Pop-Up Schedule"
- Section 1 — Upcoming Events:
  Query events with status=upcoming, ordered by date ASC
  Each event: date, venue, address, time, partner, flyer if set
  If empty: "No upcoming dates announced yet. Follow @[handle] on Instagram."
- Section 2 — Past Events (collapsible or just a simple list below):
  Query events with status=past, ordered by date DESC
  List format: venue — date — "Sold Out ✓" badge

single-jjbbq_event.php:
- Single event display (for permalink if someone shares an event link)
- Large date, venue, address, time
- Flyer image if present
- Back link to full schedule
- "Add to Calendar" functionality (generate .ics link — use basic PHP date formatting)

Also add the CSS for tabs (no JS required — use :target or checkbox hack, or simple CSS class approach):
In assets/scss/_menu.scss:
- .menu-tabs: horizontal tab bar, gold border-bottom
- .menu-tab: each tab button, active state highlighted red/gold
- .menu-tab-content: show/hide sections
```

---

## Phase 7 — Catering Page & Contact Form

**Goal:** Catering inquiry page. Uses placeholder content pending Joel's info.

**Cursor Prompt:**

```
Create jjbbq-theme/page-catering.php as a custom page template (register with Template Name: Catering comment header).

Page sections:

1. Hero band: "Catering by Jorkin' Joel's" — red background, large heading, short line "Smoked meats. No fuss. Just fire."

2. What We Offer section (placeholder content):
   - "We're putting together our catering packages — check back soon, or reach out below and we'll get you taken care of."
   - Placeholder list: Private events · Corporate lunches · Backyard parties · Game days
   - Note: "Pricing and availability depend on event size and date. Contact us to start the conversation."

3. Contact/Inquiry Form:
   - If WPForms or Contact Form 7 is active: show shortcode placeholder with TODO comment
   - Fallback: create a pure HTML/PHP form with fields: Name, Email, Phone, Event Date, Estimated Guest Count, Event Type, Message
   - Form submits to WordPress (use wp_mail or note as a TODO for plugin integration)
   - Style the form to match brand: red labels, gold focus borders, bold submit button

4. Alternative contact note:
   - "Prefer to reach out directly? DM us on Instagram." (with IG link)

Also create/update assets/scss/_catering.scss with form styles:
- Input/textarea: black border, gold focus ring (use `var(--color-gold)` / `#f7b112`)
- Label: bold, uppercase, small caps
- Submit button: full .btn-primary treatment
```

---

## Phase 8 — WordPress Customizer Settings

**Goal:** Give Joel a way to update the Instagram handle and key site-wide settings without touching code.

**Cursor Prompt:**

```
In jjbbq-theme/inc/theme-setup.php (or a new inc/customizer.php), add WordPress Customizer settings using the Customizer API (customize_register hook):

Create a Customizer panel: "Jorkin' Joel's Settings"

Section 1 — Social Media:
- Setting: jjbbq_instagram_handle (text) — "Instagram Handle (without @)" — sanitize_text_field
- Setting: jjbbq_instagram_url (url) — "Instagram URL" — esc_url_raw
- Setting: jjbbq_facebook_url (url) — "Facebook URL (optional)"

Section 2 — Contact Info:
- Setting: jjbbq_contact_email (text) — "Contact Email" — sanitize_email  
- Setting: jjbbq_contact_phone (text) — "Contact Phone (optional)"

Section 3 — Homepage Text:
- Setting: jjbbq_hero_headline (text) — "Hero Headline" — default: "Pop-Up BBQ. Sell-Out Quality."
- Setting: jjbbq_hero_subhead (text) — "Hero Subheadline"
- Setting: jjbbq_catering_cta_text (text) — "Catering CTA Headline" — default: "Feed Your Crew"

Use get_theme_mod() throughout template-parts to pull these values. Wrap Instagram links in conditional: only output if jjbbq_instagram_url is not empty.

Add to header.php and footer.php: replace hardcoded Instagram TODO comments with get_theme_mod('jjbbq_instagram_url') calls.
```

---

## Phase 9 — Seed Data & Admin Polish

**Goal:** Populate the plugin with seed data from the project context so the site has real content from day one. Polish the admin experience.

**Cursor Prompt:**

```
Create a seed data function in jjbbq-manager/includes/seed-data.php:

Function jjbbq_seed_data() — only runs once (check with get_option('jjbbq_seeded')):

Create jjbbq_event posts for these historical events (status=past):
- "Dirty Birds — December 2024" | Dec 23, 2024 | Dirty Birds | 1722 St. Mary's Ave, Omaha | past
- "Dirty Birds — July 2025" | Jul 7, 2025 | Dirty Birds | 1722 St. Marys Ave, Omaha | past
- "Jukes Ale Works — August 2025" | Aug 25, 2025 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE | past
- "Jukes Ale Works — September 2025" | Sep 29, 2025 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE | past
- "Barry O's Tavern — November 2025" | Nov 16, 2025 | Barry O's Tavern | — | past
- "Jukes Ale Works — March 2026" | Mar 24, 2026 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE | upcoming | event_time: "11am until sell-out"

Create jjbbq_menu_item posts for core menu items (all menu_available=1):
- Sliced Brisket Plate | core | $22–$24
- Pork Ribs — Full Rack | core | $28
- Pork Ribs — Half Rack | core | $17–$18
- Pulled Pork Sandwich | core | $14
- Smoked Chicken Thigh (2 pc) | core | $15
- Brisket Blanket Rolls | core | $8 | note: "no sides"
- Brisket Sandwich | specialty | — | desc: "Sliced brisket, provolone, 2 onion rings, BBQ sauce"
- The Old Man | specialty | — | desc: "Deli pork, horsey sauce, onion jam, swiss, chicharrones"
- Pork Belly Cheesesteak | specialty | — | desc: "Onion, green pepper, fried jalapeños, white american cheese"
- Peach Habanero Slaw | sides | —
- Smoked Pork Potato Salad | sides | —
- Deviled Egg | sides | —

Add an admin page (Settings submenu): "JJBBQ Setup" with a "Load Seed Data" button that fires an admin POST action calling jjbbq_seed_data().

Also add to jjbbq-manager/assets/admin.css:
- Style the jjbbq_event and jjbbq_menu_item post list screens with subtle brand accents
- Highlight "upcoming" status rows in the events list (light gold background)
- Highlight "sold-out" rows (light red background)
- Add the pig mascot emoji 🐷 next to the JJBBQ Manager menu item in admin using CSS content injection on the dashicon
```

---

## Phase 10 — QA, Accessibility & Final Polish

**Goal:** Cross-browser check, accessibility audit, and final details before handing off to Joel.

**Cursor Prompt:**

```
Perform a final QA pass on the jjbbq-theme and jjbbq-manager:

1. Accessibility audit:
- Add skip-to-content link at top of header.php
- Ensure all images have alt text (or empty alt="" for decorative)
- Ensure color contrast passes WCAG AA (red/white, gold/black combinations)
- Ensure focus styles are visible (don't remove outline without replacing it)
- Add aria-label to all icon-only buttons
- Ensure form labels are associated with inputs

2. Responsive check — add/update CSS in relevant SCSS files:
- Breakpoints: mobile-first. sm: 480px, md: 768px, lg: 1024px, xl: 1200px
- Hero: full height on mobile, centered text
- Next Pop-Up card: full width on mobile
- Menu grid: 1 column mobile, 2 columns tablet, 3 columns desktop
- Header: hamburger on mobile, full nav on desktop
- Footer: single column on mobile, 3 columns on desktop

3. Performance:
- Verify no render-blocking assets
- Add loading="lazy" to all images in template-parts
- Wrap Google Fonts load in preconnect hint in theme-setup.php

4. WordPress best practices:
- All user-facing strings wrapped in __() or _e() with 'jjbbq' text domain
- All ACF get_field() calls have fallback values
- All wp_query loops have wp_reset_postdata()
- All enqueued handles use 'jjbbq-' prefix

5. Create a README-JOEL.md file in the theme root:
- Plain English instructions for Joel on how to:
  - Add a new pop-up event
  - Update an existing event (change status to past/sold-out)
  - Add or hide a menu item
  - Update his Instagram link (via Customizer)
  - Upload a new event flyer
- Include screenshots placeholder notes (screenshots to be added during handoff)
```

---

## Appendix: Placeholder Copy

Use these during development until Joel provides final content.

**Hero headline:** "Pop-Up BBQ. Sell-Out Quality."  
**Hero subhead:** "Smoked in Omaha. Gone before you know it."  
**No upcoming events:** "No upcoming dates announced yet. Follow us on Instagram to be first."  
**Catering intro:** "We're putting together our catering packages. Reach out and we'll get you taken care of."  
**About blurb:** "Jorkin' Joel's BBQ Hole is Omaha's loudest pop-up BBQ. We smoke the good stuff — brisket, ribs, pork belly, all of it — and we show up where the good times are. No set hours. No set location. Just smoke, flavor, and a line out the door until it's gone. Follow along and don't miss the next one."

**Sell-out social proof:** "We don't have a closing time. We have a sell-out time."
