<?php
namespace App\Views\Books;

use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;
use App\Entity\Book;

class BooksFormView {
    public function renderForm(?Book $book = null): string {
        $header = new HeaderView();
        $footer = new FooterView();

        $action = $book ? "Update Book" : "Add New Book";
        $id = $book ? $book->getId() : '';
        $title = $book ? $book->getTitle() : '';
        $author = $book ? $book->getAuthor() : '';
        $category = $book ? $book->getCategory() : '';
        $isbn = $book ? $book->getIsbn() : '';

        ob_start();
        echo $header->render();
        ?>
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6"><?php echo $action; ?></h2>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <form method="post" action="?page=save-book" class="space-y-4">
                <?php if ($book): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <?php endif; ?>

                <div class="relative">
                    <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($title); ?>" required>
                </div>

                <div class="relative">
                    <label for="author" class="block text-sm font-semibold text-gray-700">Author</label>
                    <input type="text" name="author" id="author"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($author); ?>" required>
                </div>

                <div class="relative">
                    <label for="category" class="block text-sm font-semibold text-gray-700">Category</label>
                    <input type="text" name="category" id="category"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($category); ?>" required>
                </div>

                <div class="relative">
                    <label for="isbn" class="block text-sm font-semibold text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($isbn); ?>" required>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-md font-semibold hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
                    <?php echo $action; ?>
                </button>
            </form>
        </div>

        <?php
        echo $footer->render();
        return ob_get_clean();
    }
}
