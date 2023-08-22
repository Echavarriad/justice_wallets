<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Shops;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Nette\Schema\Expect;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = new User();
        $wallet = new Register();


        $register = User::where('id',$request->id)->update(['balance' => $request->value]);
        if(isset($register)){
            $mess = "hecho";
        }else{
            $mess = "error";
        }




       /*  $array = ['documento'=> $user->]; */


        return response()->json($mess);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
         $user = new User();
        $user->balace = $request->balace;
        $user->save();
        return view('app');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Reload a newly created resource in storage.
     */
    public function reload(Request $request)
    {
        $selectData = User::query()->select(['balance'])->where('document', "=","$request->document")->get();

        if(isset($selectData)){
            $userBalance = $selectData[0]->balance + $request->value;
            $updateValance = User::where('document',$request->document
            )->update(['balance' => $userBalance]);

            $creatRegister = Register::create(['movimiento' => "recarga",
            'document'=> "$request->document",
            'phone'=> "$request->phone",
            'value' => "$request->value",
            'estado' => 1]);

            return response()->json($selectData[0]->balance);
        }
    }

    public function pay(Request $request)
    {
        $selectData = User::query()->select(['email','name','balance','id'])->where('document', "=","$request->document")->get();
        if(isset($selectData) and $selectData[0]->balance > $request->value){

            $token = $selectData[0]->id.round(microtime(true) * 1);

            $creatRegister = Shops::create(['document' =>  $request->document,
                'estatus'=> 0,
                'token'=> $token ,
                'ref' => 'compra',
                'total' => "$request->value",
            ]);

            if(isset($creatRegister)){
                $array = ['mess' => 'Pago por validar pendiente , se envio un correo con un token de validacion al correo '.$selectData[0]->email];

                $mail = new PHPMailer(true);
                $mail->isSMTP();

                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->SMTPKeepAlive = true;
                $mail->Mailer = 'smtp';

                $email = $selectData[0]->email;
                $mail->Username = "echavarriaduvan1@gmail.com";
                $mail->Password = "uyuahhjikzghtoem";
                $para = $selectData[0]->email;
                $tok = $token;
                $mail->setFrom($email, "Justi wallet shop");
                $mail->addReplyTo($email, "sale");
                $mail->addAddress($para, '');
                $mail->Subject = "compra";
                $mail->IsHTML(true);
                $mail->Body = '<h1>Bienvenid@</h1>

                <br>
                <p style="font-size: 1rem">Gracias por tu compra para finalizar aqui tiene el token de validacion</p>
                <br>
                <h4> Tu token es: </h4>'.$token;
                $mail->AltBody = 'Ingresa rapido';

                if (!$mail->send()) {
                    throw new Exception($mail->ErrorInfo);
                }else{
                    return response()->json($array);
                }

            }
        }else{
            $array = ['mess' => 'No tiene fondos suficientes'];
            return response()->json($array);
        }
    }
    public function valtoken(Request $request){

        $selectShop = Shops::query()->select(['total','estatus'])->where('token',"=","$request->token")->get();

        if(isset($selectShop)){

            $selectData = User::query()->select(['balance'])->where('document',"=","$request->document")->get();

            $balance = $selectData[0]->balance - $selectShop[0]->total;

            $updateData = User::where('document',"=","$request->document")->update(['balance' => $balance]);

            $updateShop = Shops::where('token',"=","$request->token")->update(['estatus' => 1]);

            $array = ["mess" => 'Token validado se ha riarealizado el descuendo del balance de '. $selectShop[0]->total];

            return response()->json($array);
        }else{
            $array = ["mess" => 'Token invalido'];
            return response()->json($array);

        }


    }
    public function saldo(Request $request){

        $selectData = User::query()->select(['balance'])->where('document',"=","$request->document", "and")->where('phone',"=","$request->phone")->get();

        return response()->json($selectData);
    }
    public function historyshop(Request $request){

        $selectData = Shops::all();

        return response()->json($selectData);
    }

    public function historyreload(Request $request){

        $selectData = Register::all();

        return response()->json($selectData);
    }
}
