<?php
namespace App\Views\Books;

use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;

class BooksView {
    public function renderList(array $books, string $sortMethod = 'title'): string {
        $header = new HeaderView();
        $footer = new FooterView();

        ob_start();
        echo $header->render();
        ?>

        <h2 class="text-2xl font-semibold mb-4">Books List</h2>
        <!-- 🔹 Formulaire de tri -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="page" value="books">
            <label for="sort" class="block text-sm font-medium text-gray-700">Sort by:</label>
            <select name="sort" id="sort" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                <option value="title" <?= $sortMethod === 'title' ? 'selected' : '' ?>>Title</option>
                <option value="author" <?= $sortMethod === 'author' ? 'selected' : '' ?>>Author</option>
                <option value="category" <?= $sortMethod === 'category' ? 'selected' : '' ?>>Category</option>
            </select>
        </form>
        <table class="table-auto w-full bg-white shadow-md rounded border border-gray-300">
            <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">ISBN</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($book->getId()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($book->getTitle()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($book->getAuthor()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($book->getCategory()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($book->getIsbn()); ?></td>
                    <td class="px-4 py-2">
                        <a href="?page=book-form&id=<?php echo $book->getId(); ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="?page=delete-book&id=<?php echo $book->getId(); ?>" class="text-red-500 hover:underline ml-2">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <a href="?page=book-form" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Book</a>

        <?php
        echo $footer->render();
        return ob_get_clean();
    }
}
