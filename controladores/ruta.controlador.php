<?php

//reservas-alphus.com
class ControladorRuta{

	static public function ctrRuta(){

		return 'http://reservas-alphus.com/'; /**Esto esta configurado con dominio virtual */
		// return 'http://localhost/reservas-alphus/';
		// return 'https://localhost/reservas-alphus/';

	}

	static public function ctrServidor(){

		return 'http://admon-reservas-alphus.com/'; /**Esto esta configurado con dominio virtual */
		// return 'http://reservas-alphus.com/administracion/'; /**Esto esta configurado con dominio virtual */
		// return 'http://localhost/reservas-alphus/administracion/';
		// return 'https://localhost/reservas-alphus/administracion/';

	}

}