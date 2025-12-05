<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Wishlist</h1>
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left font-semibold">Product</th>
                        <th class="text-left font-semibold">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $wishlist_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:key='<?php echo e($item['product_id']); ?>'>
                        <td class="py-4">
                            <div class="flex items-center">
                                <img class="h-16 w-16 mr-4" src="<?php echo e(url('storage', $item['image'])); ?>" alt="<?php echo e($item['name']); ?>">
                                <span class="font-semibold"><?php echo e($item['name']); ?></span>
                            </div>
                        </td>
                        <td>
                            <button wire:click='removeItem(<?php echo e($item['product_id']); ?>)'
                                class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                <span wire:loading.remove wire:target='removeItem(<?php echo e($item['product_id']); ?>)'>Remove</span>
                                <span wire:loading wire:target='removeItem(<?php echo e($item['product_id']); ?>)'>Removing...</span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="2" class="text-center py-4 text-4xl font-semibold text-slate-500">No Items in Wishlist</td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Administrator\Ecommerce\resources\views/livewire/wishlist-page.blade.php ENDPATH**/ ?>