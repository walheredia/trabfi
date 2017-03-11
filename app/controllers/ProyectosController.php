<?php
	class ProyectosController extends BaseController {
		public function get_nuevo(){
			$clientes = DB::table('users')
			->where('users.id_creador' , '=' , Auth::user()->id)
			->where('users.tipo_usuario' , '=' , 3)
			->get();
			$mpagos = Mpago::all();

			return View::make('register_proyecto')->with('clientes', $clientes)
											->with('mpagos', $mpagos);
		}
		public function post_nuevo(){
			$inputs = Input::all();
			$reglas = array(
				'nombre' => 'required|min:4', 
				'fecha_inicio' => 'required',
				'fecha_fin' => 'required',
				'cliente' => 'required',
				'mpago' => 'required',
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
				$proyecto = new Proyecto;
				$proyecto->nombre = Input::get('nombre');
				$proyecto->fecha_inicio = Input::get('fecha_inicio');
				$proyecto->fecha_fin = Input::get('fecha_fin');
				$proyecto->id_cliente = Input::get('cliente');
				$proyecto->id_mpago = Input::get('mpago');
				$proyecto->id_usuario = Auth::user()->id;
		        $proyecto->save();		
		        $id = $proyecto->id_proyecto;
				return $this->get_continuarEtapa($id);
			}
		}

		public function get_continuarEtapa($id) {
			$etapas = DB::table('proyectoetapas')
			->where('proyectoetapas.id_proyecto' , '=' , $id)
			->get();

			return View::make('continuar_etapa')->with('id', $id)
													->with('etapas', $etapas);
		}

		public function post_continuarEtapa() {
			$inputs = Input::all();
			$reglas = array(
				'nombre' => 'required|min:4', 
				'fecha_inicio' => 'required',
				'fecha_fin' => 'required',
			);
			$mensajes = array(
				'required' => 'Campo Obligatorio',
			);
			$validar = Validator::make($inputs, $reglas);
			if($validar->fails())
			{	
				Input::flash();
				$etapas = DB::table('proyectoetapas')
				->where('proyectoetapas.id_proyecto' , '=' , Input::get('id_proyecto'))
				->get();
				$id = Input::get('id_proyecto');
				return View::make('continuar_etapa')->with('id', $id)->withErrors($validar)->with('etapas', $etapas);
			}
			else
			{
				$etapa = new ProyectoEtapa;
				$etapa->id_proyecto = Input::get('id_proyecto');
				$etapa->nombre = Input::get('nombre');
				$etapa->fecha_ini = Input::get('fecha_inicio');
				$etapa->fecha_fin = Input::get('fecha_fin');
				$etapa->save();
				$id = Input::get('id_proyecto');
				return $this->get_continuarEtapa($id);
			}
		}

		public function get_continuarRecurso($id) {
			$idproyecto = $id;
			$idusuario = Auth::user()->id;
			
			$recursos = Recurso::where('id_proveedor' , '=' , $idusuario)->get();
			$recasignados = DB::table('proyectorecursos')
			->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
			->where('proyectorecursos.id_proyecto' , '=' , $idproyecto)
			->get();
			//$recursos = Recurso::where('id_proveedor', '=', $idusuario)->get();
			/*$id_proyecto = $id;
			$recursos = DB::table('recursos')
			->join('proyectorecursos', 'proyectorecursos.id_recurso' , '=' , 'recursos.id_recurso', 'left outer')
			->where('proyectorecursos.id_recurso' , NULL)
			->where('recursos.id_proveedor', '=', $idusuario)
	        ->get();*/

			return View::make('continuar_recurso')->with('recursos', $recursos)
													->with('id', $id)
													->with('recasignados', $recasignados);
		}

		public function post_continuarRecurso() {
			$inputs = Input::all();
			$reglas = array(
				'recurso' => 'required', 
			);
			$mensajes = array(
				'required' => 'Campo Obligatorio',
			);
			$validar = Validator::make($inputs, $reglas);
			if($validar->fails())
			{	
				Input::flash();
				$idusuario = Auth::user()->id;			
				$recursos = Recurso::where('id_proveedor' , '=' , $idusuario)->get();
				$id = Input::get('id_proyecto');
				return View::make('continuar_recurso')->with('id', $id)->withErrors($validar)->with('recursos', $recursos);
			}
			else
			{
				$precurso = new ProyectoRecurso;
				$precurso->id_proyecto = Input::get('id_proyecto');
				$precurso->id_recurso = Input::get('recurso');
				$precurso->save();
				$id = Input::get('id_proyecto');
				return $this->get_continuarRecurso($id);
			}
		}

		public function get_confirmarproyecto($id) {
			$proyecto = DB::table('proyectos')
			->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
			->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
			->where('proyectos.id_proyecto' , '=' , $id)
			->get();
			
			$etapas = DB::table('proyectoetapas')
			->where('proyectoetapas.id_proyecto' , '=' , $id)
			->get();
			$cantetapas = count($etapas);

			$recasignados = DB::table('proyectorecursos')
			->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
			->where('proyectorecursos.id_proyecto' , '=' , $id)
			->get();
			$cantrecasignados = count($recasignados);
			
			return View::make('confirma_proyecto')->with('proyecto', $proyecto)
													->with('etapas', $etapas)
													->with('recasignados', $recasignados)
													->with('id', $id)
													->with('cantetapas', $cantetapas)
													->with('cantrecasignados', $cantrecasignados);
		}

		public function post_confirmarproyecto() {
			$costoprov = Input::get('costoprov');
			if (!empty($costoprov)) {
				$id_proyecto = Input::get('id_proyecto');
				$proyecto = Proyecto::find($id_proyecto);
				$proyecto->costo = Input::get('costoprov');
		        $proyecto->save();
			}
			
			return Redirect::to('solicitudes_proyectos');
		}

		public function all_projects() {
			if (Auth::user()->tipo_usuario == 2) {
				$idusuario = Auth::user()->id;
				$proyectos = DB::table('proyectos')
				->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
				->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
				->where('proyectos.id_usuario' , '=' , $idusuario)
				->get();
				foreach ($proyectos as $p) {
					$etapas = DB::table('proyectoetapas')
					->where('proyectoetapas.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantetapas = count($etapas);

					$recasignados = DB::table('proyectorecursos')
					->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
					->where('proyectorecursos.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantrecasignados = count($recasignados);
				}
				if (empty($proyectos)) {
					return View::make('lista_proyectos')->with('proyectos', $proyectos)
					->with('error', '¡No existen proyectos registrados para el usuario logeado!');
				} else {
					return View::make('lista_proyectos')->with('proyectos', $proyectos);
				}
			} elseif (Auth::user()->tipo_usuario == 3) {
				$idusuario = Auth::user()->id;
				$proyectos = DB::table('proyectos')
				->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
				->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
				->where('proyectos.id_cliente' , '=' , $idusuario)
				->get();
				foreach ($proyectos as $p) {
					$etapas = DB::table('proyectoetapas')
					->where('proyectoetapas.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantetapas = count($etapas);

					$recasignados = DB::table('proyectorecursos')
					->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
					->where('proyectorecursos.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantrecasignados = count($recasignados);
				}
				if (empty($proyectos)) {
					return View::make('lista_proyectos')->with('proyectos', $proyectos)
					->with('error', '¡No existen proyectos registrados para el usuario logeado!');
				} else {
					return View::make('lista_proyectos')->with('proyectos', $proyectos);
				}
			}			
		}

		public function getEditEtapa($id) {
			if (Auth::user()->tipo_usuario == 1) {
				return Redirect::to('/');
			} elseif (Auth::user()->tipo_usuario == 2) {
				$proyecto = DB::table('proyectos')
				->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
				->where('proyectos.id_proyecto', '=', $id)
				->get();
				$etapas = DB::table('proyectoetapas') 
				->where('proyectoetapas.id_proyecto', '=', $id)
				->get();
				$cantetapas = count($etapas);
				
				return View::make('edit_etapa')->with('proyecto', $proyecto)
												->with('etapas', $etapas)
												->with('cantetapas', $cantetapas);

			} elseif (Auth::user()->tipo_usuario == 3) {
				$proyecto = DB::table('proyectos')
				->join('users' , 'proyectos.id_usuario' , '=' , 'users.id')
				->where('proyectos.id_proyecto', '=', $id)
				->get();
				$etapas = DB::table('proyectoetapas') 
				->where('proyectoetapas.id_proyecto', '=', $id)
				->get();
				$cantetapas = count($etapas);
				return View::make('feedback_etapa')->with('proyecto', $proyecto)
												->with('etapas', $etapas)
												->with('cantetapas', $cantetapas);
			}
		}

		public function getEditSolicitud($id) {
			if (Auth::user()->tipo_usuario == 1) {
				return Redirect::to('/');
			} else {
				$proyecto = DB::table('proyectos')
				->join('mpagos', 'mpagos.id_mpago', '=', 'proyectos.id_mpago')
				->where('proyectos.id_proyecto', '=', $id)
				->get();
				
				$mpagos = Mpago::all();

				return View::make('edit_solicitud')->with('proyecto', $proyecto)
													->with('mpagos', $mpagos);
			}
		}

		public function postEditSolicitud(){
			$inputs = Input::all();
			$reglas = array(
				'nombre' => 'required|min:4', 
				'fecha_inicio' => 'required',
				'fecha_fin' => 'required',
				'mpago' => 'required',
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
				$id_proyecto = Input::get('id_proyecto');
				$proyecto = Proyecto::find($id_proyecto);
				$proyecto->nombre = Input::get('nombre');
				$proyecto->fecha_inicio = Input::get('fecha_inicio');
				$proyecto->fecha_fin = Input::get('fecha_fin');
				$proyecto->id_mpago = Input::get('mpago');
		        $proyecto->save();		
		        $id = $proyecto->id_proyecto;
				return $this->get_continuarEtapaSolicitud($id);
			}
		}	

		public function cambiarEstadoEtapa($id_etapa) {
			$etapa = ProyectoEtapa::find($id_etapa);
			if ($etapa->cerrada == '0') {
				$etapa->cerrada = '1';
			} else {
				$etapa->cerrada = '0';
			}
			$etapa->save();
			$id = $etapa->id_proyecto;
			return $this->getEditEtapa($id);
		}

		public function getDarFeedback($id_etapa) {
			$etapa = ProyectoEtapa::find($id_etapa);
			return View::make('dar_feedback')->with('etapa', $etapa);
		}

		public function postDarFeedback() {
			$inputs = Input::all();
			$reglas = array(
				'feedback' => 'required', 
				'descripcion' => 'required',
				'fecha' => 'required',
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
				$feedback = new ProyectoFeedback;
				$feedback->id_proyecto = Input::get('id_proyecto');
				$feedback->id_etapa = Input::get('id_etapa');
				$feedback->feedback = Input::get('feedback');
				$feedback->descripcion = Input::get('descripcion');
				$feedback->fecha = Input::get('fecha');
		        $feedback->save();		
		        
				$id_etapa = Input::get('id_etapa');
				return $this->all_feedbacks($id_etapa);
			}
		}

		public function all_feedbacks($id_etapa) {
			$feedbacks = DB::table('proyectoetapafeedbacks')
				->where('proyectoetapafeedbacks.id_etapa', '=', $id_etapa)
				->get();
			
			return View::make('lista_feedbacks')->with('feedbacks', $feedbacks);
		}

		public function all_solicitudes(){
			if (Auth::user()->tipo_usuario == 2) {
				$idusuario = Auth::user()->id;
				$proyectos = DB::table('proyectos')
				->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
				->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
				->where('proyectos.id_usuario' , '=' , $idusuario)
				->where('proyectos.solicitado' , '=' , "1")
				->get();
				foreach ($proyectos as $p) {
					$etapas = DB::table('proyectoetapas')
					->where('proyectoetapas.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantetapas = count($etapas);

					$recasignados = DB::table('proyectorecursos')
					->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
					->where('proyectorecursos.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantrecasignados = count($recasignados);

					$costo = 0;
					foreach ($recasignados as $rec) {
						$costo = $costo + $rec->costo;
					}
					$p->costo_tot = $costo;
				}
				if (empty($proyectos)) {
					return View::make('lista_solicitudes')->with('proyectos', $proyectos)
					->with('error', '¡No existen solicitudes de proyectos registrados para el usuario logeado!');
				} else {
					return View::make('lista_solicitudes')->with('proyectos', $proyectos);
				}
			} elseif (Auth::user()->tipo_usuario == 3) {
				$idusuario = Auth::user()->id;
				$proyectos = DB::table('proyectos')
				->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
				->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
				->where('proyectos.id_cliente' , '=' , $idusuario)
				->where('proyectos.solicitado' , '=' , "1")
				->get();
				foreach ($proyectos as $p) {
					$etapas = DB::table('proyectoetapas')
					->where('proyectoetapas.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantetapas = count($etapas);

					$recasignados = DB::table('proyectorecursos')
					->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
					->where('proyectorecursos.id_proyecto' , '=' , $p->id_proyecto)
					->get();
					$p->cantrecasignados = count($recasignados);

					$costo = 0;
					foreach ($recasignados as $rec) {
						$costo = $costo + $rec->costo;
					}
					$p->costo_tot = $costo;
				}
				if (empty($proyectos)) {
					return View::make('lista_solicitudes')->with('proyectos', $proyectos)
					->with('error', '¡No existen solicitudes de proyectos registrados para el usuario logeado!');
				} else {
					return View::make('lista_solicitudes')->with('proyectos', $proyectos);
				}
			}
		}

		public function get_solicitud(){
			$cliente_id = Auth::user()->id;
			$cliente_usern = Auth::user()->username;
			
			$proveedor_id = Auth::user()->id_creador;
			$proveedor = User::find($proveedor_id);
			
			$mpagos = Mpago::all();

			return View::make('register_solicitud')->with('cliente_id', $cliente_id)
											->with('cliente_usern', $cliente_usern)
											->with('proveedor_id', $proveedor_id)
											->with('proveedor', $proveedor)
											->with('mpagos', $mpagos);
		}

		public function post_solicitud() {
			$inputs = Input::all();
			$reglas = array(
				'nombre' => 'required|min:4', 
				'fecha_inicio' => 'required',
				'fecha_fin' => 'required',
				'mpago' => 'required',
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
				$proyecto = new Proyecto;
				$proyecto->nombre = Input::get('nombre');
				$proyecto->fecha_inicio = Input::get('fecha_inicio');
				$proyecto->fecha_fin = Input::get('fecha_fin');
				$proyecto->id_cliente = Input::get('id_cliente');
				$proyecto->id_usuario = Input::get('id_proveedor');
				$proyecto->id_mpago = Input::get('mpago');
				$proyecto->solicitado = Input::get('solicitado');
		        $proyecto->save();		
		        $id = $proyecto->id_proyecto;
				return $this->get_continuarEtapaSolicitud($id);
			}			
		}
		public function get_continuarEtapaSolicitud($id) {
			$etapas = DB::table('proyectoetapas')
			->where('proyectoetapas.id_proyecto' , '=' , $id)
			->get();

			return View::make('continuar_etapa_solicitud')->with('id', $id)
													->with('etapas', $etapas);
		}

		public function post_continuarEtapaSolicitud() {
		$inputs = Input::all();
		$reglas = array(
			'nombre' => 'required|min:4', 
			'fecha_inicio' => 'required',
			'fecha_fin' => 'required',
		);
		$mensajes = array(
			'required' => 'Campo Obligatorio',
		);
		$validar = Validator::make($inputs, $reglas);
		if($validar->fails())
		{	
			Input::flash();
			$etapas = DB::table('proyectoetapas')
			->where('proyectoetapas.id_proyecto' , '=' , Input::get('id_proyecto'))
			->get();
			$id = Input::get('id_proyecto');
			return View::make('continuar_etapa_solicitud')->with('id', $id)->withErrors($validar)->with('etapas', $etapas);
		}
		else
		{
			$etapa = new ProyectoEtapa;
			$etapa->id_proyecto = Input::get('id_proyecto');
			$etapa->nombre = Input::get('nombre');
			$etapa->fecha_ini = Input::get('fecha_inicio');
			$etapa->fecha_fin = Input::get('fecha_fin');
			$etapa->save();
			$id = Input::get('id_proyecto');
			return $this->get_continuarEtapaSolicitud($id);
		}
		}
		public function get_continuarRecursoSolicitud($id) {
			$idproyecto = $id;

			if (Auth::user()->tipo_usuario == 2) {
				$idusuario = Auth::user()->id;			
			} else{
				$idusuario = Auth::user()->id_creador;
			}
			
			$recursos = DB::table('recursos')
			->join('seniorities' , 'seniorities.id_seniority' , '=' , 'recursos.id_seniority')
			->where('id_proveedor' , '=' , $idusuario)
			->get();

			$recasignados = DB::table('proyectorecursos')
			->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
			->join('seniorities' , 'seniorities.id_seniority' , '=' , 'recursos.id_seniority')
			->where('proyectorecursos.id_proyecto' , '=' , $idproyecto)
			->get();
			$costo = 0;
			foreach ($recasignados as $rec) {
				$costo = $costo + $rec->costo;
			}

			return View::make('continuar_recurso_solicitud')->with('recursos', $recursos)
													->with('id', $id)
													->with('recasignados', $recasignados)
													->with('costo', $costo);
		}
		public function post_continuarRecursoSolicitud() {
			$inputs = Input::all();
			$reglas = array(
				'recurso' => 'required', 
			);
			$mensajes = array(
				'required' => 'Campo Obligatorio',
			);
			$validar = Validator::make($inputs, $reglas);
			if($validar->fails())
			{	
				Input::flash();
				$idusuario = Auth::user()->id_creador;			
				$recursos = Recurso::where('id_proveedor' , '=' , $idusuario)->get();
				$id = Input::get('id_proyecto');
				$costo = Input::get('costo');
				
				return View::make('continuar_recurso_solicitud')->with('id', $id)
																->withErrors($validar)
																->with('recursos', $recursos)
																->with('costo', $costo);
			}
			else
			{
				$precurso = new ProyectoRecurso;
				$precurso->id_proyecto = Input::get('id_proyecto');
				$precurso->id_recurso = Input::get('recurso');
				$costo = Input::get('costo');
				$precurso->save();
				$id = Input::get('id_proyecto');
				return $this->get_continuarRecursoSolicitud($id)
							->with('costo', $costo);
			}
		}		
		public function get_confirmarproyectosolicitud($id) {
			$proyecto = DB::table('proyectos')
			->join('users' , 'proyectos.id_cliente' , '=' , 'users.id')
			->join('mpagos' , 'proyectos.id_mpago' , '=' , 'mpagos.id_mpago')
			->where('proyectos.id_proyecto' , '=' , $id)
			->get();
			
			$etapas = DB::table('proyectoetapas')
			->where('proyectoetapas.id_proyecto' , '=' , $id)
			->get();
			$cantetapas = count($etapas);

			$recasignados = DB::table('proyectorecursos')
			->join('recursos' , 'recursos.id_recurso' , '=' , 'proyectorecursos.id_recurso')
			->where('proyectorecursos.id_proyecto' , '=' , $id)
			->get();
			$cantrecasignados = count($recasignados);

			$costo = 0;
			foreach ($recasignados as $rec) {
				$costo = $costo + $rec->costo;
			}

			
			return View::make('confirma_proyecto_solicitud')->with('proyecto', $proyecto)
													->with('etapas', $etapas)
													->with('recasignados', $recasignados)
													->with('id', $id)
													->with('cantetapas', $cantetapas)
													->with('cantrecasignados', $cantrecasignados)
													->with('costo', $costo);
		}
		public function destroy($id) {
			return 'Sent!';
		}

			
	}
?>