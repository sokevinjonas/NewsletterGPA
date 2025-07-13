function newsletterMenu() {
    return {
        open: false,
        showModal: false,
        page: 1,
        perPage: 50,
        mails: [], // À remplir dynamiquement côté backend ou via API
        templates: [], // À remplir dynamiquement côté backend ou via API
        selectedTemplate: "",
        templateContent: "",
        sendTo: "all",
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
        sendNewsletter() {
            // À implémenter : appel AJAX pour envoyer la newsletter
            alert(
                "Newsletter envoyée à " +
                    (this.sendTo === "all"
                        ? "tout le monde"
                        : "ceux inscrits cette semaine")
            );
            this.showModal = false;
        },
    };
}
