<div class="content px-3 py-0 w-100">
    <div class="container-fluid mt-5">
        <div class="card">

            <h6  style="width: 10cm">Guest Name: {{ $guest_name }} &nbsp; Room Number: {{ $room_number }}</h6>


            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="text-purple fw-bold mb-0">Add Advance</h3>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success w-25 text-center mx-auto" role="alert" id="alert1">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="card-body">
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
                    <button type="submit" class="btn btn-purple">Add Advance</button>
                </form>
            </div>
        </div>
    </div>
</div>


@if ($advances->count() > 0)
    <table class="table">
        <thead>
            <tr >
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
                    <td >{{ date('d-M-y', strtotime($advance->received_date))}}</td>
                    {{-- <td>{{ date('d/m/Y',strtotime($room->booked_date))}}</td> --}}
                </tr>

                @php
                    $totalAmount += $advance->amount;
                @endphp
            @endforeach
        </tbody>
    </table>
    <p class="text-muted d-block">Total Amount: {{ $totalAmount }}</p>
@endif
