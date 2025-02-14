<?php
namespace App\Views\Layout;
class FooterView
{
    public function render(): string {
        ob_start();
        ?>
        </main>
        <footer class="bg-gray-800 text-white py-4 mt-8 shadow-md">
            <div class="container mx-auto text-center">
                <p>&copy; <?php echo date('Y'); ?> Système de gestion Bibliothèque CESI. All rights reserved.</p>
            </div>
        </footer>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}