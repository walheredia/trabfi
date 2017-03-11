<?php
	class RecursosController extends BaseController {
		public function get_nuevo() {
			$seniorities = Seniority::all();

			return View::make('register_recurso')->with('seniorities', $seniorities);
		}
		public function post_nuevo() {
			$inputs = Input::all();
			$reglas = array(
				'nombre' => 'required|min:4', 
				'fecha_ingreso' => 'required',
				'edad' => 'required',
				'sexo' => 'required',
				'seniority' => 'required',
				'remuneracion' => 'required',
				'actividad' => 'required',
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
				$recurso = new Recurso;
				$recurso->nombre = Input::get('nombre');
				$recurso->fecha_ingreso = Input::get('fecha_ingreso');
				$recurso->edad = Input::get('edad');
				$recurso->sexo = Input::get('sexo');
				$recurso->id_seniority = Input::get('seniority');
				$recurso->remuneracion = Input::get('remuneracion');
				$recurso->actividad = Input::get('actividad');
				if (Input::get('estado') == '1') {
					$recurso->estado = Input::get('estado');
				} else {
					$recurso->estado = 'false';
				}
				$recurso->id_proveedor = Auth::user()->id;
		        $recurso->save();		
				return Redirect::to('lista_recursos')->with('error', 'El Recurso ha sido registrado con Éxito')->withInput();
			}
		}

		public function all_resources() {
			$idusuario = Auth::user()->id;
				$recursos = DB::table('recursos')
				->join('seniorities' , 'recursos.id_seniority' , '=' , 'seniorities.id_seniority')
				->where('recursos.id_proveedor' , '=' , $idusuario)
				->get();
			return View::make('lista_recursos')->with('recursos', $recursos);
		}
	}
?>