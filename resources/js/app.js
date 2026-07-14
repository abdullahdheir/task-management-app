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
    const colors = {
        success: "bg-secondary-container text-on-secondary-fixed-variant",
        error: "bg-error-container text-on-error-container",
        warning: "bg-tertiary-fixed text-tertiary",
    };
    const el = document.createElement("div");
    el.className = `fixed top-4 right-4 z-[999] ${colors[type] ?? colors.success} px-6 py-3 rounded-xl shadow-lg font-label-md text-label-md transition-all duration-300`;
    el.textContent = message;
    document.body.appendChild(el);
    setTimeout(() => {
        el.style.opacity = "0";
        setTimeout(() => el.remove(), 300);
    }, 3000);
};
