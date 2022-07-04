@extends("layouts.base_template")

@section("content")

    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

    <section class="global-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h2> Nueva Factura </h2>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#Page header-->

    <div class="container" id="app">
        <div class="row m-5">
            <h3> Nuevo Cliente </h3>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    Nombre:
                                    <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old("client_name") }}">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    CI:
                                    <input type="text" class="form-control" maxlength="10" onkeypress="return valideKey(event);" id="client_identification_number">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-5">
            <h3> Agregar items de facturación </h3>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>
                                    Producto:
                                </label>
                                <v-select
                                    v-model="product_id"
                                    :options="products"
                                    :reduce="products => products.id"
                                    label="name"
                                    placeholder="Seleccione producto"
                                    id="product_id"
                                    @input="selectProduct(product_id)"
                                    :selectable="products => validar_productos_add(products.id)">
                                </v-select>
                            </div>
                            <div class="col-md-4">
                                <label>
                                    PVP:
                                </label>
                                <p>@{{ product ? product.price : "-" }}</p>
                            </div>
                            <div class="col-md-4">
                                <label>
                                    Cantidad:
                                </label>
                                <input type="number"
                                       class="form-control"
                                       min="1"
                                       v-model="txt_amount"
                                >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-info" @click="aggNewItem"> Agregar </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-5">
            <h3> Items de facturación </h3>
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>Acción</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>PVP</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) of items">
                                            <td>
                                                <button class="btn-danger btn-sm" @click="removeProduct(index)">x</button>
                                            </td>
                                            <td>@{{ item.product.name }}</td>
                                            <td>@{{ item.amount }}</td>
                                            <td>$ @{{ item.product.price }}</td>
                                            <td>$ @{{ item.total.toFixed(2) }}</td>
                                        </tr>
                                        <tr v-if="items.length > 0">
                                            <td colspan="4" class="text-right"> Total</td>
                                            <td>$ @{{ total }}</td>
                                        </tr>
                                        <tr v-if="items.length < 1">
                                            <td colspan="5" class="text-center">Sin datos</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-5">
            <div class="col-md-12 text-center">
                <button class="btn btn-success" @click="saveInvoice">Guardar</button>
                <a class="btn btn-info" href="{{ route('invoices.index') }}">Cancelar</a>
            </div>
        </div>

    </div>

@endsection

@section("scripts")
    <script>
        function valideKey(evt){

            // code is the decimal ASCII representation of the pressed key.
            var code = (evt.which) ? evt.which : evt.keyCode;

            if(code==8) { // backspace.
                return true;
            } else if(code>=48 && code<=57) { // is a number.
                return true;
            } else{ // other keys.
                return false;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>

    <script>
        Vue.component('v-select', VueSelect.VueSelect);

        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hola Vue!',
                products: {!! $products ?? [] !!},
                product_id: '',
                items: [],
                product: null,
                txt_amount: '',
                total: ''
            },
            methods: {
                aggNewItem() {
                    if (this.txt_amount == '') {
                        alert("ingrese cantidad");
                        return false;
                    }
                    var total = this.txt_amount * this.product.price;
                    var data = {
                        "product_id": this.product_id,
                        "amount": this.txt_amount,
                        "product": this.product,
                        "total": total
                    };
                    this.items.push(data);
                    this.calcularTotal();
                    this.clearVar();
                },
                clearVar() {
                    this.product_id = '';
                    this.txt_amount = '';
                    this.product = null;
                },
                calcularTotal() {
                    var total = 0;
                    for (item of this.items) {
                        total += parseFloat(item.total);
                    }
                    this.total = total.toFixed(2);
                },
                removeProduct(index) {
                    var result = confirm("¿Esta seguro?");
                    if (result) {
                        this.items.splice(index, 1);
                        this.calcularTotal();
                    }
                },
                validar_productos_add(product_id) {
                    if (this.items.length > 0) {
                        if (this.items.find(e => e.product_id == product_id)) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                },
                selectProduct(select) {
                    this.product = this.products.find(e => e.id == select);
                },
                saveInvoice() {
                    var url = "{{ route('invoices.store') }}";
                    const data = new FormData();
                    data.append("client_name", document.getElementById("client_name").value);
                    data.append("client_identification_number", document.getElementById("client_identification_number").value);
                    data.append("invoice_items", JSON.stringify(app.items));
                    data.append("invoice_total", app.total);
                    data.append('_token', '{{ csrf_token() }}');

                    // Petición HTTP
                    fetch(url, {
                        method: 'POST',
                        body: data
                    })
                        .then(response => {
                            if (response.ok)
                                return response.text()
                            else
                                throw new Error(response.status);
                        })
                        .then(data => {
                            console.log("Datos: " + data);
                            if (data) {
                                window.location.href = "{{ route('invoices.index')  }}";
                            }
                        })
                        .catch(err => {
                            console.error("ERROR: ", err.message)
                        });
                }
            }
        });
    </script>
@endsection
