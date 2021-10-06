<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Midtrans;
Use App\Models\Transaksi;
use App\Models\User;
use App\Models\Program;
use Auth;
class TransaksiController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate($request, [
            'jumlah'     => 'required',
            'tipe'  => 'required|in:dompet,transfer'
        ]);
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
            if(isset($request->status)){
                $status="Anonim";
            }else{
                $status=Auth::user()->name;
            }
            //cek tipe
            // dd($request->tipe);
            if($request->tipe=='dompet'){
                if($request->jumlah > Auth::user()->saldo){
                    return redirect()->route('programuser.show',$request->id_donasi);
                }
                Transaksi::create([
                    'transaksiid'=>$hasil,
                    'orderid'=>$hasil,
                    'tipe'=>"Dompet_Kebaikan",
                    'id_program'=>$request->id_donasi,
                    'id_user'=>Auth::user()->id,
                    'nama'=>$status,
                    'nominal'=>$request->jumlah,
                    'pesan'=>$request->pesan,
                    'status'=>"settlement",
                    'jenis'=>"Donasi"
                ]);
                $user=User::findorfail(Auth::user()->id);
                $jumlahsaldo=$user->saldo-$request->jumlah;
                $user->update([
                    'saldo'=>$jumlahsaldo
                ]);
                // dd($jumlahsaldo);
                return redirect()->route('programuser.show',$request->id_donasi);
            }else{
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
                'id' => $request->id_donasi,
                'price' => $request->jumlah,
                'quantity' => 1,
                'name' => $request->nama_donasi
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
            Transaksi::create([
                'transaksiid'=>"0",
                'orderid'=>$hasil,
                'tipe'=>"0",
                'id_program'=>$request->id_donasi,
                'id_user'=>Auth::user()->id,
                'nama'=>$status,
                'nominal'=>$request->jumlah,
                'pesan'=>$request->pesan,
                'status'=>"Belum Transaksi",
                'jenis'=>"Donasi"
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
    public function finish(Request $request)
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ii1gBdtLV-5JFdb11U_lyE1O';
        $orderId=$request->get('order_id');
        $status = \Midtrans\Transaction::status($orderId);
        $i=0;
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
        if($transaksi->jenis=='TopUp'){
            return redirect(route('saldouser'));
        }else{
            return redirect(route('programuser.show',$transaksi->id_program));
        }
    }
    public function notifikasi(Request $request)
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ii1gBdtLV-5JFdb11U_lyE1O';
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $transactionid = $notif->transaction_id;
        $transaction_time = $notif->transaction_time;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $jumlah=$notif->gross_amount;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id ." is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $transaksi = Transaksi::where('orderid','=',$order_id)->first();

            //saldokebaikan
            // dd($transaksi);
            if($transaksi->jenis=='TopUp'){
                $akunuser=User::where('id','=',$transaksi->id_user)->first();
                if(!($akunuser->saldo)){
                    $akunuser->update([
                        'saldo'=>$jumlah
                    ]);
                }else{
                    $hasil=$jumlah+$akunuser->saldo;
                    $akunuser->update([
                        'saldo'=>$hasil
                    ]);
                }
            }

            $transaksi->update([
                'transaksiid'=>$transactionid,
                'tipe'=>$type,
                'status'=>$transaction
            ]);
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $transaksi = Transaksi::where('orderid','=',$order_id)->first();
            $transaksi->update([
                'transaksiid'=>$transactionid,
                'tipe'=>$type,
                'status'=>$transaction
            ]);
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi = Transaksi::where('orderid','=',$order_id)->first();
            $transaksi->update([
                'transaksiid'=>$transactionid,
                'tipe'=>$type,
                'status'=>$transaction
            ]);
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $transaksi = Transaksi::where('orderid','=',$order_id)->first();
            $transaksi->update([
                'transaksiid'=>$transactionid,
                'tipe'=>$type,
                'status'=>$transaction
            ]);
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $transaksi = Transaksi::where('orderid','=',$order_id)->first();
            $transaksi->update([
                'transaksiid'=>$transactionid,
                'tipe'=>$type,
                'status'=>$transaction
            ]);
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }
}
