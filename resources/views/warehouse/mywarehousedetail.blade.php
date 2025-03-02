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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="col-lg-12">
        <div class="col-md-6 text-left">
            <h3 class=" text-gray-800">My Warehouse Detail</h3>
            <div class="row ml-2">
                <a href="{{ route('mywarehouse') }}">My Warehouse /</a> &nbsp;
                <div class="small-text"> My Warehouse Detail</div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        @if(isset($mywarehouse->warehouse->photo))
                        <img src="{{ asset('storage/'. $mywarehouse->warehouse->photo) }}" alt="Main Photo" style="width: 200px; height: auto;" class="rounded">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h4 class="card-title font-weight-bold">{{ $mywarehouse->warehouse->name ?? ''}}</h4>
                        <p class="card-text"><i class="fas fa-map-pin"></i> {{ $mywarehouse->warehouse->area ?? ''}}</p>
                        <div class="row">
                            <div class="align-items-center">
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    <button type="button" class="btn btn-lg btn-light active mr-2" title="Share Link">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </form>
                                <form action="{{ route('contact', $mywarehouse->warehouse->user->phone) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-light active mr-2" title="Chat Whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </button>
                                </form>
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    <button type="button" class="btn btn-lg btn-light active mr-2" title="Chat Warehouse">
                                        <i class="fas fa-comment-dots"></i>
                                    </button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#termsModalMove">Move Warehouse</button>
                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#termsModalExit">Exit Warehouse</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#reviewModal">Add Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Seller Review Warehouse -->
        <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Warehouse Review</h5>
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
                    <input type="hidden" name="warehouse_id" value="{{$id}}">
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


        <!-- Modal -->
        <div class="modal fade" id="termsModalMove" tabindex="-1" role="dialog" aria-labelledby="termsModalMoveLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalMoveLabel">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('moveform',$id)}}" type="button" class="btn btn-primary">Agree</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- Modal -->
        <div class="modal fade" id="termsModalExit" tabindex="-1" role="dialog" aria-labelledby="termsModalExitLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalExitLabel">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque laboriosam, suscipit ipsum delectus nemo eius molestias id minima, voluptatum dolorem omnis similique corrupti eveniet provident debitis obcaecati ad odio temporibus.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In quia, porro consequatur similique excepturi numquam ab ea fuga reiciendis ipsam, fugit mollitia eaque adipisci? Porro necessitatibus cupiditate ratione asperiores animi?</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{route('exitform',$id)}}" type="button" class="btn btn-primary">Agree</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <div class="row mt-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow h-60 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Warehouse Capacity Utilized</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProductUtilized}}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalOfTransaction}}</div>
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
                                    Total Seller</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalOfSellers}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <table id="example" class="table table-borderless" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Transaction Type</th>
                            <th>Transaction Code</th>
                            <th>Transaction Date</th>
                            <th>Total Sku</th>
                            <th>Qty Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                        @foreach ($transaction->producttransaction as $producttransaction)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$transaction->type}}</td>
                            <td>{{$transaction->invoice_code}}</td>
                            <td>{{$transaction->date}}</td>
                            <td>{{$totalProducts}}</td>
                            <td>{{$producttransaction->qty}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


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