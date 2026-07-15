import Alpine from "alpinejs";

window.Alpine = Alpine;
window.Alpine.start();

window.ajax = {
    async get(url, query = {}) {
        const params = new URLSearchParams(query).toString();
        const fullUrl = params ? `${url}?${params}` : url;
        const res = await fetch(fullUrl, {
            method: "GET",
            headers: {
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
            },
        });
        return res.json();
    },

    async post(url, data = {}) {
        const res = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },
            body: JSON.stringify(data),
        });
        return res.json();
    },
    async delete(url) {
        const res = await fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },
        });
        return res.json();
    },
    async patch(url, data = {}) {
        const res = await fetch(url, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },
            body: JSON.stringify(data),
        });
        return res.json();
    },
};

window.toast = function (message, type = "success") {
    const styles = {
        success:
            "background-color:var(--color-secondary-container);color:var(--color-on-secondary-fixed-variant)",
        error: "background-color:var(--color-error-container);color:var(--color-on-error-container)",
        warning:
            "background-color:var(--color-tertiary-fixed);color:var(--color-on-tertiary-fixed-variant)",
    };
    const el = document.createElement("div");
    el.setAttribute(
        "style",
        `
        position:fixed; top:16px; right:16px; z-index:9999;
        ${styles[type] ?? styles.success};
        padding: 12px 24px;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        font-size: 14px;
        font-weight: 500;
        font-family: Geist, sans-serif;
        transition: opacity 0.3s ease;
    `,
    );
    el.textContent = message;
    document.body.appendChild(el);
    setTimeout(() => {
        el.style.opacity = "0";
        setTimeout(() => el.remove(), 300);
    }, 3000);
};
