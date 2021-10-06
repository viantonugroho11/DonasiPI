<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Midtrans\Midtrans;
use Auth;
class TransaksiController extends Controller
{
    //
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
        if($request->status=="Ya"||$request->status==null){
            $status="Anonim";
        }else{
            $status=$request->namauser;
        }
        // dd($request->iddonasi);
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ii1gBdtLV-5JFdb11U_lyE1O';

        // Uncomment for production environment
        \Midtrans\Config::$isProduction = false;

        // Uncomment to enable sanitization
        \Midtrans\Config::$isSanitized = true;

        // Uncomment to enable 3D-Secure
        \Midtrans\Config::$is3ds = true;

        // // Required
        $transaction_details = array(
            'order_id' => $hasil,
            'gross_amount' => $request->jumlah, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => $request->iddonasi,
            'price' => $request->jumlah,
            'quantity' => 1,
            'name' => $request->namadonasi
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
            'first_name'    => $status,
            // 'last_name'     => "Litani",
            'email'         => $request->email
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
        Transaksi::create([
            'transaksiid'=>"0",
            'orderid'=>$hasil,
            'tipe'=>"0",
            'id_program'=>$request->iddonasi,
            'id_user'=>$request->iduser,
            'nama'=>$status,
            'nominal'=>$request->jumlah,
            'pesan'=>$request->pesan,
            'status'=>"Belum Transaksi",
            'jenis'=>"Donasi"
        ]);
        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => rand(),
        //         'gross_amount' => 10000,
        //     )
        // );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json([
            'success' => true,
            'message' => 'Transaksi Berhasil',
            'data'    => $snapToken
        ], 200);
    }
    public function finish(Request $request)
    {
        // \Midtrans\Config::$isProduction = false;
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-ii1gBdtLV-5JFdb11U_lyE1O';
        // $orderId=$request->get('order_id');
        // $status = \Midtrans\Transaction::status($orderId);
        // $i=0;
        $status=$request->all();
        foreach($status as $k=>$val){
            if($k=="transaction_time"){
                $transaksi_waktu=$val;
            }else if($k=="gross_amount"){
                $jumlah=$val;
            }else if($k=="payment_type"){
                $tipe=$val;
            }else if($k=="transaction_status"){
                $transaksi_status=$val;
            }else if($k=="transaction_id"){
                $id_transaksi=$val;
            }elseif($k=="order_id"){
                $order_id=$val;
            }
        }
        // dd($jumlah);
        $transaksi = Transaksi::where('orderid','=',$order_id)->first();
        $transaksi->update([
            'transaksiid'=>$id_transaksi,
            'tipe'=>$tipe,
            'status'=>$transaksi_status
        ]);
        // if($transaksi->jenis=='TopUp'){
        //     return redirect(route('saldouser'));
        // }else{
        //     return redirect(route('programuser.show',$transaksi->id_program));
        // }
        return response()->json([
            'success' => true,
            'message' => 'Transaksi Berhasil',
            'data'    => $transaksi
        ], 200);
    }
}
