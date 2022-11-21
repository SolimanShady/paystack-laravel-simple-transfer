<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfers as Model;

class TransferController extends Controller
{
    private $secretKey;

    function __construct()
    {
        $this->secretKey = config("paystack")["secret_key"];
    }


    /**
     * verifyAccount
     * recipient account verification
     *
     * @param object $request
     * @return json object
     */
    public function verifyAccount(Request $request)
    {
        $account_number = $request->account_number;
        $bank_code = $request->bank_code;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number={$account_number}&bank_code={$bank_code}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer {$this->secretKey}",
            "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
            if ( !$response->status ) {
                return redirect()->route("index")->with("message", "Account verification failed");
            }

            $account_name = $response->data->account_name;

            return redirect()->route('createRecipient',  [$account_name, $account_number, $bank_code]);

        }
    }

    /**
     * getbankInfo
     * Get recipient bank account information
     *
     * @param null
     * @return json object
     */
    public function getbankInfo()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer {$this->secretKey}",
            "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
            return $response;
        }
    }

    /**
     * createRecipient
     * start creatin recipient process
     *
     * @param string $account_name
     * @param int $account_number
     * @param int $bank_code
     * @return json object
     */

    public function createRecipient($account_name, $account_number, $bank_code)
    {
        $url = "https://api.paystack.co/transferrecipient";
        $fields = [
          'type' => "nuban",
          'name' => $account_name,
          'account_number' => $account_number,
          'bank_code' => $bank_code,
          'currency' => "NGN"
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer {$this->secretKey}",
          "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        if ( !$result->status ) {
            return redirect()->route('createRecipient')->with('message', 'Recipient creation failed');
        }

        $bank_name = $result->data->details->bank_name;
        $recipient_code = $result->data->recipient_code;

        return view('transfer.amount', compact('account_name','account_number', 'bank_name', 'recipient_code'));
    }

    /**
     * transfer
     * transfer money process
     *
     * @param object $request
     * @return json object
     */
    public function transfer(Request $request)
    {
        $url = "https://api.paystack.co/transfer";

        $request->validate([
            "amount" => "required",
            "reason" => "required"
        ]);

        $fields = [
          'source' => "balance",
          'amount' => $request->amount . 00,
          'recipient' => $request->recipient_code,
          'reason' => $request->reason
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer {$this->secretKey}",
          "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result);

        $transfer_code = $result->data->transfer_code;

        return view('transfer.otp', compact('transfer_code'));
    }


    /**
     * finalizeTransfer
     * last step to finish transfering money
     *
     * @param object $request
     * @return json object
     */
    public function finalizeTransfer(Request $request)
    {

        $url = "https://api.paystack.co/transfer/finalize_transfer";
        $fields = [
            "transfer_code" => $request->transfer_code,
            "otp" => $request->otp
        ];

        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer {$this->secretKey}",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result);


        /* For tesing mode purpose */
        // $result->status = 1;
        // $result->message = "Transfer has been queued";
        // $result->data = new \stdClass;
        // $result->data->reference = "m8ll9pzl6b";
        // $result->data->currency = "NGN";
        // $result->data->status = "success";
        // $result->data->amount = 5044;
        // $result->data->transfer_code = "TRF_zuirlnr9qblgfko";
        // $result->data->reason = "Salary";

        if ( !$result->status ) {
            return $result->message;
        }

        // Insert transfer information into the database
        Model::create([
            'reference' => $result->data->reference,
            'currency' => $result->data->currency,
            'amount' => $result->data->amount,
            'reason' => $result->data->reason,
            'transfer_code' => $result->data->transfer_code,
            'status' => $result->data->status
        ]);

        return view("transfer.success", ["result" => $result]);
    }
}
