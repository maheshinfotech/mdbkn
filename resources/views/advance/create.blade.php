<div class="content px-3 py-0 w-100">
    <div class="container-fluid mt-2">
        <div class="modal-header border border-0 px-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="card mb-5">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Add Advance</h3>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card-body ">
                <div class="text-center text-purple text-capitalize">
                    <h5>Guest Name: {{ $guest_name }} ({{ $room_number }})</h5>
                </div>
                <form method="POST" action="{{ route('advance.store') }}">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking_id }}">

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="received_date" class="form-label">Received Date</label>
                        <input type="date" class="form-control" id="received_date" name="received_date" required>
                    </div>
                    <div class="text-center my-4">
                        <button type="submit" class="btn btn-purple">Add Advance</button>
                    </div>

                </form>

                @if ($advances->count() > 0)
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Received Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAmount = 0;
                            @endphp

                            @foreach ($advances as $advance)
                                <tr>
                                    <td>{{ $advance->amount }}</td>
                                    <td>{{ $advance->received_date }}</td>
                                </tr>
                                @php
                                    $totalAmount += $advance->amount;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-center mb-0">Total Amount: {{ $totalAmount }}</p>
                @endif
            </div>
        </div>
    </div>
</div>


{{-- @if ($advances->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Received Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0
            @endphp

            @foreach ($advances as $advance)
                <tr>
                    <td>{{ $advance->amount }}</td>
                    <td>{{ date('d-M-y', strtotime($advance->received_date))}}</td>
                </tr>

                @php
                    $totalAmount += $advance->amount;
                @endphp
            @endforeach
        </tbody>
    </table>
    <p>Total Amount: {{ $totalAmount }}</p>
@endif --}}
