<?php

namespace App\Http\Controllers;

use App\DTOs\OrderPlacedDto;
use App\Http\Requests\OrderPlacedRequest;
use App\Repositories\DeliveryLocation\IDeliveryLocationRepository;
use App\Repositories\Product\IProductRepository;
use App\Services\OrderPlacedService;
use Illuminate\Http\RedirectResponse;

class OrderPlacedController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkout(int $product_id)
    {
        $product = $this->productRepository->getById($product_id);
        if (!$product) {
            abort(404);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderPlacedRequest $orderPlacedRequest): RedirectResponse
    {
        $placedOrderDto = OrderPlacedDto::create($orderPlacedRequest);

        $this->orderPlacedService->create($placedOrderDto);

        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}