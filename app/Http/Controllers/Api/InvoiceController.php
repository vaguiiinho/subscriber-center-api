<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use Core\UseCase\Invoice\Paginate\Dto\PaginateInvoiceInputDto;
use Core\UseCase\Invoice\Paginate\PaginateInvoiceUseCase;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PaginateInvoiceUseCase $UseCase)
    {
        $response = $UseCase->execute(
            inputDto: new PaginateInvoiceInputDto(
                filter: $request->get('filter', ''),
                order: $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPage: (int) $request->get('totalPage')
            )
        );

        return InvoiceResource::collection(collect($response->items))
            ->additional([
                'meta' => [
                    'total' => (int) $response->total,
                    'current_page' => $response->current_page,
                    'first_page' => $response->first_page,
                    'last_page' => $response->last_page,
                    'per_page' => $response->per_page,
                    'to' => $response->to,
                    'from' => $response->from
                ]
            ]);
    }
}
