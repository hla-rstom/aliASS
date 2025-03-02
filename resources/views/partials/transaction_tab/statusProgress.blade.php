<style>
    .progress-indicator {
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .progress-circle {
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 50%;
        background-color: #fff;
        position: relative;
    }

    .progress-circle::before {
        content: '';
        position: absolute;
        top: 9px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #ccc;
        z-index: -1;
        transform: translateX(-50%);
    }

    .progress-circle:first-child::before {
        content: none;
    }

    .progress-circle.active {
        border-color: #007bff;
        /* Bootstrap primary color */
        background-color: #007bff;
    }

    .status-labels {
        display: flex;
        font-size: medium;
        justify-content: space-between;
        margin-top: 5px;
    }

    .status-label {
        display: block;
        color: #ccc;
        font-size: 12px;
        text-align: center;
        transition: color 0.3s;
    }

    .status-label.active {
        color: #007bff;
        /* Bootstrap primary color */
    }
</style>

<div class="col-lg-12 mt-4" id="statusProgressModal" style="display: none;">
    <div class="" style="display: none;" data-status="{{$currentstatus['status']}}"></div>
    <div class="card">
        <div class="card-header text-primary"><b>Detail Transaction Status</b></div>
        <div class="card-body">
            <div class="progress-indicator">
                <div id="progress1" class="progress-circle"></div>
                <div id="progress2" class="progress-circle"></div>
                <div id="progress3" class="progress-circle"></div>
                <div id="progress4" class="progress-circle"></div>
                <div id="progress5" class="progress-circle"></div>
            </div>
            <div class="status-labels">
                <span id="label1" class="status-label">Not Pickup</span>
                <span id="label2" class="status-label">Ready to Pack</span>
                <span id="label3" class="status-label">Packed</span>
                <span id="label4" class="status-label">Request Pick Up</span>
                <span id="label5" class="status-label">Done</span>
            </div>
            <div class="row mb-2 mt-4">
                <div class="col-6">
                    <strong>Logistic</strong>
                    <div>{{ $transaction->logisticransaction->shipping_carrier ?? '' }}</div>
                </div>
                <div class="col-6">
                    <strong>No AWB</strong>
                    <div>{{ $transaction->logisticransaction->package_number ?? '' }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <strong>Booking Code</strong>
                    <div>{{ $transaction->logisticransaction->tracking_no ?? '' }}</div>
                </div>
                <div class="col-6">
                    <strong>Date AWB</strong>
                    <div>{{ $transaction->logisticransaction->created_at ?? '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var divElement = document.querySelector('[data-status]');

    if (divElement) {
        var statusValue = divElement.getAttribute('data-status');

        var status = parseInt(statusValue, 10);
        console.log(status);
    } else {
        console.error('Div element with data-status attribute not found.');
    }
    document.getElementById("viewDetailLink").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default link behavior
        var modal = document.getElementById("statusProgressModal");
        if (modal.style.display === "none") {
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    });

    function updateStatusProgress(activeStatusIndex) {
        // Remove 'active' class from all circles and labels
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`progress${i}`).classList.remove('active');
            document.getElementById(`label${i}`).classList.remove('active');
        }

        // Add 'active' class to circles and labels up to the current status
        for (let i = 1; i <= activeStatusIndex; i++) {
            document.getElementById(`progress${i}`).classList.add('active');
        }

        // Add 'active' class to the current status label
        document.getElementById(`label${activeStatusIndex}`).classList.add('active');
    }

    // Call this function with the current status number (1-5)
    updateStatusProgress(status); // This will activate up to the third circle and label
</script>