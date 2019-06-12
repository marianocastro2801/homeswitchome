<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use App\Usuario;

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

    public function validarUsuario(Request $request){
        
        $request->validate([
            'email' => 'required|bail|email|bail|exists:usuarios,email',
            'contrasenia' => 'required'],
            ['email.required' => 'Por favor ingrese su correo', 
             'email.email' => 'El formato de correo no es correcto',
             'email.exists' => 'El correo ingresado no existe',
             'contrasenia.required' => 'Por favor ingrese una contraseña'
               ]);

        $usuario = DB::table('usuarios')
                    ->where('email', $request->input('email'))
                    ->first();         

        $request->validate([
            'contrasnia' => Rule::in([$usuario->contrasenia])],
            ['contrasenia.in' => 'La contraseña es incorrecta'
               ]);

        session(['idUsuario' => $usuario->id, 
                'nombreUsuario' => $usuario->nombre, 
                'apellidoUsuario' => $usuario->apellido, 
                'email' => $usuario->email, 
                'esPremium' => $usuario->es_premium, 
                'numeroTarjeta' => $usuario->numero_tarjeta, 
                'creditos' => $usuario->creditos,
                'contrasnia' => $usuario->contrasenia,
                'fechaNacimiento' => $usuario->fecha_nacimiento]);

        return redirect('/');           
    }


    public function obtenerListas(){

        $hoy = Carbon::today()->format('Y-m-d');
        $fechaInscripcion = Carbon::today()->format('Y-m-d');

        $data['subastas'] = DB::table('subastas')
                            ->whereNull('ganador')
                            ->whereDate('fecha_inicio_inscripcion', '<=' , $hoy)
                            ->orderBy('created_at', 'desc')
                            ->get();
        

        return $data;
    }

    public function listarInicio(){

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

        return view('welcome', $data);


    } 

    public function validarRegistro(Request $request){

        $fechaNacimiento = Carbon::parse($request->input('fechaNacimiento'));
        $request['edad'] = Carbon::now()->diffInYears($fechaNacimiento);

        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required',
            'apellidoUsuario' => 'required',
            'email' => 'required|bail|email|bail|unique:usuarios,email',
            'fechaNacimiento' => 'required',
            'contrasenia' => 'required',
            'contrasenia_confirmation' => 'required',
            'numeroTarjeta' => 'required|bail|numeric',
        ],
            ['nombreUsuario.required' => 'Por favor ingrese un nombre',
            'apellidoUsuario.required' => 'Por favor ingrese un apellido',
            'email.required' => 'Por favor ingrese una dirreción de correo',
            'email.email' => 'El formato del correo es incorrecto',
            'email.unique' => 'El correo ya se encuentra registrado, por favor ingrese otro correo',
            'fechaNacimiento.required' => 'Por favor ingrese una fecha nacimiento',
            'numeroTarjeta.required' => 'Por favor ingrese un numero de tarjeta',
            'numeroTarjeta.numeric' => 'El numero de tarjeta debe contener solo numeros',
            'contrasenia.required' => 'Por favor ingrese una contraseña',
            'contrasenia_confirmation.required' => 'Por favor ingrese la confirmación de su contraseña'
               ]);

        if ($validator->fails()) {
              
              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $validator = Validator::make($request->all(), [
            'edad' => 'gte:18',
            'contrasenia' => 'confirmed'
        ],
            ['contrasenia.confirmed' => 'Las contraseñas son diferentes',
            'edad.gte' => 'Debe ser mayor de 18 años para usar el sistema'
               ]);

        if ($validator->fails()) {
              
              return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $usuario = new Usuario;
            $usuario->nombre = $request->input('nombreUsuario');
            $usuario->apellido = $request->input('apellidoUsuario');
            $usuario->email = $request->input('email');
            $usuario->contrasenia = $request('contrasnia');
            $usuario->numero_tarjeta = $request->input('numeroTarjeta');
            $usuario->fecha_nacimiento = $request->input('fechaNacimiento');

        $usuario->save();    

        return redirect('/login')->with('exito', 'El usuario se creo exitosamente');
    }

    public function modificarCuenta(){

        return view('modificarUsuario');

    }


    public function validarDatos(Request $request){

        $fechaNacimiento = Carbon::parse($request->input('fechaNacimiento'));
        $request['edad'] = Carbon::now()->diffInYears($fechaNacimiento);

        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required',
            'apellidoUsuario' => 'required',
            'fechaNacimiento' => 'required',
            'numeroTarjeta' => 'required|bail|numeric'
        ],
            ['nombreUsuario.required' => 'Por favor ingrese un nombre',
            'apellidoUsuario.required' => 'Por favor ingrese un apellido',
            'fechaNacimiento.required' => 'Por favor ingrese una fecha nacimiento',
            'numeroTarjeta.required' => 'Por favor ingrese un numero de tarjeta',
            'numeroTarjeta.numeric' => 'El numero de tarjeta debe contener solo numeros',
             ]);

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        // if(!is_null($request->input('contraseniaVieja'))){
        //     $request->validate([
        //     'contraseniaNueva' => 'required',
        //     'contraseniaNueva_confirmation' => 'required'],
        //     ['contraseniaNueva.required' => 'Por favor ingrese una nueva contraseña',
        //     'contraseniaNueva_confirmation.required' => 'Por favor ingrese la confirmación de su nueva contraseña'
        //       ]);
        //     $request->validate([
        //     'contraseniaNueva' => 'confirmed',],
        //     ['contraseniaNueva.confirmed' => 'Las contraseñas son diferentes'
        //       ]);


        // }

        $validator = Validator::make($request->all(), [
            'edad' => 'gte:18'
        ],
            ['edad.gte' => 'Debe ser mayor de 18 años para usar el sistema'
               ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        DB::table('usuarios')
            ->where('id', session('idUsuario'))
            ->update(['nombre' => $request->input('nombreUsuario'),
                      'apellido' => $request->input('apellidoUsuario'),
                      'fecha_nacimiento' => $request->input('fechaNacimiento'),
                      'numero_tarjeta' => $request->input('numeroTarjeta')]);

        session(['nombreUsuario' => $request->input('nombreUsuario'), 
                'apellidoUsuario' => $request->input('apellidoUsuario'),
                'numeroTarjeta' => $request->input('numeroTarjeta'),
                'fechaNacimiento' => $request->input('fechaNacimiento')]);

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
            
        $request->validate([
            'contraseniaNueva' => 'confirmed',],
            ['contraseniaNueva.confirmed' => 'Las contraseñas son diferentes'
              ]);

        return redirect('/perfil')->with('exito', 'La contraseña se modificó exitosamente');
    }

    public function buscar(Request $request){

        $fechaInicioAlojamiento = Carbon::create($request->input('fechaInicioAlojamiento'));
        $fechaInicioAlojamiento = $fechaInicioAlojamiento->startOfWeek()->format('Y-m-d');
        $localidad = $request->input('localidad');

        $hospedajes = DB::table('hospedajes')
                    ->where('id_localidad', $localidad)
                    ->get();

        $idHospedajes = [-1];            
        foreach ($hospedajes as $hospedaje) {
             $idHospedajes[] = $hospedaje->id;   
        }

        if($request->input('tipoBusqueda') == 'Subasta'){
            $subastas = DB::table('subastas')
                    ->when($idHospedajes, function ($query, $idHospedajes) {
                        return $query->whereIn('id_hospedaje', $idHospedajes);
                    });

            $subastas =  DB::table('subastas')       
                    ->when($fechaInicioAlojamiento, function ($query, $fechaInicioAlojamiento) {
                        return $query->whereDate('fecha_inicio', $fechaInicioAlojamiento);
                    })
                    ->union($subastas)
                    ->get();
    
            $data['subastas'] = $subastas;                     
        }
        elseif($request->input('tipoBusqueda') == 'Hotsale') {
            
        }
        else{
            $subastas = DB::table('subastas')
                    ->when($idHospedajes, function ($query, $idHospedajes) {
                        return $query->whereIn('id_hospedaje', $idHospedajes);
                    });

            $subastas =  DB::table('subastas')       
                    ->when($fechaInicioAlojamiento, function ($query, $fechaInicioAlojamiento) {
                        return $query->whereDate('fecha_inicio', $fechaInicioAlojamiento);
                    })
                    ->union($subastas)
                    ->get();
        }

        $data['subastas'] = $subastas;

        return view('resultados', $data);
    }
}
