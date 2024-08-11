<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Exception;

class OrderController extends Controller
{
    protected OrderService $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(OrderRequest $request)
    {
        try {
            $this->orderService->checkOrderData($request->toArray());
            $result = $this->orderService->format($request->toArray());
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
        return response()->json($result);
    }
}
