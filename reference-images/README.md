# Reference Images — Jorkin' Joel's BBQ Hole

This directory holds brand assets, design references, and screenshots used by Cursor (and the developer) to make accurate visual decisions during the build.

---

## What Goes Here

Drop files directly into this folder. Cursor will reference this directory as part of the project context when making design decisions.

---

## Files to Add (Required Before Development)

### Priority 1 — Brand Assets

| Filename | What It Is | Status |
|---|---|---|
| `logo-full.png` | Full color logo, transparent background, high-res | ⏳ Waiting from Joel |
| `logo-dark-bg.png` | Logo version for use on dark/red backgrounds | ⏳ Waiting from Joel |
| `logo-icon-only.png` | Pig mascot or badge without text (if exists) | ⏳ Waiting from Joel |

**How to get these:** Joel's designer friend has the originals. Request a PNG export at minimum 1000px wide, transparent background.

---

### Priority 2 — Design Direction References

Add any screenshots, mockups, or reference sites here that inform the look and feel. Suggested files:

| Filename | What It Should Show |
|---|---|
| `ref-color-palette.png` | Screenshot or swatch of logo showing all 5 brand colors |
| `ref-logo-closeup.png` | Close-up of the logo showing lettering style and pig mascot clearly |
| `ref-instagram-flyer-1.png` | Screenshot of a past event Instagram flyer (good brand reference) |
| `ref-instagram-flyer-2.png` | Another event flyer if available |
| `ref-similar-sites.png` | Screenshots of BBQ/food truck sites with a similar vibe for inspiration |

---

### Priority 3 — Event Flyers (for Content)

If Joel sends event flyers (from past pop-ups or the upcoming March 2026 event), add them here:

| Filename | What It Is |
|---|---|
| `flyer-jukes-mar-2026.jpg` | Flyer for March 24, 2026 Jukes Ale Works event |
| `flyer-[venue]-[date].jpg` | Any other event flyers |

These can be used as placeholder featured images for events in the WP admin during development.

---

## How Cursor Uses This Directory

When giving Cursor a prompt, you can reference these files directly:

```
"Using the logo visible in reference-images/logo-full.png, style the site header..."
"Match the color treatment shown in reference-images/ref-instagram-flyer-1.png..."
"The pig mascot from reference-images/logo-closeup.png should appear as a decorative element..."
```

---

## Official brand colors (locked in)

Sampled in Photoshop; screenshots in **`Initial Build and Client Identity/`**:

| Swatch file | Role | Hex | RGB |
|---|---|---|---|
| `jjbbq-red.png` | Primary red | `#dd2c2f` | 221, 44, 47 |
| `jjbbq-yellow.png` | Gold / yellow | `#f7b112` | 247, 177, 18 |
| `jjbbq-pink-light.png` | Pink light | `#fa968d` | 250, 150, 141 |
| `jjbbq-pink-dark.png` | Pink dark | `#fb4d51` | 251, 77, 81 |

Black `#000000` and white `#ffffff` are standard. Theme tokens (cream sections, footer dark band, text-on-red) are defined in `themes/jjbbq-theme/assets/scss/_variables.scss` and documented in `docs/PROJECT_CONTEXT.md`.

---

## Fonts in the Logo

The logo uses a custom/designed lettering style (created by Joel's friend). For the web, `Bangers` from Google Fonts is the closest match for headlines. Confirm visually against `ref-logo-closeup.png` once available.

Alternative options to test:
- `Lilita One`
- `Fredoka One`
- `Boogaloo`
