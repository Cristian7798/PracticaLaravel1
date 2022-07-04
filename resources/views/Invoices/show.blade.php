@extends("layouts.base_template")

@section("content")

    <section class="global-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h2> Detalle de factura </h2>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#Page header-->

    <div class="container" id="app">

        <div class="row m-5">
            <h3> Factura N°: {{ $invoice->id ?? '' }}</h3>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>PVP</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach(($invoice->invoiceItems ? $invoice->invoiceItems : [] ) as $item)
                                            <tr>
                                                <td>{{ $item->product ? $item->product->name : 'n/a' }}</td>
                                                <td>{{ $item->amount ?? '-' }}</td>
                                                <td>$ {{ $item->product ? $item->product->price : 'n/a' }}</td>
                                                <td>$ {{ $item->total ?? "n/a" }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right"> Total</td>
                                            <td>$ {{ $invoice->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
