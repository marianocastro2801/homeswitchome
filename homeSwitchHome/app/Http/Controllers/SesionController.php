<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use App\Usuario;
use App\Solicitante;
use App\Notificacion;

class SesionController extends Controller
{
    // public function iniciar(Request $request){
    //     $usuario = DB::table('usuarios')
    //                 ->where('nombre', $request->input('nombreUsuario'))
    //                 ->first();
    //     if(empty($usuario))
    //         return redirect('/sesion');
    //     else{
    //         session(['idUsuario' => $usuario->id,
    //         	'nombreUsuario' => $usuario->nombre,
    //         	'apellidoUsuario' => $usuario->apellido,
    //         	'email' => $usuario->email,
    //         	'esPremium' => $usuario->es_premium,
    //         	'numeroTarjeta' => $usuario->numero_tarjeta,
    //             'creditos' => $usuario->creditos,
    //         	'fechaNacimiento' => $usuario->fecha_nacimiento]);


    //         return redirect('/');
    //     }
    // }

    public function verificarSolictud(){
        $solicitud = DB::table('solicitantes')
                        ->where('id_usuario', session('idUsuario'))
                        ->first();

        // $SubastasInscriptas = DB::table('inscripcions')
        //                         ->where('id_usuario', session('idUsuario'))
        //                         ->get();

        // $idSubastas = [-1];
        // foreach ($SubastasInscriptas as $SubastaInscriptas) {
        //      $idSubastas[] = $SubastaInscriptas->id_subasta;
        // }

        // $hoy = Carbon::today()->format('Y-m-d');

        // $subastas = DB::table('subastas')
        //             ->whereNull('ganador')
        //             ->whereDate('fecha_inicio_subasta', '<=' , $hoy)
        //             ->whereIn('id', $idSubastas)
        //             ->get();

        // foreach ($subastas as $subasta) {

        //     $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();
        //     $fechaDeInicioPuja = Carbon::parse($subasta->fecha_inicio_subasta);

        //     Notificacion::updateOrCreate(
        //         ['id_subasta' => $subasta->id,
        //         'id_usuario' => session('idUsuario')],
        //         ['mensaje' => 'Comenzó una subasta para '.$hospedaje->titulo.' el día '.$fechaDeInicioPuja->format('d-m-Y') ,
        //         'created_at' => $fechaDeInicioPuja]);
        // }

        $notificaciones = DB::table('notificacions')
                        ->where('id_usuario', session('idUsuario'))
                        ->orderBy('created_at', 'desc')
                        ->get();

        $mensajes = [];

        foreach ($notificaciones as $notificacion) {
            $mensajes[$notificacion->id] = $notificacion->mensaje;
        }

        $usuario = DB::table('usuarios')
                    ->where('id', session('idUsuario'))
                    ->first();

        session(['esPremium' => $usuario->es_premium,
                 'mensajes' => $mensajes]);

        if(!is_null($solicitud)){
            session(['solicitud' => true]);
        }
        else{
            session(['solicitud' => false]);
        }
    }

