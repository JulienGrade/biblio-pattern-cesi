<?php
namespace App\Views\Borrows;

use App\Repository\BookRepository;
use App\Repository\MemberRepository;
use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;
use App\Entity\Borrow;

class BorrowFormView {
    private BookRepository $bookRepository;
    private MemberRepository $memberRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
        $this->memberRepository = new MemberRepository();
    }

    public function renderForm(?Borrow $borrow = null, ?string $errorMessage = null): string {
        $header = new HeaderView();
        $footer = new FooterView();

        $action = $borrow ? "Update Borrow" : "Add New Borrow";
        $id = $borrow ? $borrow->getId() : '';
        $bookId = $borrow ? $borrow->getBookId() : '';
        $memberId = $borrow ? $borrow->getMemberId() : '';
        $borrowDate = $borrow ? $borrow->getBorrowDate()->format('Y-m-d') : date('Y-m-d');
        $dueDate = $borrow ? $borrow->getDueDate()->format('Y-m-d') : '';

        // Récupérer les livres et les membres
        $books = $this->bookRepository->getAllBooks();
        $members = $this->memberRepository->getAllMembers();

        ob_start();
        echo $header->render();
        ?>

        <div class="flex justify-center items-center min-h-screen bg-gray-100">
            <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6"><?php echo $action; ?></h2>

                <!-- 🔹 Affichage de l'alerte en cas d'erreur -->
                <?php if ($errorMessage): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        ⚠️ <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="?page=save-borrow">
                    <?php if ($borrow): ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <?php endif; ?>

                    <!-- Sélection du livre -->
                    <div class="mb-4">
                        <label for="book_id" class="block text-sm font-semibold text-gray-700">Book</label>
                        <select name="book_id" id="book_id"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                            <option value="">Select a book</option>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book->getId(); ?>" <?= ($book->getId() == $bookId) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($book->getTitle()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Sélection du membre -->
                    <div class="mb-4">
                        <label for="member_id" class="block text-sm font-semibold text-gray-700">Member</label>
                        <select name="member_id" id="member_id"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                            <option value="">Select a member</option>
                            <?php foreach ($members as $member): ?>
                                <option value="<?= $member->getId(); ?>" <?= ($member->getId() == $memberId) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($member->getName()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Date d'emprunt -->
                    <div class="mb-4">
                        <label for="borrow_date" class="block text-sm font-semibold text-gray-700">Borrow Date</label>
                        <input type="date" name="borrow_date" id="borrow_date"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               value="<?php echo htmlspecialchars($borrowDate); ?>" required>
                    </div>

                    <!-- Date limite -->
                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-semibold text-gray-700">Due Date</label>
                        <input type="date" name="due_date" id="due_date"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               value="<?php echo htmlspecialchars($dueDate); ?>" required>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-md font-semibold hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
                        <?php echo $action; ?>
                    </button>
                </form>
            </div>
        </div>

        <?php
        echo $footer->render();
        return ob_get_clean();
    }
}
