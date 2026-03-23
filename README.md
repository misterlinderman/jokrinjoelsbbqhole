# Jorkin' Joel's BBQ Hole — WordPress Project

> Custom WordPress theme + plugin for a pop-up BBQ food truck brand in the Omaha/Elkhorn, Nebraska area.

---

## Project Summary

**Client:** Joel (Jorkin' Joel's BBQ Hole)  
**Type:** Custom WordPress theme + lightweight plugin  
**Status:** Pre-launch — content gathering in progress  
**Brand:** Bold, cheeky, irreverent BBQ pop-up. Logo and design assets complete.

This project builds a custom WordPress theme that matches Joel's existing brand identity (red/gold/black) and a companion plugin to manage pop-up event schedules and menu data without requiring Joel to touch code.

---

## Quick Links

| Document | Location |
|---|---|
| Architecture Overview | `docs/ARCHITECTURE.md` |
| Brand & Content Context | `docs/PROJECT_CONTEXT.md` |
| Build Phases & Prompts | `docs/BUILD_PHASES.md` |
| Reference Images | `reference-images/README.md` |
| Cursor Rules | `.cursor/rules/` |

---

## Tech Stack

| Layer | Choice | Rationale |
|---|---|---|
| CMS | WordPress 6.x | Client familiarity, plugin ecosystem |
| Theme approach | Custom (no starter theme) | Tight brand control, no bloat |
| Templating | PHP + block-theme hybrid optional | Keep it simple; FSE not required |
| Styling | SCSS → compiled CSS | Variables for brand colors, maintainable |
| JS | Vanilla JS / lightweight | No React/Vue overkill for a brochure site |
| Plugin | Custom (`jjbbq-manager`) | Schedule + menu management via WP Admin |
| ACF | Advanced Custom Fields (free) | Field groups for schedule and menu CPTs |
| Deployment | Standard hosting (e.g., Flywheel, SiteGround) | Client-manageable |

---

## Brand Color Reference

Official values (Photoshop samples: `reference-images/Initial Build and Client Identity/jjbbq-red.png`, `jjbbq-yellow.png`, `jjbbq-pink-light.png`, `jjbbq-pink-dark.png`):

```
Primary red:     #dd2c2f   rgb(221, 44, 47)
Gold / yellow:   #f7b112   rgb(247, 177, 18)
Pink (light):    #fa968d   rgb(250, 150, 141)
Pink (dark):     #fb4d51   rgb(251, 77, 81)
Black:           #000000
White:           #ffffff
```

Supporting UI tokens (cream section bg, footer dark band, warm text on red) live in `themes/jjbbq-theme/assets/scss/_variables.scss`.

---

## Project Status: Content Still Needed from Joel

- [ ] Upcoming truck/pop-up schedule (dates, times, locations)
- [ ] Confirmed standard menu (items + current prices)
- [ ] Catering offerings and pricing model
- [ ] Catering inquiry process (form, phone, email, DM?)
- [ ] Instagram handle
- [ ] Any additional contact info
- [ ] High-res logo PNG (transparent background)

*Initial outreach sent. Awaiting Joel's response.*

---

## Getting Started (Dev Setup)

```bash
# Clone into a local WP install's themes directory
cd wp-content/themes/
git clone [repo-url] jjbbq-theme

# Clone plugin
cd ../plugins/
git clone [repo-url] jjbbq-manager

# Install SCSS compiler (if using Node)
cd jjbbq-theme
npm install
npm run watch
```

Requires: WordPress 6.0+, PHP 8.0+, ACF Free plugin active.
