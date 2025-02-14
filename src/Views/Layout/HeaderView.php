<?php
namespace App\Views\Layout;

class HeaderView
{
    public function render(): string {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Système de gestion Bibliothèque CESI</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100 text-gray-800">
        <header class="bg-blue-600 text-white py-4 shadow-md">
            <div class="container mx-auto text-center">
                <h1 class="text-3xl font-bold">Système de gestion Bibliothèque CESI</h1>
            </div>
            <nav class="mt-4">
                <ul class="flex justify-center space-x-4">
                    <li><a href="?page=books" class="px-4 py-2 rounded-md bg-white text-blue-600 hover:bg-gray-200">Books</a></li>
                    <li><a href="?page=members" class="px-4 py-2 rounded-md bg-white text-blue-600 hover:bg-gray-200">Members</a></li>
                    <li><a href="?page=borrows" class="px-4 py-2 rounded-md bg-white text-blue-600 hover:bg-gray-200">Borrows</a></li>
                </ul>
            </nav>
        </header>
        <main class="container mx-auto mt-8">
        <?php
        return ob_get_clean();
    }
}
