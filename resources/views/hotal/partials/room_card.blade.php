<div class="col-sm col-md-6 col-lg-4 ftco-animate fadeInUp ftco-animated">
    <div class="room">
        <a href="{{ route('room-single', ['id' => $room->id]) }}" class="img d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/room-1.jpg') }}');">
            <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-search2"></span>
            </div>
        </a>
        <div class="text p-3 text-center">
            <h3 class="mb-3"><a href="{{ route('room-single', ['id' => $room->id]) }}">{{$room->RoomType->name}}</a></h3>
            <h3><span class="price mr-2"></span>$ {{$room->RoomType->base_price}} <span class="per" style="color: black;">per night</span></h3>
            <ul class="list">
                @php
                    $statusColor = match(strtolower($room->status)) {
                        'available' => 'success',
                        'occupied' => 'danger',
                        'cleaning' => 'info',
                        'maintenance' => 'warning',
                        default => 'secondary'
                    };
                @endphp
                <li style="padding:5px;"><span >Status:</span> <span style="color: black;padding:10px;" class="badge badge-{{ $statusColor }}">{{ ucfirst($room->status) }}</span></li>
                <li><span>Max Person:</span> {{$room->RoomType->max_persons}} </li>
                <li><span>Size:</span> {{$room->RoomType->room_size}} </li>
                <li><span>Room No :</span> {{$room->room_number}} </li>
                <li><span>Bed: </span> {{$room->RoomType->beds}} </li>
            </ul>
            <hr>
            <p class="pt-1"><a href="{{ route('room-single', ['id' => $room->id]) }}" class="btn-custom">Book Now <span
                        class="icon-long-arrow-right"></span></a></p>
        </div>
    </div>
</div>
