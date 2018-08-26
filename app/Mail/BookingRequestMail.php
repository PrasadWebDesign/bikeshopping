<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Bike;

class BookingRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    // this public properties will automatically be available to markdown
    public $name;
    public $hourly_rate;
    public $image;
    public $ride_start_date;
    public $ride_end_date;
    public $ride_duration;
    public $total_amount;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bike $bike)
    {
        $this->name = $bike->bike_title;
        $this->hourly_rate = $bike->hourly_rate;
        $this->image = $bike->cover_image;
        

        // $this->name = $email['name'];
        // $this->hourly_rate = $email['hourly_rate'];
        // $this->image = $email['image'];
        // $this->ride_start_date = $email['ride_start_date'];
        // $this->ride_end_date = $email['ride_end_date'];
        // $this->ride_duration = $email['ride_duration'];
        // $this->total_amount = $email['total_amount'];
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.BookingRequestMail');
    }
}
