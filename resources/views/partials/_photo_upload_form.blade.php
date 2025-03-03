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
<div class="photo-upload-container mb-4 ml-4">
    <label for="productPhotos">Photo Produk</label>
    <div class="photo-upload-grid">
        @for ($i = 1; $i <= 9; $i++) <div class="photo-upload-box">
            <input type="file" id="photo{{ $i }}" class="photo-upload-input" name="photo{{ $i }}" accept="image/*">
            <label for="photo{{ $i }}" class="photo-upload-label">{{ $i == 1 ? 'Main Photo' : 'Photo' . $i }}</label>
            <img id="previewImage{{ $i }}" src="" alt="Preview Image" class="photo-preview" style="display: none;" />
    </div>
    @if ($i==6)
</div>
<div class="photo-upload-grid mt-2 mb-4">
    @endif
    @endfor
</div>
</div>

<script>
    // Function to update the image preview
    function updateImagePreview(inputId, imageId) {
        var input = document.getElementById(inputId);
        var image = document.getElementById(imageId);

        // Ensure the file input and image elements exist
        if (input && image) {
            input.addEventListener('change', function() {
                // Ensure the file input has files
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Set the image src to the file content (base64)
                        image.src = e.target.result;
                        image.style.display = 'block'; // Show the image
                    };

                    // Read the first file in the file input
                    reader.readAsDataURL(input.files[0]);
                }
            });
        }
    }

    // Call the function for all photo inputs
    @for($i = 1; $i <= 9; $i++)
    updateImagePreview('photo{{ $i }}', 'previewImage{{ $i }}');
    @endfor
</script>