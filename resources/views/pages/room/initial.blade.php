
<div class="container-fluid mt-3">
    <div class="card mb-4">
        <div class="card-header"> <h3 class="card-title mb-0">{{$roomname}} Rooms</h3> </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  align-middle py-3 text-center" id="initial_rooms_table">
                    <thead>
                        <tr>
                            <th class="text-center">Floor Number</th>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Is Booked</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach ($rooms as $room)

                        @php
                            // particular room  amount calculate
                                $room_amount=[];
                                $room_booking=App\Models\Booking::where('room_id',$room->id)->whereBetween('check_in_time', [$start_year,$end_year])->get();
                                    foreach($room_booking as $booking) {
                                    $advance =App\Models\Advance::where('booking_id',$booking->id)->get()->map(function($query){
                                        return $query->amount;
                                    })->toArray();
                                    $total_advance= array_sum($advance);
                                    $booking_net_amount= 0;
                                    if ($booking->advance_refund>0){
                                        $booking_net_amount= $total_advance-$booking->advance_refund ;
                                    }else{
                                        $booking_net_amount= $total_advance+$booking->paid_rent;
                                    }
                                    array_push($room_amount,$booking_net_amount);

                                    }
                                    $total_room_booking_amount=array_sum($room_amount);

                              // particular room  amount calculate
                        @endphp
                            <tr class="" style="background-color: {{ $room->is_booked ? '#C1E1C1' :''}}">
                                <td>{{ $room->floor_number }}</td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{  $total_room_booking_amount }}</td>

                                <td>{{ $room->is_booked ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
