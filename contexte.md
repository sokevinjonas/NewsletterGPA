# 📬 Laravel Newsletter App – Instructions pour GitHub Copilot

## 🎯 Objectif général

Créer une application Laravel Blade pour gérer une **newsletter**, avec :

-   Authentification (déjà gérée avec Laravel Breeze)
-   Gestion des abonnés (`subscribers`)
-   Gestion des contenus de mail (`templates`)
-   Envoi d’un contenu sélectionné à tous les abonnés (via un `job`)

---

## ✅ Ce qui est déjà prêt

-   Laravel Breeze est installé (`php artisan breeze:install blade`)
-   Authentification déjà fonctionnelle
-   Migrations pour `subscribers` et `templates` déjà créées
-   Contrôleurs de base déjà générés :
    -   `SubscriberController`
    -   `TemplateController`
    -   `MailController`

---

## 📌 Étapes que tu dois coder

### 1. Création des vues Blade suivantes :

#### `resources/views/dashboard.blade.php`

-   Page d’accueil admin
-   Affiche des stats simples : nombre d’abonnés, nombre de templates

#### `resources/views/subscribers/index.blade.php`

-   Tableau listant tous les abonnés (`id`, `email`, `date d’inscription`)
-   Bouton "Ajouter un abonné manuellement" (optionnel)

#### `resources/views/templates/index.blade.php`

-   Liste des contenus de mail (`title`, preview du `content`)
-   Bouton "Créer un nouveau contenu"

#### `resources/views/templates/create.blade.php`

-   Formulaire de création de template :
    -   Titre (`title`)
    -   Contenu HTML (`content`)
    -   Bouton `Créer`

#### `resources/views/newsletter/send.blade.php`

-   Formulaire pour envoyer un mail à tous les abonnés :
    -   Select des templates disponibles (`template_id`)
    -   Bouton `Envoyer`
    -   Affichage des erreurs / succès

---

### 2. Ajout ou complétion des méthodes dans les contrôleurs :

#### `SubscriberController@index`

-   Récupérer tous les abonnés et passer à la vue `subscribers.index`

#### `TemplateController@index`

-   Récupérer tous les templates et les afficher

#### `TemplateController@create`

-   Retourner la vue de création

#### `TemplateController@store`

-   Valider les champs `title` et `content`
-   Créer le template
-   Rediriger avec message de succès

#### `MailController@showSendForm`

-   Charger tous les templates
-   Retourner la vue `newsletter.send`

#### `MailController@send`

-   Valider `template_id`
-   Récupérer tous les abonnés
-   Lancer un job `SendNewsletterJob` pour chaque abonné

---

### 3. Création du job `SendNewsletterJob`

Dans `app/Jobs/SendNewsletterJob.php` :

-   Ce job doit recevoir un `Subscriber` et un `Template`
-   Il envoie le mail en utilisant `Mail::send()` avec `setBody($template->content, 'text/html')`

---

### 4. Mises à jour des routes dans `routes/web.php`

Ajouter les routes suivantes :

```php
// protégées par 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/templates', [TemplateController::class, 'store'])->name('templates.store');

    Route::get('/newsletter/send', [MailController::class, 'showSendForm'])->name('newsletter.send.form');
    Route::post('/newsletter/send', [MailController::class, 'send'])->name('newsletter.send');
});
```
