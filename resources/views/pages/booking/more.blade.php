
    <div class="card mx-3 mt-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Patient Name</th>
                        <th>Check-in Time</th>
                        <th>Room Number</th>
                        <th>Room Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookingData as $booking)
                        <tr>
                            <td>{{ $booking->guest_name }}</td>
                            <td>{{ $booking->patient_name }}</td>
                            <td>{{ $booking->check_in_time }}</td>
                            <td>{{ $booking->Room->room_number }}</td>
                            <td>{{ $booking->room->category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>



