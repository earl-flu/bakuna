const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");
const Color = require("color");
const colors = require("tailwindcss/colors");

module.exports = {
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ], //'public/**/*.html'
    theme: {
        themeVariants: ["dark"],
        customForms: (theme) => ({
            default: {
                "input, textarea": {
                    "&::placeholder": {
                        color: theme("colors.gray.400"),
                    },
                },
            },
        }),
        colors: {
            light: "var(--light)",
            dark: "var(--dark)",
            darker: "var(--darker)",
            transparent: "transparent",
            white: "#ffffff",
            black: "#000000",

            primary: {
                DEFAULT: "var(--color-primary)",
                50: "var(--color-primary-50)",
                100: "var(--color-primary-100)",
                light: "var(--color-primary-light)",
                lighter: "var(--color-primary-lighter)",
                dark: "var(--color-primary-dark)",
                darker: "var(--color-primary-darker)",
            },
            secondary: {
                DEFAULT: colors.fuchsia[600],
                50: colors.fuchsia[50],
                100: colors.fuchsia[100],
                light: colors.fuchsia[500],
                lighter: colors.fuchsia[400],
                dark: colors.fuchsia[700],
                darker: colors.fuchsia[800],
            },
            success: {
                DEFAULT: colors.green[600],
                50: colors.green[50],
                100: colors.green[100],
                light: colors.green[500],
                lighter: colors.green[400],
                dark: colors.green[700],
                darker: colors.green[800],
            },
            warning: {
                DEFAULT: colors.orange[600],
                50: colors.orange[50],
                100: colors.orange[100],
                light: colors.orange[500],
                lighter: colors.orange[400],
                dark: colors.orange[700],
                darker: colors.orange[800],
            },
            danger: {
                DEFAULT: colors.red[600],
                50: colors.red[50],
                100: colors.red[100],
                light: colors.red[500],
                lighter: colors.red[400],
                dark: colors.red[700],
                darker: colors.red[800],
            },
            info: {
                DEFAULT: colors.cyan[600],
                50: colors.cyan[50],
                100: colors.cyan[100],
                light: colors.cyan[500],
                lighter: colors.cyan[400],
                dark: colors.cyan[700],
                darker: colors.cyan[800],
            },
            //#########//
            gray: {
                50: "#f9fafb",
                100: "#f4f5f7",
                200: "#e5e7eb",
                300: "#d5d6d7",
                400: "#9e9e9e",
                500: "#707275",
                600: "#4c4f52",
                700: "#24262d",
                800: "#1a1c23",
                900: "#121317",
            },
            "cool-gray": {
                50: "#fbfdfe",
                100: "#f1f5f9",
                200: "#e2e8f0",
                300: "#cfd8e3",
                400: "#97a6ba",
                500: "#64748b",
                600: "#475569",
                700: "#364152",
                800: "#27303f",
                900: "#1a202e",
            },
            red: {
                50: "#fdf2f2",
                100: "#fde8e8",
                200: "#fbd5d5",
                300: "#f8b4b4",
                400: "#f98080",
                500: "#f05252",
                600: "#e02424",
                700: "#c81e1e",
                800: "#9b1c1c",
                900: "#771d1d",
            },
            orange: {
                50: "#fff8f1",
                100: "#feecdc",
                200: "#fcd9bd",
                300: "#fdba8c",
                400: "#ff8a4c",
                500: "#ff5a1f",
                600: "#d03801",
                700: "#b43403",
                800: "#8a2c0d",
                900: "#771d1d",
            },
            yellow: {
                50: "#fdfdea",
                100: "#fdf6b2",
                200: "#fce96a",
                300: "#faca15",
                400: "#e3a008",
                500: "#c27803",
                600: "#9f580a",
                700: "#8e4b10",
                800: "#723b13",
                900: "#633112",
            },
            green: {
                50: "#f3faf7",
                100: "#def7ec",
                200: "#bcf0da",
                300: "#84e1bc",
                400: "#31c48d",
                500: "#0e9f6e",
                600: "#057a55",
                700: "#046c4e",
                800: "#03543f",
                900: "#014737",
            },
            teal: {
                50: "#edfafa",
                100: "#d5f5f6",
                200: "#afecef",
                300: "#7edce2",
                400: "#16bdca",
                500: "#0694a2",
                600: "#047481",
                700: "#036672",
                800: "#05505c",
                900: "#014451",
            },
            blue: {
                50: "#ebf5ff",
                100: "#e1effe",
                200: "#c3ddfd",
                300: "#a4cafe",
                400: "#76a9fa",
                500: "#3f83f8",
                600: "#1c64f2",
                700: "#1a56db",
                800: "#1e429f",
                900: "#233876",
            },
            indigo: {
                50: "#f0f5ff",
                100: "#e5edff",
                200: "#cddbfe",
                300: "#b4c6fc",
                400: "#8da2fb",
                500: "#6875f5",
                600: "#5850ec",
                700: "#5145cd",
                800: "#42389d",
                900: "#362f78",
            },
            purple: {
                50: "#f6f5ff",
                100: "#edebfe",
                200: "#dcd7fe",
                300: "#cabffd",
                400: "#ac94fa",
                500: "#9061f9",
                600: "#7e3af2",
                // 600: colors.green[400],
                // 600: "var(--color-primary)",
                700: "#6c2bd9",
                800: "#5521b5",
                900: "#4a1d96",
            },
            pink: {
                50: "#fdf2f8",
                100: "#fce8f3",
                200: "#fad1e8",
                300: "#f8b4d9",
                400: "#f17eb8",
                500: "#e74694",
                600: "#d61f69",
                700: "#bf125d",
                800: "#99154b",
                900: "#751a3d",
            },
        },
        extend: {
            maxHeight: {
                0: "0",
                xl: "36rem",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        backgroundColor: [
            "hover",
            "focus",
            "active",
            "odd",
            "dark",
            "dark:hover",
            "dark:focus",
            "dark:active",
            "dark:odd",
        ],
        display: ["responsive", "dark"],
        textColor: [
            "focus-within",
            "hover",
            "active",
            "dark",
            "dark:focus-within",
            "dark:hover",
            "dark:active",
        ],
        placeholderColor: ["focus", "dark", "dark:focus"],
        borderColor: ["focus", "hover", "dark", "dark:focus", "dark:hover"],
        divideColor: ["dark"],
        boxShadow: ["focus", "dark:focus"],
    },
    plugins: [
        require("tailwindcss-multi-theme"),
        require("@tailwindcss/custom-forms"),
        // plugin(({ addUtilities, e, theme, variants }) => {
        //     const newUtilities = {};
        //     Object.entries(theme("colors")).map(([name, value]) => {
        //         if (name === "transparent" || name === "current") return;
        //         const color = value[300] ? value[300] : value;
        //         const hsla = Color(color).alpha(0.45).hsl().string();

        //         newUtilities[`.shadow-outline-${name}`] = {
        //             "box-shadow": `0 0 0 3px ${hsla}`,
        //         };
        //     });

        //     addUtilities(newUtilities, variants("boxShadow"));
        // }),
    ],
};