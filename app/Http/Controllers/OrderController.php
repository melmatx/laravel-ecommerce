<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('orders', [
            "orders" => auth()->user()->orders,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            "status" => ["required", "string", "in:pending,processing,shipped,delivered,cancelled"],
        ]);

        // Update Customer Order
        $order->customerOrder()->update([
            "status" => $request->status
        ]);

        // Update Seller Order
        $order->update($request->all());

        return redirect()->back()->with('status-updated', $order->id);
    }

    public function makeOrder(Request $request)
    {
        $user = $request->user();
        $total = $request->total;

        if ($this->hasInsufficientFunds($user, $total)) {
            return redirect()->back()->with('checkout-error', 'Insufficient funds!');
        }

        $this->createOrdersForUniqueSellers($user);

        return redirect()->to(route('order.index') . '#latest')->with('order-success', 'Order successful!');
    }

    private function hasInsufficientFunds($user, $total)
    {
        return $user->wallet < $total;
    }

    private function createOrdersForUniqueSellers($user)
    {
        $cartProducts = $user->cart->products;
        $uniqueSellers = $cartProducts->pluck('product.seller')->unique();

        $uniqueSellers->each(function ($seller) use ($user, $cartProducts) {
            $this->createCustomerAndSellerOrders($user, $seller, $cartProducts);
        });
    }

    private function createCustomerAndSellerOrders($user, $seller, $cartProducts)
    {
        $customerOrder = $this->createOrder($user->id, $seller->id, "customer");
        $sellerOrder = $this->createOrder($seller->id, $customerOrder->id, "seller");

        $this->createOrderProducts($sellerOrder, $customerOrder, $seller, $user, $cartProducts);
    }

    private function createOrder($userId, $secondId, $role)
    {
        return Order::create([
            "user_id" => $userId,
            "seller_id" => $role == 'customer' ? $secondId : null,
            "customer_order_id" => $role == 'seller' ? $secondId : null,
            "role" => $role,
        ]);
    }

    private function createOrderProducts($sellerOrder, $customerOrder, $seller, $user, $cartProducts)
    {
        $filteredCart = $cartProducts->where('product.seller_id', $seller->id);

        $filteredCart->each(function ($cartProduct) use ($sellerOrder, $customerOrder, $seller, $user) {
            $this->createOrderItem($sellerOrder->id, $cartProduct);
            $this->createOrderItem($customerOrder->id, $cartProduct);

            $this->updateWalletsAndProductData($cartProduct, $seller, $user);
        });
    }

    private function createOrderItem($orderId, $cartProduct) {
        OrderProduct::create([
            "order_id" => $orderId,
            "product_id" => $cartProduct->product->id,
            "quantity" => $cartProduct->quantity,
            "price" => $cartProduct->product->price,
        ]);
    }

    private function updateWalletsAndProductData($cartProduct, $seller, $user)
    {
        $productTotal = $cartProduct->product->price * $cartProduct->quantity;

        $seller->update(["wallet" => $seller->wallet += $productTotal]);
        $user->update(["wallet" => $user->wallet -= $productTotal]);

        $cartProduct->product->decrement('stocks', $cartProduct->quantity);
        $cartProduct->product->increment('sales', $cartProduct->quantity);

        $cartProduct->delete();
    }
}