    public function validarUsuario(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|bail|email|bail|exists:usuarios,email',
            'contrasenia' => 'required'],
            ['email.required' => 'Por favor ingrese su correo',
             'email.email' => 'El formato de correo no es correcto',
             'email.exists' => 'El correo ingresado no existe',
             'contrasenia.required' => 'Por favor ingrese una contraseña'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $usuario = DB::table('usuarios')
                    ->where('email', $request->input('email'))
                    ->first();

        $request['contraseniaValida'] = $usuario->contrasenia;

        $validator = Validator::make($request->all(), [
            'contrasenia' => 'same:contraseniaValida'],
            ['contrasenia.same' => 'La contraseña es incorrecta'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $solicitud = DB::table('solicitantes')
                        ->where('id_usuario', $usuario->id)
                        ->first();

        //Obteniendo notificaciones de subastas en periodo puja

        // $SubastasInscriptas = DB::table('inscripcions')
        //                         ->where('id_usuario', $usuario->id)
        //                         ->get();

        // $idSubastas = [-1];
        // foreach ($SubastasInscriptas as $SubastaInscriptas) {
        //      $idSubastas[] = $SubastaInscriptas->id_subasta;
        // }

        // $hoy = Carbon::today()->format('Y-m-d');

        // $subastas = DB::table('subastas')
        //             ->whereNull('ganador')
        //             ->whereDate('fecha_inicio_subasta', '<=' , $hoy)
        //             ->whereIn('id', $idSubastas)
        //             ->get();

        // foreach ($subastas as $subasta) {

        //     $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();
        //     $fechaDeInicioPuja = Carbon::parse($subasta->fecha_inicio_subasta);

        //     Notificacion::updateOrCreate(
        //         ['id_subasta' => $subasta->id,
        //         'id_usuario' => $usuario->id],
        //         ['mensaje' => 'Comenzó una subasta para '.$hospedaje->titulo.' el día '.$fechaDeInicioPuja->format('d-m-Y') ,
        //         'created_at' => $fechaDeInicioPuja]);
        // }

        $notificaciones = DB::table('notificacions')
                        ->where('id_usuario', $usuario->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $mensajes = [];

        foreach ($notificaciones as $notificacion) {
            $mensajes[$notificacion->id] = $notificacion->mensaje;
        }

        $mesVencimiento = $usuario->mes_vencimiento;

        if(strlen($usuario->mes_vencimiento) < 2){
            $mesVencimiento = '0'.$mesVencimiento;
        }

        session(['idUsuario' => $usuario->id,
                'nombreUsuario' => $usuario->nombre,
                'apellidoUsuario' => $usuario->apellido,
                'email' => $usuario->email,
                'esPremium' => $usuario->es_premium,
                'contrasenia' => $usuario->contrasenia,
                'numeroTarjeta' => $usuario->numero_tarjeta,
                'mesVencimiento' =>$mesVencimiento,
                'anioVencimiento' =>$usuario->anio_vencimiento,
                'codigoSeguridad' =>$usuario->codigo_seguridad,
                'creditos' => $usuario->creditos,
                'fechaNacimiento' => $usuario->fecha_nacimiento,
                'solicitud' => false,
                'mensajes' => $mensajes]);

        if(!is_null($solicitud)){
            session(['solicitud' => true]);
        }

        return redirect('/');
    }


    public function obtenerListas(){

        $hoy = Carbon::today()->format('Y-m-d');

        $subastasEnInscripcion = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                            ->whereDate('fecha_inicio_subasta', '>=' , $hoy)
                            ->orderBy('fecha_inicio', 'asc')
                            ->get();

        $subastasEnPeriodo = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_subasta', '<=' , $hoy)
                            ->whereDate('fecha_fin_subasta', '>' , $hoy)
                            ->orderBy('fecha_inicio', 'asc')
                            ->get();


        $data['subastas'] = array_merge($subastasEnPeriodo->all(), $subastasEnInscripcion->all());


        return $data;
    }

    public function listarInicio($resultadosDeBusqueda = [-1]){

        // $subasta1= DB::table('subastas')->where('id', 1)->first();
        // $hospedaje1 = DB::table('hospedajes')->where('id', $subasta1->id_hospedaje)->first();
        // $subasta2 = DB::table('subastas')->where('id', 2)->first();
        // $hospedaje2 = DB::table('hospedajes')->where('id', $subasta2->id_hospedaje)->first();


        // $data['tituloHospedaje1'] = $hospedaje1->titulo;
        // $data['nombreImagen1'] = $hospedaje1->imagen;
        // $data['idSubasta1'] = $subasta1->id;
        // $data['montoBase1'] = $subasta1->monto_base;
        // $data['fechaInicio1'] = $subasta1->fecha_inicio;

        // $data['tituloHospedaje2'] = $hospedaje2->titulo;
        // $data['nombreImagen2'] = $hospedaje2->imagen;
        // $data['idSubasta2'] = $subasta2->id;
        // $data['montoBase2'] = $subasta2->monto_base;
        // $data['fechaInicio2'] = $subasta2->fecha_inicio;

        // return view('welcome', $data);

        $data = $this->obtenerListas();
        $localidades = DB::table('localidads')->get();
        $data['localidades'] = $localidades;
        $data['resultadosDeBusqueda'] = $resultadosDeBusqueda;

        if($resultadosDeBusqueda == [-1]){
            $data['seRealizaBusqueda'] = false;
        }
        else{
            $data['seRealizaBusqueda'] = true;
        }

        $this->verificarSolictud();
        return view('welcome', $data);
    }

    public function validarRegistro(Request $request){

        $fechaNacimiento = Carbon::parse($request->input('fechaNacimiento'));
        $request['edad'] = Carbon::now()->diffInYears($fechaNacimiento);

        if($fechaNacimiento > Carbon::now()){
            $request['fechaValida'] = false;
        }
        else{
            $request['fechaValida'] = true;
        }

        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required',
            'apellidoUsuario' => 'required',
            'email' => 'required|bail|email|bail|unique:usuarios,email',
            'fechaNacimiento' => 'required',
            'fechaValida' => 'accepted',
            'contrasenia' => 'required',
            'contrasenia_confirmation' => 'required',
            'numeroTarjeta' => 'required|bail|not_in:1234567890123456|bail|digits:16',
            'mesVencimiento' => 'required|bail|digits:2',
            'anioVencimiento' => 'required|bail|digits:2',
            'codigoSeguridad' => 'required|bail|digits:3'
        ],
            ['nombreUsuario.required' => 'Por favor ingrese un nombre',
            'apellidoUsuario.required' => 'Por favor ingrese un apellido',
            'email.required' => 'Por favor ingrese una dirreción de correo',
            'email.email' => 'El formato del correo es incorrecto',
            'email.unique' => 'El correo ya se encuentra registrado, por favor ingrese otro correo',
            'fechaValida.accepted' => 'La fecha debe ser menor a la actual',
            'fechaNacimiento.required' => 'Por favor ingrese una fecha nacimiento',
            'numeroTarjeta.required' => 'Por favor ingrese un numero de tarjeta',
            'numeroTarjeta.not_in' => 'La tarjeta no es válida',
            'numeroTarjeta.digits' => 'El numero de tarjeta debe ser nuemrica y contener 16 digitos ',
            'contrasenia.required' => 'Por favor ingrese una contraseña',
            'contrasenia_confirmation.required' => 'Por favor ingrese la confirmación de su contraseña',
            'mesVencimiento.required' => 'Por favor ingrese el mes de vencimiento',
            'mesVencimiento.digits' => 'Ingrese el mes en el formato indicado',
            'anioVencimiento.required' => 'Por favor ingrese el año de vencimiento',
            'anioVencimiento.digits' => 'Ingrese el año en el formato indicado',
            'codigoSeguridad.required' => 'Por favor ingrese el código de seguridad',
            'codigoSeguridad.digits' => 'El codigo de seguridad debe tener 3 digitos'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $anioVencimiento = 2000 + $request->input('anioVencimiento');
        $fechaVencimiento = Carbon::createFromDate($anioVencimiento, $request->input('mesVencimiento'), 1)->startOfMonth();
        $hoy = Carbon::today()->startOfMonth();

        $request['noVencida'] = $fechaVencimiento->greaterThan($hoy);

        $validator = Validator::make($request->all(), [
            'edad' => 'gte:18',
            'contrasenia' => 'confirmed',
            'noVencida' => 'accepted'
        ],
            ['contrasenia.confirmed' => 'Las contraseñas son diferentes',
            'edad.gte' => 'Debe ser mayor de 18 años para usar el sistema',
            'noVencida.accepted' => 'La tarjeta se encuntra vencidad'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $usuario = new Usuario;
            $usuario->nombre = $request->input('nombreUsuario');
            $usuario->apellido = $request->input('apellidoUsuario');
            $usuario->email = $request->input('email');
            $usuario->contrasenia = $request->input('contrasenia');
            $usuario->numero_tarjeta = $request->input('numeroTarjeta');
            $usuario->fecha_nacimiento = $request->input('fechaNacimiento');
            $usuario->mes_vencimiento = $request->input('mesVencimiento');
            $usuario->anio_vencimiento = $request->input('anioVencimiento');
            $usuario->codigo_seguridad = $request->input('codigoSeguridad');

        $usuario->save();

        $usuario = DB::table('usuarios')
                    ->where('email', $request->input('email'))
                    ->first();

        $idUsuario = $usuario->id;

        $notificacion = new Notificacion;
        $notificacion->id_usuario = $idUsuario;
        $notificacion->mensaje = 'Se ha cobrado el monto de registro de su tarjeta. Se comenzará a cobrar el monto mensual a partir del próximo més' ;

        $notificacion->save();

        return redirect('/login')->with('exito', 'El usuario se creo exitosamente');
    }

    public function modificarCuenta(){

        $this->verificarSolictud();
        return view('modificarUsuario');

    }

    public function perfilUsuario(){

        $SubastasDondeParticipa = DB::table('participas')
                    ->where('id_usuario', session('idUsuario'))
                    ->get();

        $idSubastas = [-1];
        foreach ($SubastasDondeParticipa as $SubastaDondeParticipa) {
             $idSubastas[] = $SubastaDondeParticipa->id_subasta;
        }

        $data['subastas'] = DB::table('subastas')
                                ->whereNull('ganador')
                                ->whereIn('id', $idSubastas)
                                ->get();

        $data['misReservas'] = DB::table('reservas')
                                ->join('subastas', 'subastas.id', '=', 'reservas.id_subasta')
                                ->where('reservas.id_usuario', session('idUsuario'))
                                ->get();

        $data['misInscripciones'] = DB::table('inscripcions')
                                ->join('subastas', 'subastas.id', '=', 'inscripcions.id_subasta')
                                ->where('inscripcions.id_usuario', session('idUsuario'))
                                ->get();

        $this->verificarSolictud();

        return view('miPerfil', $data);

    }

    public function validarDatos(Request $request){

        $fechaNacimiento = Carbon::parse($request->input('fechaNacimiento'));
        $request['edad'] = Carbon::now()->diffInYears($fechaNacimiento);

        if($fechaNacimiento > Carbon::now()){
            $request['fechaValida'] = false;
        }
        else{
            $request['fechaValida'] = true;
        }

        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required',
            'apellidoUsuario' => 'required',
            'email' => 'required|bail|email|bail|unique:usuarios,email,'.session('idUsuario'),
            'fechaNacimiento' => 'required',
            'fechaValida' => 'accepted',
            'numeroTarjeta' => 'required|bail|not_in:1234567890123456|bail|digits:16',
            'mesVencimiento' => 'required|bail|digits:2',
            'anioVencimiento' => 'required|bail|digits:2',
            'codigoSeguridad' => 'required|bail|digits:3'
        ],
            ['nombreUsuario.required' => 'Por favor ingrese un nombre',
            'apellidoUsuario.required' => 'Por favor ingrese un apellido',
            'email.required' => 'Por favor ingrese una dirreción de correo',
            'email.email' => 'El formato del correo es incorrecto',
            'email.unique' => 'El correo ya se encuentra registrado, por favor ingrese otro correo',
            'fechaNacimiento.required' => 'Por favor ingrese una fecha nacimiento',
            'fechaValida.accepted' => 'La fecha debe ser menor a la actual',
            'numeroTarjeta.required' => 'Por favor ingrese un numero de tarjeta',
            'numeroTarjeta.not_in' => 'La tarjeta no es válida',
            'numeroTarjeta.digits' => 'El numero de tarjeta debe ser nuemrica y contener 16 digitos ',
            'mesVencimiento.required' => 'Por favor ingrese el mes de vencimiento',
            'mesVencimiento.digits' => 'Ingrese el mes en el formato indicado',
            'anioVencimiento.required' => 'Por favor ingrese el año de vencimiento',
            'anioVencimiento.digits' => 'Ingrese el año en el formato indicado',
            'codigoSeguridad.required' => 'Por favor ingrese el código de seguridad',
            'codigoSeguridad.digits' => 'El codigo de seguridad debe tener 3 digitos'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $anioVencimiento = 2000 + $request->input('anioVencimiento');
        $fechaVencimiento = Carbon::createFromDate($anioVencimiento, $request->input('mesVencimiento'), 1)->startOfMonth();
        $hoy = Carbon::today()->startOfMonth();

        $request['noVencida'] = $fechaVencimiento->greaterThan($hoy);

        $validator = Validator::make($request->all(), [
            'edad' => 'gte:18',
            'noVencida' => 'accepted'
        ],
            ['edad.gte' => 'Debe ser mayor de 18 años para usar el sistema',
            'noVencida.accepted' => 'La tarjeta se encuntra vencidad'
               ]);

        if ($validator->fails()) {

              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        DB::table('usuarios')
            ->where('id', session('idUsuario'))
            ->update(['email' => $request->input('email'),
                      'nombre' => $request->input('nombreUsuario'),
                      'apellido' => $request->input('apellidoUsuario'),
                      'fecha_nacimiento' => $request->input('fechaNacimiento'),
                      'numero_tarjeta' => $request->input('numeroTarjeta'),
                      'mes_vencimiento' => $request->input('mesVencimiento'),
                      'anio_vencimiento' => $request->input('anioVencimiento'),
                      'codigo_seguridad' => $request->input('codigoSeguridad')]);

        session(['nombreUsuario' => $request->input('nombreUsuario'),
                'apellidoUsuario' => $request->input('apellidoUsuario'),
                'numeroTarjeta' => $request->input('numeroTarjeta'),
                'fechaNacimiento' => $request->input('fechaNacimiento'),
                'email' => $request->input('email'),
                'mesVencimiento' => $request->input('mesVencimiento'),
                'anioVencimiento' => $request->input('anioVencimiento'),
                'codigoSeguridad' => $request->input('codigoSeguridad')]);

        return redirect('/perfil')->with('exito', 'El usuario se modificó exitosamente');

    }

    public function validarContrasenia(Request $request){

        $request->validate([
            'contraseniaVieja' => 'required',
            'contraseniaNueva' => 'required',
            'contraseniaNueva_confirmation' => 'required'],
            ['contraseniaVieja.required' => 'Por favor ingrese su anterior contraseña',
            'contraseniaNueva.required' => 'Por favor ingrese una nueva contraseña',
            'contraseniaNueva_confirmation.required' => 'Por favor ingrese la confirmación de su nueva contraseña'
              ]);

        $request['contraseniaValida'] = session('contrasenia');

        $request->validate([
            'contraseniaVieja' => 'same:contraseniaValida'],
            ['contraseniaVieja.same' => 'La contraseña anterior es incorrecta'
               ]);

        $request->validate([
            'contraseniaNueva' => 'confirmed',],
            ['contraseniaNueva.confirmed' => 'Las contraseñas son diferentes'
              ]);

        DB::table('usuarios')
            ->where('id', session('idUsuario'))
            ->update(['contrasenia' => $request->input('contraseniaNueva')]);

        session(['contrasenia' => $request->input('contraseniaNueva')]);

        return redirect('/perfil')->with('exito', 'La contraseña se modificó exitosamente');
    }

    public function buscar(Request $request){

        if((is_null($request->input('fechaInicioAlojamiento'))) && (is_null($request->input('fechaFinAlojamiento'))) && (is_null($request->input('tipoBusqueda'))) && (is_null($request->input('localidad')))){
                $request['hayBusqueda'] = false;
                $request->validate([
                    'hayBusqueda' => 'accepted'
                ],
                ['hayBusqueda.accepted' => 'No ingreso ningun dato de busqueda']);
            }

        if((!is_null($request->input('fechaInicioAlojamiento'))) || (!is_null($request->input('fechaFinAlojamiento')))){
            $request->validate([
                'fechaInicioAlojamiento' => 'required',
                'fechaFinAlojamiento' => 'required'],
                ['fechaInicioAlojamiento.required' => 'Debe ingresar una fecha de inicio',
                'fechaFinAlojamiento.required' => 'Debe ingresar una fecha de fin'
                  ]);
        }
        if((!is_null($request->input('fechaInicioAlojamiento'))) && (!is_null($request->input('fechaFinAlojamiento')))){
            $request->validate([
                'fechaInicioAlojamiento' => 'before:fechaFinAlojamiento'],
                ['fechaInicioAlojamiento.before' => 'La fecha de inicio debe ser menor a la de fin'
                  ]);
        }

        // if(!is_null($request->input('fechaInicioAlojamiento'))){

        //     $fechaInicioAlojamiento = Carbon::create($request->input('fechaInicioAlojamiento'));
        //     $fechaFinAlojamiento = Carbon::create($request->input('fechaFinAlojamiento'));
        //     $fechaFinAlojamiento = $fechaFinAlojamiento->startOfWeek()->subDay()->format('Y-m-d');

        //     if($fechaInicioAlojamiento->dayOfWeek != Carbon::MONDAY) {
        //         $fechaInicioAlojamiento = $fechaInicioAlojamiento->endOfWeek()->addDay()->format('Y-m-d');
        //     }
        //     else{
        //         $fechaInicioAlojamiento = $fechaInicioAlojamiento->format('Y-m-d');
        //     }
        // }
        // else{
        //     $fechaInicioAlojamiento = null;
        //     $fechaFinAlojamiento = null;
        // }
        if(!is_null($request->input('fechaInicioAlojamiento'))){
            $fechaInicioAlojamiento = Carbon::create($request->input('fechaInicioAlojamiento'))->format('Y-m-d');
            $fechaFinAlojamiento = Carbon::create($request->input('fechaFinAlojamiento'))->format('Y-m-d');
        }
        else{
            $fechaInicioAlojamiento = null;
            $fechaFinAlojamiento = null;
        }

        $localidad = $request->input('localidad');

        $hospedajes = DB::table('hospedajes')
                    ->where('id_localidad', $localidad)
                    ->get();

        if(is_null($request->input('localidad'))){
            $idHospedajes = null;

        }
        else{
            $idHospedajes = [-1];
        }

        foreach ($hospedajes as $hospedaje) {
                 $idHospedajes[] = $hospedaje->id;
        }

        $hoy = Carbon::today()->format('Y-m-d');

        if($request->input('tipoBusqueda') == 'Subasta'){

            $subastas = DB::table('subastas')
                    ->whereNull('ganador')
                    ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                    ->whereDate('fecha_fin_subasta', '>' , $hoy)
                    ->when($idHospedajes, function ($query, $idHospedajes){
                            return $query
                                    ->whereIn('id_hospedaje', $idHospedajes);
                    })
                    ->when($fechaInicioAlojamiento, function ($query) use ($fechaInicioAlojamiento,$fechaFinAlojamiento){
                            return $query
                                    ->whereDate('fecha_inicio', '>=', $fechaInicioAlojamiento)
                                    ->whereDate('fecha_fin', '<=', $fechaFinAlojamiento);
                    })
                    ->get();
        }
        elseif($request->input('tipoBusqueda') == 'Hotsale') {
            $subastas = [];
        }
        else{

            $subastas = DB::table('subastas')
                    ->whereNull('ganador')
                    ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                    ->whereDate('fecha_fin_subasta', '>' , $hoy)
                    ->when($idHospedajes, function ($query, $idHospedajes){
                            return $query
                                    ->whereIn('id_hospedaje', $idHospedajes);
                    })
                    ->when($fechaInicioAlojamiento, function ($query) use ($fechaInicioAlojamiento,$fechaFinAlojamiento){
                            return $query
                                    ->whereDate('fecha_inicio', '>=', $fechaInicioAlojamiento)
                                    ->whereDate('fecha_fin', '<=', $fechaFinAlojamiento);
                    })
                    ->get();
        }

        return $this->listarInicio($subastas);
    }

    public function informacion(){

        $solicitud = new Solicitante;
        $solicitud->id_usuario = session('idUsuario');

        $solicitud->save();

        session(['solicitud' => true]);

        return redirect()->back();
    }

    public function listarPerfilAdministrador(){

        $solicitantes = DB::table('solicitantes')
                    ->get();

        $idUsuarios = [];

        foreach ($solicitantes as $solicitante) {
             $idUsuarios[] = $solicitante->id_usuario;
        }

        $usuarios = DB::table('usuarios')
                    ->where('id', '!=', 1)
                    ->orderBy('apellido')
                    ->orderBy('nombre')
                    ->get();

        $solicitantes = DB::table('usuarios')
                    ->whereIn('id', $idUsuarios)
                    ->orderBy('apellido')
                    ->orderBy('nombre')
                    ->get();

        $data['usuarios'] = $usuarios;
        $data['solicitantes'] = $solicitantes;

        //Estos son los hotsale candidatos en la view 'listarCandidatosAHotsale' tenes una guia de como usar los datos que te doy

        $candidatosAHotsale = DB::table('hotsales')
                    ->where('candidato', true)
                    ->get();

        $idSubastas = [-1];

        foreach ($candidatosAHotsale as $candidatoAHotsale){
             $idSubastas[] = $candidatoAHotsale->id_subasta;
        }

        $data['candidatosAHotsales'] = DB::table('subastas')
                    ->whereIn('id', $idSubastas)
                    ->get();


        return view('perfilAdministrador', $data);
    }

    public function pasarABasico($idUsuario){

        DB::table('usuarios')
            ->where('id', $idUsuario)
            ->update(['es_premium' => 0]);

        $hoy = Carbon::today()->format('d-m-Y');

        $notificacion = new Notificacion;
        $notificacion->id_usuario = $idUsuario;
        $notificacion->mensaje = "Fue pasado a usuario basico el dia ".$hoy.". Se descontará el monto adicional para el próximo mes.";

        $notificacion->save();

        return redirect('/perfilAdministrador');

    }

    public function pasarAPremium($idUsuario){

        DB::table('usuarios')
            ->where('id', $idUsuario)
            ->update(['es_premium' => 1]);

        $hoy = Carbon::today()->format('d-m-Y');

        $notificacion = new Notificacion;
        $notificacion->id_usuario = $idUsuario;
        $notificacion->mensaje = "Fue pasado a usuario premium el dia ".$hoy.". Se cobrará el costo de pasar a premium y adicional por mes a partir del próximo mes.";

        $notificacion->save();

        return redirect('/perfilAdministrador');

    }

    public function aceptarSolicitante($idUsuario){

        DB::table('usuarios')
            ->where('id', $idUsuario)
            ->update(['es_premium' => 1]);

        DB::table('solicitantes')
            ->where('id_usuario', $idUsuario)
            ->delete();

        $hoy = Carbon::today()->format('d-m-Y');

        $notificacion = new Notificacion;
        $notificacion->id_usuario = $idUsuario;
        $notificacion->mensaje = "Su solicitud de usuario premium fue aceptada el dia ".$hoy.". Se cobrará el costo de pasar a premium y adicional por mes a partir del próximo mes.";

        $notificacion->save();

        return redirect('/perfilAdministrador');
    }

    public function rechazarSolicitante($idUsuario){

        DB::table('solicitantes')
            ->where('id_usuario', $idUsuario)
            ->delete();

        $hoy = Carbon::today()->format('d-m-Y');

        $notificacion = new Notificacion;
        $notificacion->id_usuario = $idUsuario;
        $notificacion->mensaje = "Su solicitud de usuario premium fue rechazada el dia ".$hoy;

        $notificacion->save();

        return redirect('/perfilAdministrador');

    }

    public function listarLogin(){
        $data = $this->obtenerListas();
        return view('login', $data);
    }

    public function notificarUsuarios(Request $request){
        $inscripciones = DB::table('inscripcions')
                    ->where('id_subasta', $request->input('idSubasta'))
                    ->get();

        foreach ($inscripciones as $inscripcion) {

            $subasta = DB::table('subastas')->where('id', $inscripcion->id_subasta)->first();
            $hospedaje = DB::table('hospedajes')->where('id', $subasta->id_hospedaje)->first();

            $notificacion = new Notificacion;
            $notificacion->id_subasta = $inscripcion->id_subasta;
            $notificacion->id_usuario = $inscripcion->id_usuario;
            $notificacion->mensaje = 'Comenzó una subasta para '.$hospedaje->titulo.' el día '.Carbon::parse($subasta->fecha_inicio_subasta)->format('d-m-Y');

            $notificacion->save();
        }

        DB::table('subastas')
            ->where('id', $request->input('idSubasta'))
            ->update(['notificada' => true]);

        return redirect('/listarsubastas')->with('exito', 'Los usuarios fueron notificados exitosamente');

    }
}
