@extends("layouts.base_template")

@section("content")

    <section class="global-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h2> Facturas </h2>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#Page header-->

    <div class="container" id="app">

        <div class="row m-5">
            <div class="col-md-12 text-right">
                <a class="btn btn-success" href="{{ route('invoices.create') }}">Nueva factura</a>
            </div>
        </div>

        <div class="row m-5">
            <h3> Facturas </h3>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>N°</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->id }}</td>
                                                <td>{{ $invoice->client ?  $invoice->client->name : 'n/a'}}</td>
                                                <td>$ {{ $invoice->total }}</td>
                                                <td>
                                                    <a class="btn-info btn-sm" href="{{ route('invoices.show', $invoice->id) }}">Ver</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if (count($invoices) < 1)
                                            <tr>
                                                <td colspan="4" class="text-center">Sin datos</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{ $invoices->links() }}
@endsection
