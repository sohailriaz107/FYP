<x-mail::message>
# Booking {{ ucfirst($booking->status) }}

Dear {{ $booking->Guest }},

Your Booking is {{ $booking->status }}. Here are the details of your reservation:

- **Room Type:** {{ $booking->RoomType }}
- **Room No:** {{ $booking->RoomNo }}
- **Check-in Date:** {{ \Carbon\Carbon::parse($booking->Check_in)->format('d-M-Y') }}
- **Check-out Date:** {{ \Carbon\Carbon::parse($booking->Check_out)->format('d-M-Y') }}
- **Total Nights:** {{ $booking->night }}
- **Total Price:** ${{ $booking->total_price }}

Thanks for choosing StayEase.

<x-mail::button :url="config('app.url') . '/profile'">
View Your Bookings
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
