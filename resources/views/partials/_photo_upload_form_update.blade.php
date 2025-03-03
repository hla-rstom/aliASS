<style>
    .photo-upload-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .photo-upload-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .photo-upload-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #00b4d8;
        border-radius: 10px;
        width: 100px;
        height: 100px;
    }

    .photo-upload-input {
        display: none;
    }

    .photo-upload-label {
        cursor: pointer;
        text-align: center;
    }

    .photo-preview {
        max-width: 100px;
        max-height: 100px;
        border-radius: 5px;
        margin-bottom: 5px;
    }
</style>
<div class="card mt-4">
    <div class="card-header">Photo Product</div>
    <div class="card-body">
        <div class="photo-upload-container mb-4 ml-4">
            
            <div class="photo-upload-grid">
    <!-- Display images from the $images array first -->
    @if (!empty($images) && is_array($images))
        
            <img src="{{ $photoUrl }}" alt="Product Photo" style="width: 50px; height: auto;">
        
    @endif

    <!-- Display images from the PhotoProduct model if they exist -->
    @if ($product->photos()->exists())
        @foreach ($product->photos as $photo)
            <img src="{{ asset('storage/' . $photo->path) }}" alt="Product Photo" style="width: 50px; height: auto;">
        @endforeach
    @else
        <span>No additional photos</span>
    @endif
</div>


        </div>
    </div>
</div>

<script>
    function previewFile(index) {
        // Correct the id to match the input's id
        var file = document.getElementById('image' + index).files[0];
        var preview = document.getElementById('previewImage' + index);
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            // Display the image as a block element
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = 'none';
        }
    }
</script>