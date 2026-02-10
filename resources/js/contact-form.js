// resources/js/contact-form.js
console.log("🔧 initContactForm cargado y listo");

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

    // ⚡ Evitar inicialización múltiple
    if (form.dataset.initialized === "1") return;
    form.dataset.initialized = "1";

    const phoneInput = form.querySelector("#phone");
    const recaptchaInput = form.querySelector("#g-recaptcha-response");
    const submitBtn = form.querySelector("#contact-submit");

    // -------------------------------
    // SiteKey desde env Vite o data attribute
    // -------------------------------
    const siteKey =
        import.meta.env.VITE_RECAPTCHA_SITE_KEY || form.dataset.recaptchaKey;

    if (!siteKey) {
        console.error(
            "⚠️ reCAPTCHA no configurado. Revisá VITE_RECAPTCHA_SITE_KEY o data-recaptcha-key en el form",
        );
        return;
    }
    console.log(
        "✅ reCAPTCHA Site Key cargada:",
        siteKey.substring(0, 20) + "...",
    );

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
    // Validación mínima
    // -------------------------------
    function validateForm() {
        const requiredFields = form.querySelectorAll("[required]");
        for (let field of requiredFields) {
            if (!field.value.trim()) {
                field.focus();
                alert(`El campo "${field.name}" es obligatorio`);
                return false;
            }
        }
        return true;
    }

    console.log("✅ Formulario de contacto inicializado");

    // -------------------------------
    // Variable para controlar el envío
    // -------------------------------
    let isSubmitting = false;

    // -------------------------------
    // Submit handler
    // -------------------------------
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        console.log("📤 Intentando enviar formulario...");

        // ⚡ Evitar doble submit
        if (isSubmitting) {
            console.warn("⚠️ Ya se está enviando el formulario, ignorando...");
            return;
        }

        // Validación básica
        if (!validateForm()) {
            return;
        }

        // Normalizar teléfono
        if (iti && phoneInput) {
            const fullNumber = iti.getNumber();
            if (fullNumber) {
                phoneInput.value = fullNumber;
            }
        }

        // Verificar que grecaptcha esté disponible
        if (!window.grecaptcha) {
            console.error("❌ grecaptcha no está disponible");
            alert(
                "Error: reCAPTCHA no se cargó correctamente. Recargá la página.",
            );
            return;
        }

        // Marcar como enviando
        isSubmitting = true;
        submitBtn.disabled = true;
        const originalText = submitBtn.textContent;
        submitBtn.textContent = "Verificando...";

        // Generar token FRESCO y enviar inmediatamente
        grecaptcha.ready(() => {
            console.log("🔒 Ejecutando reCAPTCHA...");

            grecaptcha
                .execute(siteKey, { action: "contact" })
                .then((token) => {
                    if (!token) {
                        throw new Error("No se generó token de reCAPTCHA");
                    }

                    console.log(
                        "✅ Token reCAPTCHA generado (longitud:",
                        token.length,
                        ")",
                    );

                    // Insertar token fresco
                    recaptchaInput.value = token;

                    // Cambiar texto del botón
                    submitBtn.textContent = "Enviando...";

                    // ⚡ ENVIAR INMEDIATAMENTE (sin delays)
                    console.log("📨 Enviando formulario ahora...");
                    form.submit();
                })
                .catch((err) => {
                    console.error("❌ Error en reCAPTCHA:", err);
                    alert(
                        "No pudimos validar el formulario. Por favor, intentá de nuevo.",
                    );

                    // Resetear para permitir reintento
                    isSubmitting = false;
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        });
    });
}
