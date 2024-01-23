
    <div class="card mb-5">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h3 class="text-purple fw-bold mb-0">Booking Information</h3>
            <div>
                <button class="btn btn-sm btn-purple print d-print-none" ><i class="fa fa-print"></i></button>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-3"><strong>Guest Name:</strong> {{ $booking->guest_name }}</p>
            <p class="mb-3"><strong>Mobile Number:</strong> {{ $booking->mobile_number }}</p>
            <p class="mb-3"><strong>Paid Rent:</strong> {{ $booking->paid_rent}}</p>

            @if ($advances->isNotEmpty())
            <div class="card-header bg-light px-0">
                <h5 class="card-title text-purple mb-0">Advance Information</h5>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="px-0">Advance Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advances as $advance)
                            <tr>
                                <td class="px-0">{{ date('d/m/Y',strtotime($advance->received_date)) }}</td>
                                <td>{{ $advance->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-start">
                    <p class="mb-3"><strong>Refund Amount:</strong> {{ $refundAmount }}</p>
                    <p class="lead"><strong>Total Amount:</strong> {{ $totalAmount }}</p>
                </div>

        </div>
    </div>
    @else
        <div class="alert alert-warning mt-4" role="alert">
            No advances data available for this booking.
        </div>
    @endif
<script>
    //print code
    $(document).on("click", ".print", function () {
        const modalBody = $(".modal-body").detach();
        // const content = $(".content").detach();
        $(".card-body").append(modalBody);
        window.print();
});

</script>




