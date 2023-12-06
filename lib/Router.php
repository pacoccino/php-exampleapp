<?php

namespace Lib;

require dirname(__DIR__, 1).'/config/routes.php';

class Router {
	private $routes = array();
	private $availablePages = array();
	private $requestedPage = null;

	public function __construct() {
		$this->routes = AVAILABLE_ROUTES;
		$this->availablePages = array_keys($this->routes);
		$this->requestedPage = isset($_GET['page']) ? $_GET['page'] : null;
		$this->route();
	}

	public function route() {
		// Check si le paramètre GET "page" existe
		if(isset($this->requestedPage)) {
			// Check si la page est bien dans le tableau de route (l'argument "true" vérifie aussi le type du paramètre)
			if(in_array($this->requestedPage, $this->availablePages, true)) {
				$ControllerClass = AVAILABLE_ROUTES[$_GET['page']];
			} else {

				$ControllerClass = UNKNOWN_ROUTE;
			}
		} else {
			$ControllerClass = DEFAULT_ROUTE;
		}

		// Inclusion du contrôleur
		$controller = new $ControllerClass();
		$controller->execute();

	}
}

?>