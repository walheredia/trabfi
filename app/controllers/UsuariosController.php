<?php

	class UsuariosController extends BaseController {

	public function get_nuevo(){
		$user = Auth::user();

		//$tiposusuario = TipoUsuario::all();
			if ($user->tipo_usuario === 1) {
				$tipousuario = TipoUsuario::where('id_tipousuario' , '=' , '1')
										->orWhere('id_tipousuario' , '=' , '2')
										->get();
					
				return View::make('register')->with('tiposusuario', $tipousuario);
			}
			elseif ($user->tipo_usuario === 2) {
				$tipousuario = TipoUsuario::where('id_tipousuario' , '=' , '3')->get();
				
				return View::make('register')->with('tiposusuario', $tipousuario);
			}
			else {
				return Redirect::to('/')->with('error', $user->username)->withInput();
			}
	}
	
	public function post_nuevo()
	{
		$inputs = Input::all();
		$reglas = array(
			'first_name' => 'required|min:4', 
			'last_name' => 'required',
			'email' => 'email|unique:users,email',
			'username' => 'required|unique:users,username',
			'password' => 'required|min:5|max:20',
			'confirmar_clave' => 'required|same:password',
		);
		$mensajes = array(
			'required' => 'Campo Obligatorio',
		);
		$validar = Validator::make($inputs, $reglas);
		if($validar->fails())
		{	
			Input::flash();
			return Redirect::back()->withInput()->withErrors($validar);
		}
		else
		{
			$clave = Input::get('password');
			$user = new User;
			$user->id_creador =  Auth::user()->id;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			$user->password = Hash::make($clave);
			$user->tipo_usuario = Input::get('tipo_usuario');
			$user->estado = Input::get('estado');
			$user->direccion = Input::get('direccion');
			$user->numero = Input::get('numero');
			$user->localidad = Input::get('localidad');
			$user->provincia = Input::get('provincia');
			$user->fecha_ing = Input::get('fecha_ingreso');
			$user->telefono = Input::get('telefono');
			
	        $user->save();
			return Redirect::to('lista_usuarios')->with('error', 'El usuario ha sido registrado con Éxito')->withInput();
		}
	}
	public function destroy($id)
	{	
	$user = User::find($id);	        
	        if (is_null ($user))
	        {
	            App::abort(404);
	        }
	        $user->delete();
	        $users = User::all();
	        return View::make('lista_usuarios')->with('users', $users);
	}

	public function all_users() {
		$idusuario = Auth::user()->id;
			$users = DB::table('users')
			->join('tipos_usuario' , 'users.tipo_usuario' , '=' , 'tipos_usuario.id_tipousuario')
			->where('users.id_creador' , '=' , $idusuario)
			->get();
		return View::make('lista_usuarios')->with('users', $users);
		
	}
	public function getEditUsuario($id) {
		$usera = Auth::user();
		$user = User::find($id);
		if ($usera->tipo_usuario === 1) {
				$tipousuario = TipoUsuario::where('id_tipousuario' , '=' , '1')
										->orWhere('id_tipousuario' , '=' , '2')
										->get();
					
				return View::make('edit_user')->with('tiposusuario', $tipousuario)
												->with('user',$user);
			}
			elseif ($usera->tipo_usuario === 2) {
				$tipousuario = TipoUsuario::where('id_tipousuario' , '=' , '3')->get();
				
				return View::make('edit_user')->with('tiposusuario', $tipousuario)
												->with('user',$user);
			}
			else {
				return Redirect::to('/')->with('error', $usera->username)->withInput();
			}
		
	}
	public function update() {
		$inputs = Input::all();
		$reglas = array(
			'first_name' => 'required|min:4', 
			'last_name' => 'required',
			'email' => 'email',
			'username' => 'required',
			'password' => 'required|min:5|max:20',
			'confirmar_clave' => 'required|same:password',
		);
		$mensajes = array(
			'required' => 'Campo Obligatorio',
		);
		$validar = Validator::make($inputs, $reglas);
		if($validar->fails())
		{	
			Input::flash();
			return Redirect::back()->withInput()->withErrors($validar);
		}
		else
		{
			$id_user = Input::get('id');
			$user = User::find($id_user);

			$clave = Input::get('password');
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			$user->password = Hash::make($clave);
			$user->tipo_usuario = Input::get('tipo_usuario');
			$user->save();
			return Redirect::to('lista_usuarios')->with('error', 'El usuario ha sido actualizado con Éxito')->withInput();
			//$users = User::all();
			//return View::make('lista_usuarios')->with('users', $users);
		}
	}
	
}