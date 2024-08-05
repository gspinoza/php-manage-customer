<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/customerFactory.php';
$customer = customerFactory::getCustomer();

$totalRecords = 0;

try {
    // Fetch all records
    $customers = $customer->getAllCustomers();
    $totalRecords = count($customers);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th class="px-4 py-4">First Name</th>
            <th class="px-4 py-3">Last Name</th>
            <th class="px-4 py-3">Phone</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Street</th>
            <th class="px-4 py-3">City</th>
            <th class="px-4 py-3">State</th>
            <th class="px-4 py-3">Zipcode</th>
            <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($customers) > 0): ?>
            <?php foreach ($customers as $customer): ?>
                <tr class="border-b dark:border-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlspecialchars($customer['firstName']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['lastName']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['phone']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['street']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['state']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['zipcode']); ?></td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <?php renderActionDropdown($customer['cid'], $updateModalOpen, $readModalOpen, $deleteModalOpen); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td class="py-2 px-4 border-b" colspan="9">No records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="w-full md:w-1/2 my-5">
    <h3 class="text-md font-semibold text-slate-500 dark:text-white">Total Records: <?php echo htmlspecialchars($totalRecords); ?> </h3>
</div>
