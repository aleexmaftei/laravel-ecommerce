<?php

namespace App\Http\Controllers;

use App\DTOs\OrderPlacedDto;
use App\Http\Requests\OrderPlacedRequest;
use App\Repositories\DeliveryLocation\IDeliveryLocationRepository;
use App\Repositories\Product\IProductRepository;
use App\Services\OrderPlacedService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderPlacedController extends BaseController
{
    private OrderPlacedService $orderPlacedService;
    private IProductRepository $productRepository;
    private IDeliveryLocationRepository $deliveryLocationRepository;

    public function __construct(OrderPlacedService $orderPlacedService,
                                IProductRepository $productRepository,
                                IDeliveryLocationRepository $deliveryLocationRepository)
    {
        $this->orderPlacedService = $orderPlacedService;
        $this->productRepository = $productRepository;
        $this->deliveryLocationRepository = $deliveryLocationRepository;
    }

    public function checkout(int $product_id)
    {
        $product = $this->productRepository->getById($product_id);
        if (!$product) {
            abort(404);
        }
        
        if(Gate::allows("can-buy-own-products", $product)) {
            abort(403);
        }

        $user = auth()->user();
        $delivery_locations = [];
        if ($user) {
            $delivery_locations = $this->deliveryLocationRepository->getDeliveryLocationsByUserId($user->id);
        }

        return View("order_placed.checkout")
            ->with("product", $product)
            ->with("delivery_locations", $delivery_locations);
    }

    public function store(OrderPlacedRequest $orderPlacedRequest): RedirectResponse
    {
        $placedOrderDto = OrderPlacedDto::create($orderPlacedRequest);

        $this->orderPlacedService->create($placedOrderDto);

        return redirect()->route("home");
    }

    public function mark_as_read(): RedirectResponse
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
