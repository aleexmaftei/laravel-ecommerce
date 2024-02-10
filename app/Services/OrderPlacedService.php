<?php

namespace App\Services;

use App\DTOs\OrderPlacedDto;
use App\Repositories\DeliveryLocation\IDeliveryLocationRepository;
use App\Repositories\OrderPlaced\IOrderPlacedRepository;
use App\Repositories\Product\IProductRepository;
use App\Services\Base\BaseService;
use Illuminate\Validation\ValidationException;

class OrderPlacedService extends BaseService
{
    private IProductRepository $productRepository;
    private ProductService $productService;
    private IOrderPlacedRepository $orderPlacedRepository;
    private IDeliveryLocationRepository $deliveryLocationRepository;
    private NotificationService $notificationService;

    public function __construct(IProductRepository          $productRepository,
                                ProductService              $productService,
                                IOrderPlacedRepository      $orderPlacedRepository,
                                IDeliveryLocationRepository $deliveryLocationRepository,
                                NotificationService         $notificationService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->orderPlacedRepository = $orderPlacedRepository;
        $this->deliveryLocationRepository = $deliveryLocationRepository;
        $this->notificationService = $notificationService;
    }

    public function create(OrderPlacedDto $orderPlacedDto)
    {
        return $this->execute_in_transaction(function () use ($orderPlacedDto) {
            $bought_product = $this->productRepository->getById($orderPlacedDto->product_id);
            if (!$bought_product) {
                throw ValidationException::withMessages(["general_error" => "Not found"]);
            }

            if ($orderPlacedDto->quantity < 0) {
                throw ValidationException::withMessages(["quantity" => "Quantity should be greater than 0"]);
            }

            if ($bought_product->quantity < $orderPlacedDto->quantity) {
                throw ValidationException::withMessages(["quantity" => "The desired quantity is exceeding the product quantity available"]);
            }

            $buyer_user_id = auth()->user()->id;
            if ($buyer_user_id === $bought_product->user_id) {
                throw ValidationException::withMessages(["user_id" => "Can not buy own items"]);
            }

            $delivery_location = $this->deliveryLocationRepository->getById($orderPlacedDto->delivery_location_id);
            if (!$delivery_location) {
                throw ValidationException::withMessages(["general_error" => "Not found"]);
            }

            $order = [
                "order_quantity" => $orderPlacedDto->quantity,
                "product_id" => $bought_product->id,
                "buyer_user_id" => $buyer_user_id,
                "seller_user_id" => $bought_product->user_id,
                "delivery_location_id" => $delivery_location->id,
            ];

            $this->orderPlacedRepository->create($order);

            $this->productService->changeQuantity($bought_product->id, $bought_product->quantity - $orderPlacedDto->quantity);

            $this->notificationService->notifyOrderCompleteForUser($bought_product->user_id);
        });
    }
}
