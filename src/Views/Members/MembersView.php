<?php
namespace App\Views\Members;

use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;

class MembersView {
    public function renderList(array $members): string {
        $header = new HeaderView();
        $footer = new FooterView();

        ob_start();
        echo $header->render();
        ?>

        <h2 class="text-2xl font-semibold mb-4">Members List</h2>

        <table class="table-auto w-full bg-white shadow-md rounded border border-gray-300">
            <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Address</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($members as $member): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($member->getId()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($member->getName()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($member->getAddress()); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($member->getType()); ?></td>
                    <td class="px-4 py-2">
                        <a href="?page=member-form&id=<?php echo $member->getId(); ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="?page=delete-member&id=<?php echo $member->getId(); ?>" class="text-red-500 hover:underline ml-2">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <a href="?page=member-form" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Member</a>

        <?php
        echo $footer->render();
        return ob_get_clean();
    }
}
