# Design System Document: The Imperial Editorial

## 1. Overview & Creative North Star
**Creative North Star: "The Digital Atelier"**
This design system rejects the frantic, cluttered nature of traditional e-commerce. Instead, it adopts a high-end editorial philosophy where every pixel serves as a silent curator. We are not building a "website"; we are crafting a digital vault. 

The aesthetic moves beyond standard "minimalism" into "intentional void." By leveraging extreme white space, asymmetric layouts, and sophisticated tonal layering, we create a sense of rarity and value. The design breaks the rigid 12-column grid through overlapping elements—where a high-resolution product image might bleed off-screen or a serif headline might softly overlap a secondary container—mimicking the tactile experience of a luxury fashion monograph.

---

## 2. Colors & Surface Philosophy
The palette is rooted in a heritage-driven "Deep Emerald" and "Artisanal Gold," supported by a "Creamy White" foundation that feels warmer and more expensive than pure digital white.

### The Color Logic
- **Primary (`#003229`):** The Deep Emerald. Used for moments of high authority: headers, hero sections, and primary CTAs.
- **Secondary (`#735c00`):** The Gold. Used sparingly as a "hallmark" of quality—accents, interactive states, and iconography.
- **Surface (`#fbf9f4`):** The Creamy White. This is our canvas. It should feel like heavy, unboxed vellum paper.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to define sections. We define boundaries through **Background Color Shifts**. 
- A product description section (`surface-container-low`) should sit against a main page background (`surface`) without a visible seam. 
- Use the `outline-variant` only as a "Ghost Border" at 10% opacity for accessibility in form fields, never for layout containment.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers. Use the surface tiers to create depth:
1.  **Base:** `surface` (#fbf9f4)
2.  **Inset Content:** `surface-container-low` (#f5f3ee)
3.  **Floating Elements:** `surface-container-lowest` (#ffffff) for a "lifted" paper effect.

### The "Glass & Gradient" Rule
To add "soul" to the digital experience, use subtle linear gradients (e.g., `primary` to `primary_container`) on large buttons or hero backgrounds. For floating navigation or quick-view overlays, apply **Glassmorphism**: use a semi-transparent `surface` color with a `20px` backdrop-blur to allow jewelry textures to shimmer through the UI.

---

## 3. Typography
The typography system is a dialogue between the timeless `Noto Serif` and the modern, architectural `Manrope`.

- **Display (Display LG/MD/SM - Noto Serif):** These are our "statements." Use them for hero headlines and product titles. Letter spacing should be slightly tightened (-2%) to create a customized, logotype feel.
- **Headlines (Headline LG/MD/SM - Noto Serif):** Used for editorial storytelling and section titles.
- **Body (Body LG/MD/SM - Manrope):** The workhorse. Manrope’s clean geometry provides a high-contrast counterpoint to the Serif headings, ensuring modern legibility.
- **Labels (Label MD/SM - Manrope):** Set in uppercase with increased letter spacing (+10%) for a premium, "stamped" appearance on small UI elements.

---

## 4. Elevation & Depth
In this system, depth is felt, not seen. We move away from the "shadow-heavy" look of 2010s material design.

- **The Layering Principle:** Achieve hierarchy by "stacking." Place a `surface-container-lowest` card on a `surface-container-low` section. The microscopic shift in tone creates a natural, soft lift.
- **Ambient Shadows:** When an element must float (e.g., a "Book an Appointment" modal), use an ultra-diffused shadow: `Y: 20px, Blur: 40px, Color: #1b1c19 (5% Opacity)`. This mimics soft, overhead gallery lighting.
- **Glassmorphism:** Use for persistent elements like the global header. A 10% opacity `surface` fill with a heavy blur integrates the UI into the photography, making the content feel unified.

---

## 5. Components

### Buttons
- **Primary:** `primary` fill, `on_primary` text. Rectangular with a `0.25rem` (sm) radius. The slight rounding feels "tailored" rather than "industrial."
- **Secondary:** `outline` Ghost Border (20% opacity) with `primary` text. No fill.
- **Tertiary:** Text-only, using `label-md` (uppercase) with a `secondary` (Gold) underline of 1px that expands on hover.

### Input Fields
- **Style:** Underline only. Use `outline` for the bottom border. On focus, the border transitions to `secondary` (Gold). 
- **Error:** Use `error` (#ba1a1a) for the underline and helper text, but keep the label in `on_surface_variant` to maintain elegance.

### Cards & Lists
- **Rule:** **Strictly no dividers.** 
- **Separation:** Use `48px` or `64px` of vertical white space (from the Spacing Scale) to separate items. For product grids, use alternating `surface` and `surface-container-low` backgrounds to distinguish rows without using lines.

### Signature Component: The "Gallery Chip"
- Used for gemstone or metal selection. Instead of a standard dropdown, use circular chips with a `2px` `outline-variant` border. When selected, the border becomes `secondary` (Gold) with a subtle `2px` inner offset to mimic a jewelry setting.

---

## 6. Do's and Don'ts

### Do:
- **Embrace Asymmetry:** Place a `headline-lg` on the left and the `body-lg` on the right with a 1-column offset to create an editorial flow.
- **Use High-Resolution Cropping:** Let images of jewelry be the primary "decor." The UI should feel like a frame for the product.
- **Respect the "Breath":** If you think there is enough white space, add 16px more.

### Don't:
- **No Heavy Borders:** Never use 100% opaque borders for containers.
- **No Generic Icons:** Avoid thick, bubbly icons. Use "Refined" line icons with a `1px` stroke weight that matches the `outline` color.
- **No Vibrant Gradients:** Avoid "tech" gradients (blue to purple). Stick to tonal shifts within the Emerald and Gold families.
- **No Flat Gray Shadows:** Shadows must always be tinted with the `on_surface` color to maintain warmth.