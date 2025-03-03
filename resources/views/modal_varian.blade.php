    <!-- Modal Detail Variation-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="variationModalLabel">Variations Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Variation</th>
                                <th>Sku</th>
                                <th>Stock</th>
                                <th>Cost of Goods</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variation as $variation )
                            <tr>
                                <td>{{ $variation->model_name }}</td>
                                <td>{{ $variation->model_sku }}</td>
                                <td>{{$variation->stock->stock_seller}}</td>
                                <td>{{ $variation->price }}</td>
                                <td>{{ $variation->model_status }}</td>
                            </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- End modal -->