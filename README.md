
# Periplia

**Periplia** est une application web de gestion et de planification de voyages collaboratifs, développée avec **Laravel**, **Vite**, **MySQL** et un design moderne en CSS pur. Elle permet aux utilisateurs de s’inscrire, de se connecter, de créer des voyages, de gérer des activités et d’inviter d’autres participants, le tout dans une interface claire et responsive.

---

## 📋 Description du projet

Periplia propose :
- **Authentification sécurisée** (connexion, inscription, récupération de mot de passe)
- **Création et gestion de voyages** (nom, destination, dates, description, image de couverture)
- **Gestion des activités et itinéraires** par voyage
- **Catégorisation des voyages**
- **Connexion sociale** (Google)
- **Interface utilisateur moderne**
- **Modèle de données robuste** 

---

## 🚀 Installation

### Prérequis

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB

### Étapes

1. **Cloner le dépôt**
git clone https://github.com/votre-utilisateur/periplia.git
cd periplia

text

2. **Installer les dépendances backend**
composer install

text

3. **Installer les dépendances frontend**
npm install

text

4. **Configurer l’environnement**
- Copier `.env.example` en `.env`
- Renseigner les variables (BDD, mail, etc.)

5. **Générer la clé d’application**
php artisan key:generate

text

6. **Migrer la base de données**
php artisan migrate

text

7. **Compiler les assets**
npm run dev

text
(ou `npm run build` pour la prod)

8. **Démarrer le serveur**
php artisan serve

text

---

## 🛠️ Usage et fonctionnalités

### Authentification

- **Connexion** :  
Formulaire épuré avec logo, email, mot de passe, “se souvenir de moi”, connexion sociale (Google), gestion des erreurs stylisée.


- **Inscription** :  
Formulaire complet avec avatar, description, nom, prénom, email, date de naissance, mot de passe et confirmation.  


- **Récupération de mot de passe** :  
Lien accessible depuis la page de connexion.

### Gestion des voyages

- **Créer un voyage** :  
Formulaire en deux sections (infos principales, personnalisation), upload ou URL d’image de couverture, champs structurés et validation.

- **Modèle de données** :  
Gestion des utilisateurs, voyages, activités, catégories selon le MCD.


### Sécurité

- Validation serveur et client
- Hashage des mots de passe
- Protection CSRF
- Authentification Laravel sécurisée

### Design & accessibilité

- **CSS pur** (pas de Bootstrap, pas de Tailwind)
- Polices : Montserrat,  Lato & Edu TAS Beginner  (Google Fonts)
- Responsive, contrastes doux, boutons accessibles

---

## 💡 Conseils pour les développeurs

- **Logos sociaux** : Placez les SVG dans `public/images/` et utilisez `<img>` pour un rendu net et rapide.
- **Images de couverture** : Privilégiez l’upload local, mais l’ajout par URL est aussi supporté.
- **Personnalisation** : Modifiez les couleurs et le CSS dans `resources/css/` pour adapter l’UI à vos besoins.
- **Gestion des erreurs** : Les messages sont affichés de façon claire et stylisée sous chaque formulaire.

---

## 📚 Ressources

- [Laravel Documentation](https://laravel.com/docs)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Google Fonts Montserrat & Lato](https://fonts.google.com/)

---

## 📝 Auteurs & Contributeurs

Projet réalisé par Indira Ramirez.

---

## 📄 Licence

Ce projet est sous licence MIT.

---

**Bon voyage avec Periplia !**