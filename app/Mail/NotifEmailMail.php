<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nama;
    public $detail;
    public $nominal;
    public $tanggal;
    public $username;
    public $idprogram;
    public $image;
    public function __construct($nama,$detail,$nominal,$tanggal,$usernama,$idprogram,$image)
    {
        $this->nama=$nama;
        $this->detail=$detail;
        $this->nominal=$nominal;
        $this->tanggal=$tanggal;
        $this->username=$usernama;
        $this->idprogram=$idprogram;
        $this->image=$image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('app@kemas.com')
                   ->view('email.notif')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'detail' => $this->detail,
                        'nominal' => $this->nominal,
                        'tanggal' => $this->tanggal,
                        'usrnama' => $this->username,
                        'idprogram' => $this->idprogram,
                        'image'=>$this->image,
                    ]);
        // return $this->view('view.name');
    }
}
