@component('mail::message')
# Your Booking Request Details

## Bike Details:
Bike: {{$name}}

![{{$name}}][logo]
{{-- [logo]: {{asset('bikes/'.$image)}} --}}
[logo]: https://i1.wp.com/wp.laravel-news.com/wp-content/uploads/2016/12/laravel-markdown-emails.png?resize=525%2C298

Hourly Rate: &#8377; {{$hourly_rate}}/-

## Ride Details
Ride Start Date: {{$ride_start_date}}

Ride End Date: {{$ride_end_date}}

Total Hours: {{$ride_duration}}

Total Cost: &#8377; {{$total_amount}}/-

@component('mail::button', ['url' => ''])
Learn More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
