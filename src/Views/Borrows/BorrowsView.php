<?php
namespace App\Views\Borrows;

use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;
use App\Entity\Borrow;

class BorrowsView {
    public function renderList(array $borrows, string $errorMessage = null): string {
        $header = new HeaderView();
        $footer = new FooterView();
        // Récupérer la notification si elle existe
        $notificationMessage = $_GET['notification'] ?? null;
        ob_start();
        echo $header->render();
        ?>

        <h2 class="text-2xl font-semibold mb-4">Borrowed Books</h2>
        <!-- 🔹 Affichage des notifications -->
        <?php if ($notificationMessage): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Notification:</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($notificationMessage); ?></span>
            </div>
        <?php endif; ?>
        <!-- 🔹 Affichage de l'alerte si une erreur est présente -->
        <?php if ($errorMessage): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($errorMessage); ?></span>
            </div>
        <?php endif; ?>

        <table class="table-auto w-full bg-white shadow-md rounded border border-gray-300">
            <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Book ID</th>
                <th class="px-4 py-2">Member ID</th>
                <th class="px-4 py-2">Borrow Date</th>
                <th class="px-4 py-2">Due Date</th>
                <th class="px-4 py-2">Return Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($borrows as $borrow): ?>
                <?php
                $isOverdue = (!$borrow->getReturnDate() && $borrow->getDueDate()->format('Y-m-d') < date('Y-m-d')); // ✅ Vérifie si la date est dépassée
                ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?php echo $borrow->getId(); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($borrow->getBookTitle()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($borrow->getMemberName()); ?></td>
                    <td class="px-4 py-2"><?php echo $borrow->getBorrowDate()->format('Y-m-d'); ?></td>
                    <td class="px-4 py-2 <?php echo $isOverdue ? 'text-red-500 font-bold' : ''; ?>">
                        <?php echo $borrow->getDueDate()->format('Y-m-d'); ?>
                    </td>
                    <td class="px-4 py-2">
                        <?php echo $borrow->getReturnDate() ? $borrow->getReturnDate()->format('Y-m-d') : 'Not Returned'; ?>
                    </td>
                    <td class="px-4 py-2">
                        <a href="?page=borrow-form&id=<?php echo $borrow->getId(); ?>" class="text-blue-500 hover:underline">Edit</a>
                        <?php if (!$borrow->getReturnDate()): ?>
                            <a href="?page=return-borrow&id=<?php echo $borrow->getId(); ?>"
                               class="text-green-500 hover:underline ml-2">Return</a>
                        <?php else: ?>
                            <span class="text-gray-400 ml-2">Returned</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>

        <a href="?page=borrow-form" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Borrow</a>

        <?php
        echo $footer->render();
        return ob_get_clean();
    }
}
