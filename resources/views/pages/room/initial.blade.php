<br>
<div class="container">
    <div class="card mb-4">
        <div class="card-header">

        <div class="card-body">
            <h3 class="card-title">Rooms</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle py-3 text-center" id="initial_rooms_table">
            <thead>
                <tr>
                    <th class="text-center">Floor Number</th>
                    <th class="text-center">Room Number</th>
                    <th class="text-center">Is Booked</th>
                </tr>
            </thead>
            <tbody class="text-capitalize">
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->floor_number }}</td>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->is_booked ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
