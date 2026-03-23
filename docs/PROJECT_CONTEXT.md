# Project Context
## Jorkin' Joel's BBQ Hole — Brand & Content Reference

> This document is the single source of truth for brand identity, content, tone, and known data. Reference it when writing copy, styling components, or making design decisions.

---

## 1. The Brand at a Glance

**Name:** Jorkin' Joel's BBQ Hole  
**Type:** Pop-up BBQ food truck  
**Location:** Omaha / Elkhorn, Nebraska area  
**Model:** Announce via Instagram → show up → sell out → done  
**Positioning:** High-quality smoked meats, bold flavors, irreverent personality

The sell-out model is a *feature*, not a bug. It signals quality and demand. Website copy should lean into this.

---

## 2. Brand Identity

### Logo
- Bold red circular badge with yellow-gold ring accent
- Chunky cartoon-style yellow lettering, black outlines
- Mascot: cartoonish pink pig (head at top, butt in the "O" of Joel's)
- Text: JORKIN' JOEL'S / BBQ HOLE
- Aesthetic: Retro, cheeky, irreverent. Humor-forward, not offensive.

### Color Palette

Official brand colors were sampled in Photoshop; screenshots with hex/RGB live in `reference-images/Initial Build and Client Identity/` (`jjbbq-red.png`, `jjbbq-yellow.png`, `jjbbq-pink-light.png`, `jjbbq-pink-dark.png`).

| Name | Hex | RGB | Usage |
|---|---|---|---|
| Primary red | `#dd2c2f` | 221, 44, 47 | Backgrounds, hero, primary buttons, section bands, emphasis |
| Gold / yellow | `#f7b112` | 247, 177, 18 | Headings on red, borders, highlights, secondary buttons |
| Pink (light) | `#fa968d` | 250, 150, 141 | Soft accent — mascot-adjacent, decorative touches |
| Pink (dark) | `#fb4d51` | 251, 77, 81 | Stronger pink accent when more pop is needed |
| Black | `#000000` | — | Outlines, body text on light backgrounds |
| White | `#ffffff` | — | Text on dark/red, card surfaces |

Supporting UI tokens (not re-sampled): `--color-dark-bg` (`#1a0000`), `--color-light-bg` / cream (`#faf6f0`), `--color-text-on-red` (`#fff5e0`). **Source of truth:** `jjbbq-theme/assets/scss/_variables.scss`.

### SCSS / CSS custom properties

```scss
// See _variables.scss — excerpt:
// $color-red, $color-gold, $color-pink-light, $color-pink-dark, $color-black, $color-white
// --color-gold-dark is derived in SCSS for hover / depth on gold.
```

### Typography Direction
- **Headlines:** Bold, chunky, uppercase-friendly — look for Google Fonts that echo the logo's energy. Candidates: `Boogaloo`, `Lilita One`, `Fredoka One`, `Bangers` (confirm with Joel)
- **Body:** Clean, readable — `Inter`, `Open Sans`, or system stack
- **No thin fonts.** Nothing delicate. This brand is loud.

### Tone & Voice
- Bold, loud, unapologetic
- Casual and local — not corporate
- Leans into the cheeky/crude name *confidently* without being off-putting
- Humor as a feature, not a distraction from quality
- Confident: "We sell out. Every time."

**Copy examples to match:**
- "We don't have hours. We have smoke signals."
- "Pop-up. Show up. Sell out."
- "Find the truck before it's gone."

---

## 3. Menu Data (Known Items)

*Prices and availability vary by event. Joel to confirm final website menu.*

### Core / Recurring Items

| Item | Price Range |
|---|---|
| Sliced Brisket Plate | $22–$24 |
| Pork Ribs — Full Rack | $28 |
| Pork Ribs — Half Rack | $17–$18 |
| Pulled Pork Sandwich | $14 |
| Smoked Chicken Thigh (2 pc) | $15 |
| Brisket Blanket Rolls | $8 (no sides) |

### Specialty / Rotating Items

| Item | Description |
|---|---|
| Brisket Sandwich | Sliced brisket, provolone, 2 onion rings, BBQ sauce |
| The Old Man | Deli pork, horsey sauce, onion jam, swiss, chicharrones |
| Pork Belly Cheesesteak | Onion, green pepper, fried jalapeños, white american cheese |
| Merguez | Spicy lamb/pork/beef sausage, dijon mustard, onion jam |
| BBQ Chili Cheese Tots | Shredded cheese, BBQ chili, sauce |
| PBLT | Pork Belly Burnt Ends Salad |

### Sides (with plates, varies by event)
- Peach Habanero Slaw
- Smoked Pork Potato Salad
- Deviled Egg
- Dirty White Bread, Pickles, Cornbread

### Collaboration: Julia's Tamales (select events)
- 3 Tamales — $7
- 2 Tamales — $5
- Flavors: Chicken/Green Sauce · Pork/Red Sauce · Cheese & Jalapeño/Green Sauce

---

## 4. Pop-Up Event History

| Date | Venue | Address |
|---|---|---|
| Dec 23, 2024 | Dirty Birds | 1722 St. Mary's Ave, Omaha |
| Jul 7, 2025 | Dirty Birds | 1722 St. Marys Ave, Omaha |
| Aug 25, 2025 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE |
| Sep 29, 2025 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE |
| Nov 16, 2025 | Barry O's Tavern | — |
| Mar 24, 2026 | Jukes Ale Works | 20560 Elkhorn Dr, Elkhorn NE |

**Key pattern:** Jukes Ale Works in Elkhorn is the primary recurring venue. Dirty Birds in Omaha is secondary.

---

## 5. Known Partners & Collaborators

| Partner | Role |
|---|---|
| Jukes Ale Works (Elkhorn) | Primary recurring venue |
| Dirty Birds, Omaha | Secondary recurring venue |
| Barry O's Tavern | Venue |
| Terrible Gerald's Pizza | Food collab — "The Dough-Jo Gets Jorked" (Nov 2025) |
| Julia's Tamales | Food collab — tamale add-on at select events |

---

## 6. Content Still Needed from Joel

These items block final site completion. Placeholders should be used during development.

- [ ] Upcoming schedule (dates, times, locations)
- [ ] Confirmed current menu + prices for website
- [ ] Catering offerings (what's available, pricing model)
- [ ] Catering inquiry method (form / phone / email / DM)
- [ ] Instagram handle (confirmed active)
- [ ] Other social/contact info
- [ ] High-res logo PNG, transparent background

---

## 7. Site Goals (Priority Order)

1. **Help people find the next pop-up** — date, location, time, prominently
2. **Show the menu** — what's available, what to expect
3. **Enable catering inquiries** — form or contact method
4. **Build brand credibility** — sell-out history, social proof
5. **Drive Instagram follows** — so fans get event announcements

---

## 8. Joel's Admin Experience Goals

Joel is not a developer. The WP admin experience should be:
- Add a new event: fill in 5–6 fields, hit publish
- Update the menu: toggle items on/off, edit prices
- Never touch code, theme files, or page builders
- Mobile-friendly admin (he may update from his phone)
