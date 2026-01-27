import "./bootstrap";

/*
|--------------------------------------------------------------------------
| Navbar mobile toggle (sin librerías)
|--------------------------------------------------------------------------
*/
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

    // Cerrar menú al hacer click en un link
    menu.querySelectorAll("[data-nav-link]").forEach((link) => {
        link.addEventListener("click", () => setOpen(false));
    });

    // Cerrar con ESC
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") setOpen(false);
    });
})();

/*
|--------------------------------------------------------------------------
| Smooth scroll para anchors (#)
|--------------------------------------------------------------------------
*/
(() => {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const target = document.querySelector(this.getAttribute("href"));
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        });
    });
})();
