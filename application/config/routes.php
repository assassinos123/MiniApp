<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['admincustomers/showcustomermessagesAdmin'] = 'admincustomers/showcustomermessagesAdmin';
$route['admincustomers/editcustomerAdmin'] = 'admincustomers/editcustomerAdmin';
$route['admincustomers/(:any)'] = 'admincustomers/viewcustomerAdmin/$1';
$route['admincustomers'] = 'admincustomers/indexcustomerAdmin';

$route['adminmessages/indexAdmin'] = 'adminmessages/indexAdmin';
$route['adminmessages/(:any)'] = 'adminmessages/viewAdmin/$1';
$route['adminmessages'] = 'adminmessages/indexAdmin';


//$route['myprofile'] = 'customers/myprofile';

$route['messages/index'] = 'messages/index';
$route['messages/create'] = 'messages/create';
$route['messages/(:any)'] = 'messages/view/$1';
$route['messages'] = 'messages/index';

$route['default_controller'] = 'pages/view';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
