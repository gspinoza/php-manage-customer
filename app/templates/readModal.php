<?php

function renderReadModal($id, $readModalOpen) {    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/customerFactory.php';
    $customer = customerFactory::getCustomer();
    
    $customerData = [];
    try {
        $customerData = $customer->read($id);
    } catch(PDOException $exception) {
        echo "Error: " . $exception->getMessage();
    }
?>

<?php if ($readModalOpen): ?>
<div id="readCustomerModal" tabindex="-1" aria-hidden="true" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex" aria-modal="true" role="dialog">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                    <h3 class="font-semibold "><?php echo htmlspecialchars($customerData['firstName']); ?> <?php echo htmlspecialchars($customerData['lastName']); ?></h3>
                </div>
                <div>
                <form method="post" action="">
                    <input type="hidden" name="readModal" value="<?php echo $readModalOpen ? 'closed' : 'open'; ?>">
                    <button type="submit" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readCustomerModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </form>
                </div>
            </div>
            
            </dd><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Phone</dt><dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo htmlspecialchars($customerData['phone']); ?></dd></dl>
            </dd><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Email</dt><dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"><?php echo htmlspecialchars($customerData['email']); ?></dd></dl>

            <dl><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Address</dt><dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                <?php echo htmlspecialchars($customerData['street']); ?>,
                <?php echo htmlspecialchars($customerData['city']); ?>,
                <?php echo htmlspecialchars($customerData['state']); ?>,
                <?php echo htmlspecialchars($customerData['zipcode']); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
}

?>

