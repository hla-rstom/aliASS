 <div class="tab-pane fade" id="products-bundling" role="tabpanel" aria-labelledby="products-bundling-tab">
     <table id="product-table" class="table table-borderless table-striped" style="width:100%">
         <thead>
             <tr>
                 <!-- <th><input type="checkbox" id="checkAll" class="large-checkbox" style="transform: scale(1.5);"></th> -->
                 <th>#</th>
                 <th>Bundling Product</th>
                 <th>Product</th>
                 <th>Varian</th>
                 <th>Sku</th>
                 <th>Stock</th>
                 <th>Cost of Goods</th>
                 <th>Consumer Price</th>
                 <th>Status</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody id="searchResults">
             @foreach ($product_bundlings as $index => $bundling)
             @php
             $rowCount = count($bundling->product_bundlings_details); // Get the count for rowspan
             @endphp
             @foreach ($bundling->product_bundlings_details as $product_bundlings_detailsIndex => $product_bundlings_details)
             <tr>
                 @if ($product_bundlings_detailsIndex === 0)
                 <td rowspan="{{ $rowCount }}">{{ $index + 1 }}</td>
                 <td rowspan="{{ $rowCount }}">{{ $bundling->name }}</td>
                 @endif
                 <td>{{ $product_bundlings_details->product->name ?? '' }}</td>
                 <td></td>
                 <td>{{ $product_bundlings_details->product->sku ?? ''}}</td>
                 <td></td>
                 <td>{{ $product_bundlings_details->product->cost_of_goods ?? ''}}</td>
                 <td>{{ $product_bundlings_details->product->consumer_price ?? '' }}</td>
                 <td></td>
                 <td></td>
             </tr>
             @endforeach
             @endforeach


         </tbody>
     </table>
     <div class="d-flex justify-content-end mt-4">

         {!! $products->links() !!}
     </div>
 </div>