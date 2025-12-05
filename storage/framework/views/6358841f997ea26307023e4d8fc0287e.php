<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Order Details</h1>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <!-- Customer Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <!-- Customer Icon -->
          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 7a4 4 0 1 1 8 0 4 4 0 0 1-8 0M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <div class="grow">
          <p class="text-xs uppercase tracking-wide text-gray-500">Customer</p>
          <div class="mt-1"><?php echo e($address->full_name); ?></div>
        </div>
      </div>
    </div>

    <!-- Order Date Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <!-- Calendar Icon -->
          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 22h14M5 2h14M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/>
          </svg>
        </div>
        <div class="grow">
          <p class="text-xs uppercase tracking-wide text-gray-500">Order Date</p>
          <div class="mt-1 text-xl font-medium text-gray-800">
            <?php echo e($order_items[0]->created_at->format('m-d-Y')); ?>

          </div>
        </div>
      </div>
    </div>

    <!-- Order Status Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <!-- Status Icon -->
          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6m-6-10l4 10 1.7-4.3L22 16"/>
          </svg>
        </div>
        <div class="grow">
          <p class="text-xs uppercase tracking-wide text-gray-500">Order Status</p>
          <div class="mt-1">
            <?php
              $status = '';
              switch($order->status){
                case 'new': $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">New</span>'; break;
                case 'processing': $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span>'; break;
                case 'shipped': $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Shipped</span>'; break;
                case 'delivered': $status = '<span class="bg-green-700 py-1 px-3 rounded text-white shadow">Delivered</span>'; break;
                case 'cancelled': $status = '<span class="bg-red-700 py-1 px-3 rounded text-white shadow">Cancelled</span>'; break;
              }
            ?>
            <?php echo $status; ?>

          </div>
        </div>
      </div>
    </div>

    <!-- Payment Status Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center w-12 h-12 bg-gray-100 rounded-lg">
          <!-- Payment Icon -->
          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5zM12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2"/>
          </svg>
        </div>
        <div class="grow">
          <p class="text-xs uppercase tracking-wide text-gray-500">Payment Status</p>
          <div class="mt-1">
            <?php
              $payment_status = '';
              switch($order->payment_status){
                case 'pending': $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pending</span>'; break;
                case 'paid': $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span>'; break;
                case 'failed': $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Failed</span>'; break;
                case 'refunded': $payment_status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Refunded</span>'; break;
              }
            ?>
            <?php echo $payment_status; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Grid -->

  <!-- Order Items and Shipping -->
  <div class="flex flex-col md:flex-row gap-4 mt-4">
    <div class="md:w-3/4">
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <table class="w-full">
          <thead>
            <tr>
              <th class="text-left font-semibold">Product</th>
              <th class="text-left font-semibold">Price</th>
              <th class="text-left font-semibold">Quantity</th>
              <th class="text-left font-semibold">Total</th>
            </tr>
          </thead>
          <tbody>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr wire:key="<?php echo e($item->id); ?>">
                <td class="py-4">
                  <div class="flex items-center">
                    <img class="h-16 w-16 mr-4 rounded"
                         src="<?php echo e(isset($item->product->images[0]) ? url('storage/'.$item->product->images[0]) : 'https://via.placeholder.com/64'); ?>"
                         alt="<?php echo e($item->product->name); ?>">
                    <span class="font-semibold"><?php echo e($item->product->name); ?></span>
                  </div>
                </td>
                <td class="py-4"><?php echo e(Number::currency($item->unit_amount)); ?></td>
                <td class="py-4 text-center"><?php echo e($item->quantity); ?></td>
                <td class="py-4"><?php echo e(Number::currency($item->total_amount)); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
          </tbody>
        </table>
      </div>

      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <h1 class="text-2xl font-bold text-slate-500 mb-3">Shipping Address</h1>
        <div class="flex justify-between items-center">
          <div>
            <p><?php echo e($address->street_address); ?>, <?php echo e($address->city); ?>, <?php echo e($address->state); ?>, <?php echo e($address->zip_code); ?></p>
          </div>
          <div>
            <p class="font-semibold">Phone:</p>
            <p><?php echo e($address->phone); ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Summary -->
    <div class="md:w-1/4">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Summary</h2>
        <div class="flex justify-between mb-2">
          <span>Subtotal</span>
          <span><?php echo e(Number::currency($order->grand_total)); ?></span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Taxes</span>
          <span><?php echo e(Number::currency(0)); ?></span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Shipping</span>
          <span><?php echo e(Number::currency(0)); ?></span>
        </div>
        <hr class="my-2">
        <div class="flex justify-between font-semibold">
          <span>Grand Total</span>
          <span><?php echo e(Number::currency($order->grand_total)); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\Administrator\Ecommerce\resources\views/livewire/my-order-detailed-page.blade.php ENDPATH**/ ?>