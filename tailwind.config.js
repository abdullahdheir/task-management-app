/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                // ─── Surface ───────────────────────────────────────
                "surface": {
                    DEFAULT: "#f8f9ff",
                    dark:    "#0b1326",
                },
                "surface-dim": {
                    DEFAULT: "#cbdbf5",
                    dark:    "#0b1326",
                },
                "surface-bright": {
                    DEFAULT: "#f8f9ff",
                    dark:    "#31394d",
                },
                "surface-container-lowest": {
                    DEFAULT: "#ffffff",
                    dark:    "#060e20",
                },
                "surface-container-low": {
                    DEFAULT: "#eff4ff",
                    dark:    "#131b2e",
                },
                "surface-container": {
                    DEFAULT: "#e5eeff",
                    dark:    "#171f33",
                },
                "surface-container-high": {
                    DEFAULT: "#dce9ff",
                    dark:    "#222a3d",
                },
                "surface-container-highest": {
                    DEFAULT: "#d3e4fe",
                    dark:    "#2d3449",
                },
                "surface-variant": {
                    DEFAULT: "#d3e4fe",
                    dark:    "#2d3449",
                },
                "surface-tint": {
                    DEFAULT: "#4d44e3",
                    dark:    "#c0c1ff",
                },

                // ─── On Surface ────────────────────────────────────
                "on-surface": {
                    DEFAULT: "#0b1c30",
                    dark:    "#dae2fd",
                },
                "on-surface-variant": {
                    DEFAULT: "#464555",
                    dark:    "#c7c4d7",
                },

                // ─── Background ────────────────────────────────────
                "background": {
                    DEFAULT: "#f8f9ff",
                    dark:    "#0b1326",
                },
                "on-background": {
                    DEFAULT: "#0b1c30",
                    dark:    "#dae2fd",
                },

                // ─── Inverse ───────────────────────────────────────
                "inverse-surface": {
                    DEFAULT: "#213145",
                    dark:    "#dae2fd",
                },
                "inverse-on-surface": {
                    DEFAULT: "#eaf1ff",
                    dark:    "#283044",
                },

                // ─── Outline ───────────────────────────────────────
                "outline": {
                    DEFAULT: "#777587",
                    dark:    "#908fa0",
                },
                "outline-variant": {
                    DEFAULT: "#c7c4d8",
                    dark:    "#464554",
                },

                // ─── Primary ───────────────────────────────────────
                "primary": {
                    DEFAULT: "#3525cd",
                    dark:    "#c0c1ff",
                },
                "on-primary": {
                    DEFAULT: "#ffffff",
                    dark:    "#1000a9",
                },
                "primary-container": {
                    DEFAULT: "#4f46e5",
                    dark:    "#8083ff",
                },
                "on-primary-container": {
                    DEFAULT: "#dad7ff",
                    dark:    "#0d0096",
                },
                "inverse-primary": {
                    DEFAULT: "#c3c0ff",
                    dark:    "#494bd6",
                },
                "primary-fixed": {
                    DEFAULT: "#e2dfff",
                    dark:    "#e1e0ff",
                },
                "primary-fixed-dim": {
                    DEFAULT: "#c3c0ff",
                    dark:    "#c0c1ff",
                },
                "on-primary-fixed": {
                    DEFAULT: "#0f0069",
                    dark:    "#07006c",
                },
                "on-primary-fixed-variant": {
                    DEFAULT: "#3323cc",
                    dark:    "#2f2ebe",
                },

                // ─── Secondary ─────────────────────────────────────
                "secondary": {
                    DEFAULT: "#006c49",
                    dark:    "#b9c8de",
                },
                "on-secondary": {
                    DEFAULT: "#ffffff",
                    dark:    "#233143",
                },
                "secondary-container": {
                    DEFAULT: "#6cf8bb",
                    dark:    "#39485a",
                },
                "on-secondary-container": {
                    DEFAULT: "#00714d",
                    dark:    "#a7b6cc",
                },
                "secondary-fixed": {
                    DEFAULT: "#6ffbbe",
                    dark:    "#d4e4fa",
                },
                "secondary-fixed-dim": {
                    DEFAULT: "#4edea3",
                    dark:    "#b9c8de",
                },
                "on-secondary-fixed": {
                    DEFAULT: "#002113",
                    dark:    "#0d1c2d",
                },
                "on-secondary-fixed-variant": {
                    DEFAULT: "#005236",
                    dark:    "#39485a",
                },

                // ─── Tertiary ──────────────────────────────────────
                "tertiary": {
                    DEFAULT: "#684000",
                    dark:    "#ffb783",
                },
                "on-tertiary": {
                    DEFAULT: "#ffffff",
                    dark:    "#4f2500",
                },
                "tertiary-container": {
                    DEFAULT: "#885500",
                    dark:    "#d97721",
                },
                "on-tertiary-container": {
                    DEFAULT: "#ffd4a4",
                    dark:    "#452000",
                },
                "tertiary-fixed": {
                    DEFAULT: "#ffddb8",
                    dark:    "#ffdcc5",
                },
                "tertiary-fixed-dim": {
                    DEFAULT: "#ffb95f",
                    dark:    "#ffb783",
                },
                "on-tertiary-fixed": {
                    DEFAULT: "#2a1700",
                    dark:    "#301400",
                },
                "on-tertiary-fixed-variant": {
                    DEFAULT: "#653e00",
                    dark:    "#703700",
                },

                // ─── Error ─────────────────────────────────────────
                "error": {
                    DEFAULT: "#ba1a1a",
                    dark:    "#ffb4ab",
                },
                "on-error": {
                    DEFAULT: "#ffffff",
                    dark:    "#690005",
                },
                "error-container": {
                    DEFAULT: "#ffdad6",
                    dark:    "#93000a",
                },
                "on-error-container": {
                    DEFAULT: "#93000a",
                    dark:    "#ffdad6",
                },
            },

            // ─── Border Radius ─────────────────────────────────────
            borderRadius: {
                sm:      "0.25rem",   // 4px  — checkboxes, tags
                DEFAULT: "0.5rem",    // 8px  — buttons, inputs
                md:      "0.75rem",   // 12px
                lg:      "1rem",      // 16px — cards, modals
                xl:      "1.5rem",    // 24px — hero sections
                full:    "9999px",    // pills
            },

            // ─── Spacing ───────────────────────────────────────────
            spacing: {
                // Light design.md tokens
                "base":             "8px",
                "stack-sm":         "4px",
                "stack-md":         "12px",
                "stack-lg":         "24px",
                "gutter-mobile":    "16px",
                "gutter-desktop":   "24px",
                "container-max":    "1200px",
                // Dark design.md extras
                "unit":             "4px",
                "gutter":           "24px",
                "margin-desktop":   "64px",
                "margin-mobile":    "16px",
            },

            // ─── Font Family ───────────────────────────────────────
            fontFamily: {
                "display":              ["Geist", "sans-serif"],
                "headline-lg":          ["Geist", "sans-serif"],
                "headline-lg-mobile":   ["Geist", "sans-serif"],
                "headline-md":          ["Geist", "sans-serif"],
                "body-lg":              ["Geist", "sans-serif"],
                "body-md":              ["Geist", "sans-serif"],
                "label-md":             ["Geist", "sans-serif"],
                "label-sm":             ["Geist", "sans-serif"],
                "code":                 ["Geist Mono", "Geist", "monospace"],
                "ui-label":             ["Geist", "sans-serif"],
                "ui-button":            ["Geist", "sans-serif"],
                "metadata":             ["Geist", "sans-serif"],
            },

            // ─── Font Size ─────────────────────────────────────────
            // Light design.md values (base), dark design.md adds display scale
            fontSize: {
                "display": [
                    "56px",
                    {
                        lineHeight:    "64px",
                        letterSpacing: "-0.02em",
                        fontWeight:    "600",
                    },
                ],
                "headline-lg": [
                    "32px",
                    {
                        lineHeight:    "40px",
                        letterSpacing: "-0.02em",
                        fontWeight:    "600",
                    },
                ],
                "headline-lg-mobile": [
                    "24px",
                    {
                        lineHeight:    "32px",
                        letterSpacing: "-0.02em",
                        fontWeight:    "600",
                    },
                ],
                "headline-md": [
                    "20px",
                    {
                        lineHeight:    "28px",
                        letterSpacing: "-0.01em",
                        fontWeight:    "600",
                    },
                ],
                "body-lg": [
                    "16px",
                    {
                        lineHeight:    "24px",
                        letterSpacing: "0",
                        fontWeight:    "400",
                    },
                ],
                "body-md": [
                    "14px",
                    {
                        lineHeight:    "20px",
                        letterSpacing: "0",
                        fontWeight:    "400",
                    },
                ],
                "label-md": [
                    "12px",
                    {
                        lineHeight:    "16px",
                        letterSpacing: "0.02em",
                        fontWeight:    "500",
                    },
                ],
                "label-sm": [
                    "11px",
                    {
                        lineHeight:    "14px",
                        letterSpacing: "0.03em",
                        fontWeight:    "500",
                    },
                ],
                "code": [
                    "14px",
                    {
                        lineHeight:    "20px",
                        letterSpacing: "0",
                        fontWeight:    "400",
                    },
                ],
                // Aliases used in existing Blade files
                "ui-label":  ["12px",  { lineHeight: "16px",  fontWeight: "500" }],
                "ui-button": ["14px",  { lineHeight: "20px",  fontWeight: "500" }],
                "metadata":  ["11px",  { lineHeight: "14px",  fontWeight: "400" }],
                "display-lg-mobile": [
                    "24px",
                    {
                        lineHeight:    "32px",
                        letterSpacing: "-0.02em",
                        fontWeight:    "700",
                    },
                ],
            },

            // ─── Box Shadow ────────────────────────────────────────
            boxShadow: {
                "elevation-1": "0px 4px 6px -1px rgba(0,0,0,0.05), 0px 2px 4px -1px rgba(0,0,0,0.03)",
                "elevation-2": "0px 20px 25px -5px rgba(0,0,0,0.1), 0px 10px 10px -5px rgba(0,0,0,0.04)",
                "elevation-dark": "0 0 0 1px rgba(255,255,255,0.06), 0 4px 24px rgba(0,0,0,0.4)",
                "glow-primary": "0 0 20px rgba(53,37,205,0.15)",
                "glow-primary-dark": "0 0 20px rgba(192,193,255,0.2)",
            },

            // ─── Max Width ─────────────────────────────────────────
            maxWidth: {
                "container-max": "1200px",
            },
        },
    },

    plugins: [],
};
