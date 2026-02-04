import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import initContactForm from "./contact-form";

// -------------------------------
// Configuración de Alpine
// -------------------------------
window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

// -------------------------------
// Navbar mobile toggle
// -------------------------------
(() => {
    const btn = document.querySelector("[data-nav-toggle]");
    const menu = document.querySelector("[data-nav-menu]");

    if (!btn || !menu) return;

    const openIcon = btn.querySelector('[data-nav-icon="open"]');
    const closeIcon = btn.querySelector('[data-nav-icon="close"]');

    const setOpen = (open) => {
        btn.setAttribute("aria-expanded", open ? "true" : "false");
        menu.classList.toggle("hidden", !open);

        if (openIcon && closeIcon) {
            openIcon.classList.toggle("hidden", open);
            closeIcon.classList.toggle("hidden", !open);
        }
    };

    btn.addEventListener("click", () => {
        const isOpen = btn.getAttribute("aria-expanded") === "true";
        setOpen(!isOpen);
    });

    menu.querySelectorAll("[data-nav-link]").forEach((link) => {
        link.addEventListener("click", () => setOpen(false));
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") setOpen(false);
    });
})();

// -------------------------------
// Smooth scroll para anchors (#)
// -------------------------------
(() => {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (!href || href === "#") return;

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        });
    });
})();

// -------------------------------
// Reveal on scroll
// -------------------------------
(() => {
    const els = document.querySelectorAll(".reveal");
    if (!("IntersectionObserver" in window) || !els.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                }
            });
        },
        { threshold: 0.1, rootMargin: "0px 0px -100px 0px" },
    );

    els.forEach((el) => observer.observe(el));
})();

// -------------------------------
// Dark Mode Toggle Logic
// -------------------------------
(() => {
    const theme =
        localStorage.getItem("theme") ||
        (window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light");

    if (theme === "dark") document.documentElement.classList.add("dark");

    window.toggleTheme = () => {
        const isDark = document.documentElement.classList.toggle("dark");
        localStorage.setItem("theme", isDark ? "dark" : "light");
    };
})();

// -------------------------------
// Inicializar formulario de contacto
// -------------------------------
(() => {
    // Si el DOM ya está cargado
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", () => {
            initContactForm("contact-form");
        });
    } else {
        initContactForm("contact-form");
    }
})();
