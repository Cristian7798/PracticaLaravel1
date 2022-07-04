<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeInvoiceRequest;
use App\Models\Model\Client;
use App\Models\Model\Invoice;
use App\Models\Model\InvoiceItem;
use App\Models\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with(["client", "invoiceItems"])->latest()->paginate(10);

        return view("Invoices.index", compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where("stock", ">", 0)->get();
        $clients = Client::all();

        return view("Invoices.create", [
            "products" => $products,
            "clients" => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = json_decode($request->invoice_items);

        DB::beginTransaction();
        try {
            if (count($items) == 0) {
                return false;
            }

            $client = Client::create([
                "name" => $request->client_name,
                "identification_number" => $request->client_identification_number
            ]);

            $invoice = Invoice::create([
                "client_id" => $client->id,
                "total" => floatval($request->invoice_total),
                "subtotal" => 0,
                "tax" => 0
            ]);

            foreach ($items as $item) {
                $invoice_item = InvoiceItem::create([
                    "invoice_id" => $invoice->id,
                    "product_id" => $item->product_id,
                    "amount" => $item->amount,
                    "total" => floatval($item->total)
                ]);
                $product = Product::find($item->product_id);
                $product->stock -= $item->amount;
                $product->save();
            }
            // Commit Transaction
            DB::commit();

        } catch (\Exception $e) {
            // Rollback Transaction
            // dd($e);
            Log::error('Error al crear factura', [
                'data' => $request->input(),
                'err' => $e->getTrace(),
                'msg' => $e->getMessage()
            ]);

            DB::rollback();
            return false;
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
//        dd($invoice);
        return view("Invoices.show", compact("invoice"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
