<?php


function dd($vars, $di = true)
{

    var_dump($vars);
    if ($di)
        exit;
}




function view($dir, $vars = [])
{

    
    $viewBuilder = new \System\View\ViewBuilder();
    $viewBuilder->run($dir);
    $viewVars = $viewBuilder->vars;
    $content = $viewBuilder->contans;
    empty($viewVars) ? : extract($viewVars);
    empty($vars) ? : extract($vars);

    eval(" ?> ".html_entity_decode($content));
}



function html($text)
{
    return html_entity_decode($text);
}

function old($name)
{

    if (isset($_SESSION['temporary_old'][$name]))
        return $_SESSION['temporary_old'][$name];
    return null;
}




function flash($name, $errorMessege = null)
{

    if (empty($errorMessege)) {

        if (isset($_SESSION['temporary_flash'][$name])) {
            $temprary = $_SESSION['temporary_flash'][$name];
            unset($_SESSION['temporary_flash'][$name]);
            return $temprary;
        } else {
            return false;
        }
    } else {
        $_SESSION['flash'][$name] = $errorMessege;
    }
}



function flasExist($name)
{
    return isset($_SESSION['temporary_flash'][$name]) === true ? true : false;
}




function allflashes()
{
    if (isset($_SESSION['temporary_flash'])) {
        $temprary = $_SESSION['temporary_flash'];
        unset($_SESSION['temporary_flash']);
        return $temprary;
    } else {
        return false;
    }
}




function error($name, $errorMessege = null)
{

    if (empty($errorMessege)) {

        if (isset($_SESSION['temporary_errorflash'][$name])) {

            $temprary = $_SESSION['temporary_errorflash'][$name];
            unset($_SESSION['temporary_errorflash'][$name]);
            return $temprary;
        } else {
            return false;
        }
    } else {

        $_SESSION['errorflash'][$name] = $errorMessege;
    }
}



function errorExist($name = null)
{
    if ($name == null) {

        return isset($_SESSION['temporary_errorflash']) === true ? count($_SESSION['temporary_errorflash']) : false;
    } else {
        return isset($_SESSION['temporary_errorflash'][$name]) === true ? true : false;
    }
}



function alleErors()
{

    if (isset($_SESSION['temporary_errorflash'])) {
        $temprary = $_SESSION['temporary_errorflash'];
        unset($_SESSION['temporary_errorflash']);
        return $temprary;
    } else {
        return false;
    }
}




function currentdomain()
{
    $httpProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? "https://" : "http://";
    $currentUrl = $_SERVER['HTTP_HOST'];
    return $httpProtocol . $currentUrl;
}



function redirect($url)
{
    $url = trim($url, '/ ');
    $url = str_replace('.', '/', $url);
    $url = strpos($url, currentDomain()) === 0 ?  $url : currentDomain() . '/' . $url;
    header("Location: " . $url);
    exit;
}

function back()
{
    $http_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_referer);
}



function asset($src)
{
    return currentdomain() . ('/' . trim($src, '/ '));
}


function url($src)
{
    return currentdomain() . ('/' . trim($src, '/ '));
}



function FindRouteByName($name)
{

    global $routes;

    $allRoutes = array_merge($routes['get'], $routes['post'], $routes['put'], $routes['delete']);
    $route = null;
    foreach($allRoutes as $element)
    {
        if($element['name'] == $name && $element['name'] !== null){
            $route = $element['url'];
              break;
        }
    }
    return $route;
}



function route($name, $params = [])
{


    if(!is_array($params))
    {
        throw new Exception('route params must be array!');
    }

    $route = findRouteByName($name);
    if($route === null)
    {
        throw new Exception('route not found');
    }
    $params = array_reverse($params);
    $routeParamsMatch = [];
    preg_match_all("/{[^}.]*}/", $route, $routeParamsMatch);
    if(count($routeParamsMatch[0]) > count($params))
    {
        throw new Exception('route params not enough!!');
    }
    foreach($routeParamsMatch[0] as $key => $routeMatch)
    {
        $route = str_replace($routeMatch, array_pop($params), $route);
    }
    return currentDomain()."/".trim($route, " /");
}





function methodfiled()
{
    $method_filed = strtolower($_SERVER['REQUEST_METHOD']);

    if ($method_filed === "post") {

        if (isset($_POST['_method'])) {

            if ($_POST['_method'] === "put") {

                $method_filed = "put";
            } elseif ($_POST['_method'] === "delete") {

                $method_filed = "delete";
            }
        }
    }

    return $method_filed;
}



function array_dot($array, $return_array = [], $return_key = '')
{

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return_array = array_merge($return_array, array_dot($value, $return_array, $return_key . $key . "."));
        } else {
            $return_array[$return_key . $key] = $value;
        }
    }
    return $return_array;
}



function generateToken()
{
    return bin2hex(openssl_random_pseudo_bytes(32));
}



function currenturl()
{
    return currentdomain() . $_SERVER['REQUEST_URI'];
   
}





/////// paginate ///////
function paginate($data, $prepage)
{
    $totalRow = count($data);
    $curentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalpage = ceil($totalRow / $prepage);
    $curentpage = min($curentpage, $totalpage);
    $curentpage = max($curentpage, 1);
    $currentRow = ($curentpage - 1) * $prepage;
    $data = array_slice($data,$currentRow,$prepage);
    return $data;
}



function paginateView($data, $prepage)
{

    $totalRow = count($data);
    $curentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalpage = ceil($totalRow / $prepage);
    $curentpage = min($curentpage, $totalpage);
    $curentpage = max($curentpage, 1);

    

    $paginatView = '';
    $paginatView .= ($curentpage != 1) ? '<li><a href="' . paginateUrl(1) . '">&lt;</a></li>' : '';
    $paginatView .= (($curentpage - 2) >= 1) ? ' <li><a href="' . paginateUrl($curentpage - 2) . '">' . ($curentpage - 2) . '</a></li>' : '';
    $paginatView .= (($curentpage - 1) >= 1) ? '<li><a href="' . currenturl($curentpage - 1) . '">' . ($curentpage - 1) . '</a></li>' : '';
    $paginatView .= '<li class="active"><a href="' . paginateUrl($curentpage) . '">' . ($curentpage) . '</a></li>';
    $paginatView .= (($curentpage + 1) <= $totalpage) ? ' <li><a href="' . paginateUrl($curentpage + 1) . '">' . ($curentpage + 1) . '</a></li>' : '';
    $paginatView .= (($curentpage + 2) <= $totalpage) ? ' <li><a href="' . paginateUrl($curentpage + 2) . '">' . ($curentpage + 2) . '</a></li>' : '';
    $paginatView .= ($curentpage != $totalpage) ? '<li><a href="' . paginateUrl($totalpage) . '">&gt;</a></li>' : '';
   
   return '
   <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                           '.$paginatView.'
                        </ul>
                    </div>
                </div>
            </div>
   ';
}


function paginateUrl($page)
{
    
    $arrayUrl = explode('?', currenturl());
    if (isset($arrayUrl[1])) {
        $_GET['page'] = $page;
        $GetVariabel = array_map(function ($value, $key) {
            return $key . '=' . $value;
        }, $_GET, array_keys($_GET));
        return $arrayUrl[0] . '?' . implode('&', $GetVariabel);
    } else {
        return currenturl() . '?page=' . $page;
    }
}