<?php
namespace App\Views\Members;

use App\Views\Layout\HeaderView;
use App\Views\Layout\FooterView;
use App\Entity\Member;

class MembersFormView {
    public function renderForm(?Member $member = null): string {
        $header = new HeaderView();
        $footer = new FooterView();

        $action = $member ? "Update Member" : "Add New Member";
        $id = $member ? $member->getId() : '';
        $name = $member ? $member->getName() : '';
        $address = $member ? $member->getAddress() : '';
        $type = $member ? $member->getType() : '';

        ob_start();
        echo $header->render();
        ?>

        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6"><?php echo $action; ?></h2>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <form method="post" action="?page=save-member" class="space-y-4">
                <?php if ($member): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <?php endif; ?>

                <div class="relative">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($name); ?>" required>
                </div>

                <div class="relative">
                    <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                    <input type="text" name="address" id="address"
                           class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           value="<?php echo htmlspecialchars($address); ?>" required>
                </div>

                <div class="relative">
                    <label for="member_type" class="block text-sm font-semibold text-gray-700">Member Type</label>
                    <select name="member_type" id="member_type"
                            class="w-full mt-1 px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                        <option value="student" <?php echo $type === "student" ? "selected" : ""; ?>>Student</option>
                        <option value="teacher" <?php echo $type === "teacher" ? "selected" : ""; ?>>Teacher</option>
                        <option value="staff" <?php echo $type === "staff" ? "selected" : ""; ?>>Staff</option>
                    </select>
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
