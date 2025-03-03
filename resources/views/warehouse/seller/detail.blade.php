

<style>
  .rating {
    font-family: Arial, sans-serif;
    text-align: center;
  }

  .rating-label,
  .rating-date {
    display: block;
  }

  .stars {
    color: #ccc;
    /* Color for the empty stars */
  }

  .star {
    font-size: 1.5em;
    margin: 0.1em;
    cursor: pointer; /* Added cursor pointer */
  }

  .checked {
    color: #ff0;
    /* Yellow color for the filled stars */
  }
</style>


@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @include('partials._alert')

    <div class="col-lg-12">
        <div class="col-md-6 text-left">
            <h3 class=" text-gray-800">Seller Detail</h3>
            <div class="row ml-2">
                <a href="{{ route('sellerlist') }}">Seller List /</a> &nbsp;
                <div class="small-text"> Seller Detail</div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        @if(isset($seller->user->photo))
                        <img src="{{ asset('storage/'. $seller->user->photo) }}" alt="Main Photo" style="width: 200px; height: auto;" class="rounded">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4 class="card-title font-weight-bold">{{ $seller->user->name ?? ''}}</h4>
                        <p class="card-text"><i class="fas fa-map-pin"></i> {{ $seller->user->address->street_address ?? ''}}</p>
                        <p class="card-text"><i class="fas fa-mail"></i> {{ $seller->user->email ?? ''}}</p>
                        <div class="row">
                            <div class="align-items-center">
                                <form action="{{ route('contact', $seller->user->phone) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-light active mr-2" title="Chat Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </button>
                                </form>
                                
                                    <button type="button" class="btn btn-lg btn-light active mr-2" title="Review Warehouse"  data-toggle="modal" data-target="#reviewModal">
                                        <i class="fas fa-star"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Create Review Warehouse -->
        <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Seller Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('review') }}" method="POST">
                @csrf
                <div class="modal-body">
                  <div class="form-group rating">
                    <label for="star" class="rating-label">Rating</label>
                    <div id="star-rating" class="stars">
                      <i class="fas fa-star star" data-value="1"></i>
                      <i class="fas fa-star star" data-value="2"></i>
                      <i class="fas fa-star star" data-value="3"></i>
                      <i class="fas fa-star star" data-value="4"></i>
                      <i class="fas fa-star star" data-value="5"></i>
                    </div>
                    <input type="hidden" name="star" id="star-input">
                    <input type="hidden" name="seller_id" value="{{$id}}">
                  </div>
                  <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        

        <div class="row mt-4">
           <div class="col-xl-4 col-md-6 mb-4">
               <div class="card shadow h-60 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   Warehouse Capacity Utilized</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-home fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-xl-4 col-md-6 mb-4">
               <div class="card  shadow h-60 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                   Total Transaction</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProductTransactions}}</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-truck fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-xl-4 col-md-6 mb-4">
               <div class="card  shadow h-60 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                   Total Product</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800">{{$productTotal}}</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-solid fa-box fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Seller Products
            <button class="btn btn-link" data-toggle="collapse" data-target="#productsCardCollapse" aria-expanded="true" aria-controls="productsCardCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </h6>
    </div>
    <div id="productsCardCollapse" class="collapse show"> <!-- Initially shown, use 'collapse' to collapse by default -->
        <div class="card-body">
            <table id="example" class="table table-borderless mt-4" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>SKU</th>
                                    <th>Qty</th>
                                    <th>Product Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $request)
                                @foreach ( $request->product_request as $productrequest)
                                <tr>
                                    <td> {{ $productrequest->product->name ?? ''}} </td>
                                    <td>
                                        @php
                                            $images = optional($productrequest->product)->image ? json_decode($productrequest->product->image, true) : null;
                                        @endphp

                                        @if (!empty($images) && is_array($images) && !empty($images[0]))
                                            <img src="{{ asset($images[0]) }}" alt="Main Photo" style="width: 50px; height: auto;">
                                        @else
                                            <img src="{{ asset('asset/img/default.png') }}" alt="Default Photo" style="width: 50px; height: auto;">
                                        @endif
                                    </td>

                                    <td> {{ $productrequest->product->sku ?? ''}} - {{ $productrequest->variation->model_sku ?? ''}} </td>
                                    <td> {{$productrequest->qty}} </td>
                                    <td> {{ $productrequest->product->consumer_price ?? ''}} </td>
                                </tr>
                                @endforeach
                                @endforeach


                            </tbody>
                        </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Reviews
            <button class="btn btn-link" data-toggle="collapse" data-target="#reviewsCardCollapse" aria-expanded="true" aria-controls="reviewsCardCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </h6>
    </div>
    <div id="reviewsCardCollapse" class="collapse show"> <!-- Initially shown, use 'collapse' to collapse by default -->
        <div class="card-body">
            <table class="table table-borderless mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ \Carbon\Carbon::parse($review->date)->format('F, Y') }}</td>
                        <td>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->star)
                                        <span class="star checked">&#9733;</span> <!-- Filled star -->
                                    @else
                                        <span class="star">&#9734;</span> <!-- Empty star -->
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td>
                            @if($review->reviewer == Auth::id())
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#updatereviewModal{{ $review->id }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $review->id }}"><i class="fas fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Update Review Warehouse -->
        @foreach ($reviews as $review)
<div class="modal fade" id="updatereviewModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="updatereviewModalLabel{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatereviewModalLabel{{ $review->id }}">Edit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateReview', $review->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group rating">
                        <label for="star{{ $review->id }}" class="rating-label">Rating</label>
                        <div id="star-rating{{ $review->id }}" class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star star {{ $i <= $review->star ? 'checked' : '' }}" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="star" id="star-input{{ $review->id }}" value="{{ $review->star }}">
                    </div>
                    <div class="form-group">
                        <label for="comment{{ $review->id }}">Comment</label>
                        <textarea class="form-control" id="comment{{ $review->id }}" name="comment" rows="3">{{ $review->comment }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal delete Review Warehouse -->
@foreach ($reviews as $review)
<div class="modal fade" id="deleteModal{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $review->id }}">Delete Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('deleteReview', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete this review?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



    </div>
</div>


<script>
  $(document).ready(function() {

    $('.nav-link-edit').click(function() {
      // Remove active class from all tabs
      $('.nav-link-edit').removeClass('active');
      $('.tab-pane-edit').removeClass('show active');

      // Add active class to clicked tab
      $(this).addClass('active');
      var tabTarget = $(this).attr('href');
      $(tabTarget).addClass('show active');

      // Prevent default anchor behavior
      return false;
    });

    $('#star-rating .star').on('click', function() {
      var value = $(this).data('value');
      $('#star-input').val(value);

      // Toggle the star rating if clicked again
      if ($(this).hasClass('checked')) {
        $('#star-rating .star').removeClass('checked');
        $('#star-input').val('');
      } else {
        $('#star-rating .star').each(function() {
          if ($(this).data('value') <= value) {
            $(this).addClass('checked');
          } else {
            $(this).removeClass('checked');
          }
        });
      }
    });
    
    
  });
</script>

@endsection