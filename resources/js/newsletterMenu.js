function newsletterMenu() {
    return {
        open: false,
        showModal: false,
        page: 1,
        perPage: 50,
        mails: [],
        templates: [],
        selectedTemplate: "",
        templateContent: "",
        sendTo: "all",
        loading: false,
        paginatedMails() {
            const start = (this.page - 1) * this.perPage;
            return this.mails.slice(start, start + this.perPage);
        },
        totalPages() {
            return Math.ceil(this.mails.length / this.perPage) || 1;
        },
        nextPage() {
            if (this.page < this.totalPages()) this.page++;
        },
        prevPage() {
            if (this.page > 1) this.page--;
        },
        updateTemplateContent() {
            const tpl = this.templates.find(
                (t) => t.id == this.selectedTemplate
            );
            this.templateContent = tpl ? tpl.content : "";
        },
        async fetchTemplates() {
            const res = await fetch("/api/templates");
            this.templates = await res.json();
        },
        async fetchMails() {
            const res = await fetch("/api/newsletter-logs");
            const data = await res.json();
            this.mails = data.data.map((log) => ({
                id: log.id,
                title: log.title,
                date: new Date(log.created_at).toLocaleString("fr-FR"),
            }));
        },
        async sendNewsletter() {
            if (!this.selectedTemplate) return;
            this.loading = true;
            const res = await fetch("/newsletter/send", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        "meta[name=csrf-token]"
                    ).content,
                },
                body: JSON.stringify({
                    template_id: this.selectedTemplate,
                    send_to: this.sendTo,
                }),
            });
            this.loading = false;
            if (res.ok) {
                alert("Newsletter envoyée !");
                this.showModal = false;
                this.fetchMails();
            } else {
                alert("Erreur lors de l'envoi");
            }
        },
        async init() {
            await this.fetchTemplates();
            await this.fetchMails();
        },
    };
}
document.addEventListener("alpine:init", () => {
    Alpine.data("newsletterMenu", newsletterMenu);
});
