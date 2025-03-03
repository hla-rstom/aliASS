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
{{ session()->forget('success') }}
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert" id="warning-alert">
    {{ session('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ session()->forget('warning') }}
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ session()->forget('error') }}
@endif

<!-- @if (session('created_products'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    Newly created products:
    <ul>
        @foreach (session('created_products') as $product)
        <li>{{ $product }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ session()->forget('created_products') }}
@endif -->

<!-- @if (session('updated_products'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    Updated products:
    <ul>
        @foreach (session('updated_products') as $product)
        <li>{{ $product }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ session()->forget('updated_products') }}
@endif -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow", function() {
                $(this).remove();
            });
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>
