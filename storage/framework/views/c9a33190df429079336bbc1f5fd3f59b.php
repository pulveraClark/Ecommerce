<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
  <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $status = '';
                $payment_status = '';

                switch($order->status) {
                  case 'new': $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">New</span>'; break;
                  case 'processing': $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span>'; break;
                  case 'shipped': $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Shipped</span>'; break;
                  case 'delivered': $status = '<span class="bg-green-700 py-1 px-3 rounded text-white shadow">Delivered</span>'; break;
                  case 'cancelled': $status = '<span class="bg-red-700 py-1 px-3 rounded text-white shadow">Cancelled</span>'; break;
                }

                switch($order->payment_status) {
                  case 'pending': $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pending</span>'; break;
                  case 'paid': $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span>'; break;
                  case 'failed': $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Failed</span>'; break;
                  case 'refunded': $payment_status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Refunded</span>'; break;
                }
              ?>
                <tr class="odd:bg-white even:bg-gray-100" wire:key='<?php echo e($order->id); ?>'>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800"><?php echo e($order->id); ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?php echo e($order->created_at->format('m-d-Y')); ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?php echo $status; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?php echo $payment_status; ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><?php echo e(Number::currency($order->grand_total)); ?></td>
                  <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <a href="/my-orders/<?php echo e($order->id); ?>" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
          </table>
        </div>
      </div>
      <?php echo e($orders->links()); ?>

    </div>
  </div>
</div>
<?php /**PATH C:\Users\Administrator\Ecommerce\resources\views/livewire/my-orders-page.blade.php ENDPATH**/ ?>