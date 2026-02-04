// resources/js/contact-form.js
import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

/**
 * Inicializa el formulario de contacto:
 * - Teléfono internacional
 * - reCAPTCHA v3 invisible
 * - Prevención de doble submit
 * - Validación mínima de campos
 *
 * @param {string} formId
 */
export default function initContactForm(formId = "contact-form") {
    const form = document.getElementById(formId);
    if (!form) return;

    const phoneInput = form.querySelector("#phone");
    const recaptchaInput = form.querySelector("#g-recaptcha-response");
    const submitBtn = form.querySelector("#contact-submit");

    // -------------------------------
    // SiteKey desde env de Vite
    // -------------------------------
    const siteKey = import.meta.env.VITE_RECAPTCHA_SITE_KEY;
    if (!siteKey) {
        console.error(
            "⚠️ reCAPTCHA no configurado. Revisa VITE_RECAPTCHA_SITE_KEY en .env",
        );
        return;
    }

    // -------------------------------
    // Inicializar phone input
    // -------------------------------
    let iti = null;
    if (phoneInput) {
        iti = intlTelInput(phoneInput, {
            initialCountry: "auto",
            separateDialCode: true,
            nationalMode: false,
            geoIpLookup: (callback) => {
                fetch("https://ipapi.co/json/")
                    .then((res) => res.json())
                    .then((data) => callback(data.country_code))
                    .catch(() => callback("AR"));
            },
        });
    }

    // -------------------------------
    // Cargar reCAPTCHA dinámicamente
    // -------------------------------
    function loadRecaptchaScript() {
        return new Promise((resolve) => {
            if (window.grecaptcha) return resolve();

            const script = document.createElement("script");
            script.src = `https://www.google.com/recaptcha/api.js?render=${siteKey}`;
            script.async = true;
            script.defer = true;
            script.onload = () => resolve();
            script.onerror = () => {
                console.error("Error al cargar reCAPTCHA");
                resolve(); // evita bloquear el submit
            };
            document.head.appendChild(script);
        });
    }

    // -------------------------------
    // Validación mínima
    // -------------------------------
    function validateForm() {
        const requiredFields = form.querySelectorAll("[required]");
        for (let field of requiredFields) {
            if (!field.value.trim()) {
                field.focus();
                return false;
            }
        }
        return true;
    }

    // -------------------------------
    // Submit handler
    // -------------------------------
    form.addEventListener("submit", async (e) => {
        if (submitBtn.dataset.submitted === "1") return;
        e.preventDefault();

        // Validación básica
        if (!validateForm()) return;

        // Normalizar teléfono
        if (iti && phoneInput) {
            const number = iti.getNumber();
            phoneInput.value = number || phoneInput.value.trim();
        }

        try {
            await loadRecaptchaScript();

            if (window.grecaptcha && recaptchaInput) {
                grecaptcha.ready(async () => {
                    try {
                        const token = await grecaptcha.execute(siteKey, {
                            action: "contact",
                        });
                        recaptchaInput.value = token;

                        // Evitar doble submit
                        submitBtn.dataset.submitted = "1";
                        submitBtn.disabled = true;

                        // Enviar formulario
                        form.submit();
                    } catch (err) {
                        console.error("reCAPTCHA execute failed:", err);
                        alert(
                            "No pudimos validar el formulario. Probá de nuevo.",
                        );
                    }
                });
            } else {
                // Fallback si no hay grecaptcha
                submitBtn.dataset.submitted = "1";
                submitBtn.disabled = true;
                form.submit();
            }
        } catch (err) {
            console.error("Error cargando reCAPTCHA:", err);
            alert("No pudimos validar el formulario. Probá de nuevo.");
        }
    });
}
