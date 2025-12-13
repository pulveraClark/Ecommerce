<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name, $last_name, $phone, $street_address, $city, $state, $zip_code;
    public $payment_method;

    public $coupons = [
        ['code' => 'SAVE10', 'type' => 'percent', 'value' => 10],
        ['code' => 'SAVE20', 'type' => 'percent', 'value' => 20],
        ['code' => 'LESS5', 'type' => 'fixed', 'value' => 5],
        ['code' => 'LESS10', 'type' => 'fixed', 'value' => 10],
    ];

    public $selected_coupon = null;
    public $discount_amount = 0;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    /* -------------------------------------------------------
     | LIVE UPDATE WHEN COUPON IS CHANGED
     --------------------------------------------------------*/
    public function updatedSelectedCoupon()
    {
        $this->calculateDiscount();
    }

    public function calculateDiscount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        if (!$this->selected_coupon) {
            $this->discount_amount = 0;
            return;
        }

        $coupon = collect($this->coupons)->firstWhere('code', $this->selected_coupon);

        if (!$coupon) {
            $this->discount_amount = 0;
            return;
        }

        if ($coupon['type'] === 'percent') {
            $this->discount_amount = ($coupon['value'] / 100) * $grand_total;
        } else {
            $this->discount_amount = min($coupon['value'], $grand_total);
        }
    }

    /* -------------------------------------------------------
     | PLACE ORDER
     --------------------------------------------------------*/
    public function placeOrder()
    {
        $this->validate([
            'first_name'     => 'required',
            'last_name'      => 'required',
            'phone'          => 'required',
            'street_address' => 'required',
            'city'           => 'required',
            'state'          => 'required',
            'zip_code'       => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // apply discount
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        $final_total = $grand_total - $this->discount_amount;

        $order = new Order();
        $order->user_id        = auth()->id();
        $order->grand_total    = $final_total;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status         = 'new';
        $order->currency       = 'USD';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;
        $order->coupon_used = $this->selected_coupon;
        $order->discount_amount = $this->discount_amount;

        // address
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        // STRIPE PAYMENT
        if ($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => route('cancel'),
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);

        CartManagement::clearCartItems();
        Mail::to(request()->user())->send(new OrderPlaced($order));

        return redirect($redirect_url);
    }

    /* -------------------------------------------------------
     | RENDER PAGE WITH LIVE TOTALS
     --------------------------------------------------------*/
    public function render()
    {
        $cart_items   = CartManagement::getCartItemsFromCookie();
        $grand_total  = CartManagement::calculateGrandTotal($cart_items);
        $final_total  = $grand_total - $this->discount_amount;

        return view('livewire.checkout-page', [
            'cart_items'  => $cart_items,
            'grand_total' => $grand_total,
            'final_total' => $final_total,
        ]);
    }
}
