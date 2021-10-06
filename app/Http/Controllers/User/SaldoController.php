<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Midtrans;
Use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use Auth;
use App\Traits\KategoriNav;
class SaldoController extends Controller
{
    use KategoriNav;
    //
    public function index()
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $saldo=Transaksi::where('id_user','=',Auth::user()->id)
        ->where('jenis','=','TopUp')->latest()->paginate(20);
        return view('user.akun.saldo',compact(['kategori','artikel','saldo']));
    }
    public function store(Request $request)
    {
        $tanggal=date('ymd');
        $no="0000";
        $nourut=Transaksi::max('orderid');
        $cektanggal=substr($nourut,0,6);
        $hasil_urut=$tanggal.$no;
        $hasil="";
        if($tanggal==$cektanggal){
            $hasil=$nourut+1;
        }else{
            $hasil=$hasil_urut+1;
        }
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ii1gBdtLV-5JFdb11U_lyE1O';

        // Uncomment for production environment
        \Midtrans\Config::$isProduction = false;

        // Uncomment to enable sanitization
        \Midtrans\Config::$isSanitized = true;

        // Uncomment to enable 3D-Secure
        \Midtrans\Config::$is3ds = true;

        // Required
        $transaction_details = array(
            'order_id' => $hasil,
            'gross_amount' => $request->jumlah, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => '0',
            'price' => $request->jumlah,
            'quantity' => 1,
            'name' => 'Topup SaldoKebaikan'
        );

        // Optional
        $item2_details = array(
            'id' => 'a2',
            'price' => 45000,
            'quantity' => 1,
            'name' => "Orange"
        );

        // Optional
        $item_details = array ($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => Auth::user()->name,
            // 'last_name'     => "Litani",
            'email'         => Auth::user()->email
            // 'phone'         => "081122334455"
            // 'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        //simpan ke database
        Transaksi::create([
            'transaksiid'=>"0",
            'orderid'=>$hasil,
            'tipe'=>"0",
            'id_program'=>null,
            'id_user'=>Auth::user()->id,
            'nama'=>Auth::user()->name.'(TopUp)',
            'nominal'=>$request->jumlah,
            'pesan'=>$request->pesan,
            'status'=>"Belum Transaksi",
            'jenis'=>"TopUp"
        ]);
        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
            return redirect($paymentUrl);

        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
