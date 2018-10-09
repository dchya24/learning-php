<?php 

namespace Core;

use Core\Helper;

Class Router 
{
 /**
  * Array of Routes
  * @var array
  */

  protected $routes  = [];

  /**
   * Parameters from matched route
   * @var array
   */

   protected $params = [];
  
   /**
    * Add a route to routes
    * @param string $route the route URL
    * @param array $params Parameters (Controller, action, etc.)

    * @return void
    */

    public function add($route, $params = []) {

        // convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//','\\/', $route);

        // convert variables e.g. {ocntroller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // convert variable with customr egular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
    * Get all the routes
    * @return array
    */
    public function getRoutes(){
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property of a route is found
     * 
     * @param string $url the route URL
     * 
     * @return boolean true if match found, false otherwise
     */
    public function match($url){
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)) {
                        $params['key'] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * get the currently matched params
     * @return array
     */

    public function getParams() { 
        return $this->params; 
    }

    /**
    * Dispatch the route, creating the controller object 
    * and running the action method
    *
    * @param string $url the route URL
    *
    * @return void
    */
    public function dispatch($url){
        $this->match($url);

        $helper = new Helper;
        $url = $this->removeQueryStringVariables($url);

        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $helper->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            if(class_exists($controller)){
                $controller_object = new $controller($this->params);
                
                $action = $this->params['action'];
                $action = $helper->convertToCamelCase($action);

                if(preg_match('/action$/i', $action) ==0) {
                    try {
                        $controller_object->$action();
                    } catch(\Exception $e) {
                        ("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                    }
                }
                // else {
                //     throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                // }
            } 
            else{ 
                throw  new \Exception("Controller class $controller not found!");
            }

        } else {
            throw new \Exception('No Route Matched');
        }

    }

    /**
     * Remove Query String for url
     * 
     * @param string $url the full URL
     * 
     * @return string url without query string
     */
    protected function removeQueryStringVariables($url)
    {
        if($url != ''){
            $parts = explode('&', $url, 2);
            
            if(strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }


    public function getNamespace(){

        $namespace = "App\Controllers\\";

        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
      
    }      
}