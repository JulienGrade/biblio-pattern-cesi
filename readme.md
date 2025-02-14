# 📚 Bibliothèque - Gestion des Emprunts avec Design Patterns

Bienvenue dans ce projet de gestion d'une bibliothèque 🏛️ !  
Ce projet met en œuvre plusieurs **Design Patterns** en PHP, notamment :
- **Factory**
- **Decorator**
- **Strategy**
- **Observer**
- **MVC**

Le projet utilise **PHP 8+**, **MySQL**, et **Composer** pour la gestion des dépendances.

---

## 🚀 Installation du projet

### 1️⃣ Cloner le dépôt
```bash
git clone https://github.com/JulienGrade/biblio-pattern-cesi
cd biblio-pattern-cesi
```

### 2️⃣ Installation des dépendances avec Composer
```bash
composer install
```

### 3️⃣ Configuration de la base de données
- **Créer la base de données et charger les données de test**
```bash
mysql -u root -p < database.sql
```
💡 *(Assurez-vous que MySQL tourne et que vous utilisez le bon utilisateur/mot de passe.)*

---

## 🛠 Configuration de l’environnement
Le projet utilise un fichier `.env` pour stocker les informations de connexion à la base de données.

1️⃣ **Copier le fichier `.env.example` en `.env`**
```bash
cp .env.example .env
```

2️⃣ **Modifier les paramètres de la base de données dans `.env`**
```env
DB_HOST=localhost
DB_NAME=cesi-books
DB_USER=root
DB_PASSWORD=
```

3️⃣ **Mettre à jour l’Autoloading de Composer**
```bash
composer dump-autoload
```

---

## 🎮 Utilisation du projet
### 🚀 Démarrer un serveur local PHP
```bash
php -S localhost:8000
```
Ensuite, ouvrez **[http://localhost:8000](http://localhost:8000)** dans votre navigateur.

---

## 📌 Explication des fonctionnalités
📚 **Gestion des livres**
- Afficher la liste des livres
- Trier les livres par **titre, auteur, catégorie**
- Ajouter, modifier et supprimer des livres

👥 **Gestion des membres**
- Ajouter et gérer les membres
- Trois types de membres : `student`, `teacher`, `staff`

📖 **Gestion des emprunts**
- Emprunter un livre
- Retourner un livre
- Vérifier les emprunts en retard (**highlight automatique**)

🔔 **Notifications**
- **Observer Pattern** pour envoyer des notifications par email/SMS lors d’un emprunt ou d’un retour.

---

## 🛠 Architecture du projet
📁 **Organisation des dossiers :**
```
📦 biblio-pattern-final
 ┣ 📂 src
 ┃ ┣ 📂 Controller      # Contrôleurs MVC
 ┃ ┣ 📂 Entity          # Entités (Books, Members, Borrows)
 ┃ ┣ 📂 Repository      # Gestion des requêtes SQL
 ┃ ┣ 📂 Views           # Fichiers HTML + TailwindCSS
 ┃ ┣ 📂 Decorator       # Design Pattern Decorator
 ┃ ┣ 📂 Factory         # Design Pattern Factory
 ┃ ┣ 📂 Observer        # Design Pattern Observer
 ┃ ┣ 📂 Services        # Services (DB, Notifications...)
 ┃ ┣ 📂 Strategy        # Design Pattern Strategy
 ┃ ┗ index.php          # Point d'entrée de l'application
 ┣ 📜 composer.json      # Dépendances PHP
 ┣ 📜 database.sql       # Script de création de la BDD
 ┣ 📜 README.md          # Documentation
```

---

## 🛠 Dépannage
### ❌ Erreur `Class not found`
```bash
composer dump-autoload
```

### ❌ Erreur `Access denied for user 'root'@'localhost'`
✔ Vérifier `.env` et que MySQL tourne.

### ❌ Problème d'affichage TailwindCSS
✔ Vérifier que la balise `<script src="https://cdn.tailwindcss.com"></script>` est bien incluse.

---

## 💡 Contribuer
Les contributions sont les bienvenues !
1. **Forker** le projet
2. **Créer une branche `feature/nom-feature`**
3. **Faire une Pull Request 🚀**

---

## 📜 Licence
Ce projet est sous licence MIT. 📄

