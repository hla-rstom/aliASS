 <div class="tab-pane fade show active" id="all-products" role="tabpanel" aria-labelledby="all-products-tab">
     <div class="card-body">
         <div class="table-responsive">
             <table id="product-table" class="table table-borderless" style="width:100%">
                 @if($products->isNotEmpty())
                 <thead class="thead-light">
                     <tr>
                         <th><input type="checkbox" id="checkAll" class="large-checkbox" style="transform: scale(1.5);"></th>
                         <th></th>
                         <th>Product</th>
                         <th>Store</th>
                         <th>Sku</th>
                         <th>Stock</th>
                         <th>Mapping Product</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody id="searchResults">

                     @foreach($products as $product)
                     @php

                     $mappedCount = $product->mappings->count();
                     $images = json_decode($product->image, true);

                     // Fetch from PhotoProduct if $images is empty or not an array
                        if (empty($images) || !is_array($images) || empty($images[0])) {
                            $photo = $product->photos()->first(); 
                            $photoUrl = $photo ? asset('storage/' . $photo->path) : null;
                        } else {
                            $photoUrl = asset($images[0]);
                        }
                     @endphp
                     <tr>
                         <td class="text-center">
                             <input type="checkbox" name="checked_items[]" class="checkItem large-checkbox" style="transform: scale(1.5);" value="{{ $product->id }}">
                         </td>
                         <td class="hover-image">                             
                             <img src="{{ $photoUrl }}" alt="Main Photo" style="width: 50px; height: auto;"> 
                             <img src="{{ $photoUrl }}" alt="Popup Photo" class="popup-image">                            
                         </td>
                         <td>{{ $product->name }}</td>
                         <td>
                            @php
                            $uniqueShops = $product->mappings->pluck('store')->unique('shop_name');
                            @endphp

                            @if ($uniqueShops->isNotEmpty())
                                @foreach ($uniqueShops as $store)
                                    {{ $store->shop_name ?? 'Unknown Shop' }} - {{ $store->driver ?? 'Unknown Driver' }} <br>
                                @endforeach
                            @elseif ($product->store)
                                {{ $product->store->shop_name ?? 'Unknown Shop' }} - {{ $product->store->driver ?? 'Unknown Driver' }} <br>
                            @else
                                <span>No shops available</span>
                            @endif
                        </td>

                         <td>{{ $product->sku }}</td>
                         <td>{{ $product->stock }}</td>
                         <td><a href="#" data-toggle="modal" data-target="#productMappingModal" data-product-id="{{ $product->id }}">{{ $mappedCount }}</a></td>

                         <td>
                             <div class="dropdown">
                                 <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                     Action
                                 </button>
                                 <div class="dropdown-menu">
                                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal{{ $product->id }}">
                                         <i class="fas fa-solid fa-edit"></i> Edit
                                     </a>
                                     <form action="{{ route('deleteproduct', $product->id) }}" method="POST">
                                         @csrf
                                         <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure you want to delete this record?')">
                                             <i class="fas fa-regular fa-trash"></i> Hapus
                                         </button>
                                     </form>
                                 </div>
                             </div>
                         </td>
                     </tr>



                     <!-- Modal update product-->
                     <div class="modal fade" id="updateModal{{$product->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="updateModalLabel">Product Information</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="{{ route('updateproduct', $product->id) }}" method="POST" enctype="multipart/form-data" class="ml-3">
                                         @csrf
                                         <div class="form-row">
                                             <div class="form-group col-lg-8 mr-3">
                                                 <label for="name" class="col-form-label">Name</label>
                                                 <input type="text" class="form-control" name="name" value="{{ $product->name}}">
                                             </div>
                                             <div class="form-group">
                                                 <label for="sku" class="col-form-label">Sku Number</label>
                                                 <input type="text" class="form-control" name="sku" value="{{ $product->sku}}">
                                             </div>
                                         </div>
                                         <div class="form-group" style="position: relative;">
                                             <label for="nested-select" class="col-form-label">Category</label>
                                             <input name="nested" id="nested-select" type="button" onclick="eventClick(this)" class="form-control form-select" value="{{ $product->category }}">
                                             <input type="hidden" name="category_id" id="category_id" value="{{ $product->category_id }}" />
                                             <input type="hidden" name="category" id="category" value="{{ $category }}" />
                                         </div>
                                         <div class="form-group">
                                             <label for="message-text" class="col-form-label">Description</label>
                                             <textarea class="form-control" id="message-text" rows="10" name="description">{{ $product->description }}</textarea>
                                         </div>

                                         <div class="form-row">
                                             <div class="form-group col-lg-12">
                                                 <label for="weight" class="col-form-label">Weight</label>
                                                 <div class="input-group">
                                                     <input type="text" class="form-control" name="weight" aria-describedby="basic-addon2" value="{{ $product->weight}}">
                                                     <div class="input-group-append">
                                                         <span class="input-group-text" id="basic-addon2">Gram</span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="size" class="col-form-label">Size</label>
                                             <div class="row">
                                                 <div class="col-md-4">
                                                     <div class="input-group">
                                                         <input type="text" class="form-control" name="size" placeholder="Length" aria-describedby="basic-addon1" value="{{ $product->size}}">
                                                         <div class="input-group-append">
                                                             <span class="input-group-text" id="basic-addon1">Cm</span>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                     <div class="input-group">
                                                         <div class="input-group">
                                                             <input type="text" class="form-control" name="width" placeholder="Width" aria-describedby="basic-addon2" value="{{ $product->width}}">
                                                             <div class="input-group-append">
                                                                 <span class="input-group-text" id="basic-addon2">Cm</span>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                     <div class="input-group">
                                                         <div class="input-group">
                                                             <input type="text" class="form-control" name="height" placeholder="Height" aria-describedby="basic-addon2" value="{{ $product->height}}">
                                                             <div class=" input-group-append">
                                                                 <span class="input-group-text" id="basic-addon2">Cm</span>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <div class="row">
                                                 <div class="col-md-4">
                                                     <div class="custom-control custom-switch">
                                                         <input type="hidden" name="fefo" value="no">
                                                         <input type="checkbox" class="custom-control-input" id="fefoSwitch" name="fefo" value="yes" {{ $product->fefo == 'yes' ? 'checked' : '' }}>
                                                         <label class="custom-control-label" for="fefoSwitch">FEFO</label>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-4">
                                                     <div class="custom-control custom-switch">
                                                         <input type="hidden" name="qc" value="no">
                                                         <input type="checkbox" class="custom-control-input" id="defaultQCSwitch" name="qc" value="yes" {{ $product->qc == 'yes' ? 'checked' : '' }}>
                                                         <label class="custom-control-label" for="defaultQCSwitch">Default QC</label>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         @include('partials._photo_upload_form_update')

                                         <div class="form-row ml-4">
                                             <div class="form-group col-lg-6">
                                                 <label for="cost_of_goods" class="col-form-label">Cost of goods</label>
                                                 <input type="text" class="form-control" name="cost_of_goods" value="{{ $product->cost_of_goods}}">
                                             </div>
                                             <div class="form-group col-lg-5">
                                                 <label for="consumer_price" class="col-form-label">Consumer price</label>
                                                 <input type="text" class="form-control" name="consumer_price" value="{{ $product->consumer_price}}">
                                             </div>
                                         </div>
                                         <div class="form-row ml-4">
                                             <div class="form-group col-lg-6">
                                                 <label for="stock" class="col-form-label">Stock</label>
                                                 <input type="text" class="form-control" name="stock" value="{{ $product->stock}}">
                                             </div>
                                             <div class="form-group col-lg-5">
                                                <label for="store">Store</label>
                                                <select name="shop_id" id="store" class="form-control">
                                                    <option value="">-- Select store --</option>
                                                    @foreach ($stores as $store)
                                                        <option value="{{ $store->shop_id }}" {{ $store->shop_id == old('shop_id', $product->shop_id) ? 'selected' : '' }}>
                                                            {{ $store->shop_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-warning">Submit</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- End modal -->


                     @endforeach
                     @else

                     <div class="card mb-3 text-center">
                         <div class="card-body">
                             <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="{{ asset('storage/images/1705557639_nodata.jpg') }}" alt="...">
                             <h5>There is no Product yet</h5>
                             <p>Let's create your Product.</p>
                             <a class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#pullOrder">
                                 <span class="icon text-white-50">
                                     <i class="fas fa-solid fa-arrow-down"></i>
                                 </span>
                                 <span class="text">Pull Product</span>
                             </a>
                         </div>
                     </div>
                     @endif

                 </tbody>
             </table>
         </div>
         <div class="d-flex justify-content-end mt-4">

             {!! $products->links() !!}
         </div>
     </div>
 </div>
 @include('partials._modal_product_mapping')

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Get the "Check All" checkbox by its ID
         var checkAll = document.getElementById('checkAll');

         // Listen for clicks on the "Check All" checkbox
         checkAll.addEventListener('change', function() {
             // Get all checkboxes with the class 'checkItem'
             var checkboxes = document.querySelectorAll('.checkItem');

             // Set each checkbox's 'checked' property to match the "Check All" checkbox's 'checked' state
             checkboxes.forEach(function(checkbox) {
                 checkbox.checked = checkAll.checked;
             });
         });
     });
 </script>