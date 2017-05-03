<?php
/**
 * Created by IntelliJ IDEA.
 * User: pfranck
 * Date: 03.05.17
 * Time: 16:04
 *
 * use OJSURL/plugins/pubIds/zenon/api.php
 * to get a list of zenonids <-> urls of fulltext articles
 * use ?zenonid = ID fot a specific one
 *
 * - make sure, short URLs (like publications.dainst.org/chiron/227) works
 * - make sure, ojsDomain and ojsFolder are set in config
 *
 */

$errorReporting = false;

try {

	// set up error reporting
	if ($errorReporting) {
		error_reporting(E_ALL);
		ini_set('display_errors', 'on');
	}  else {
		ini_set ("display_errors", "0");
		error_reporting(false);
	}

	// enabling CORS (would be a shameful webservice without)
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');    // cache for 1 day
	}


	// register shutdown function
	register_shutdown_function(function()  {
		$error = error_get_last();
		//check if it's a core/fatal error, otherwise it's a normal shutdown
		if ($error !== NULL && in_array($error['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING))) {
			$return = array(
				'success'	=> false,
				'message'	=> "500 / Internal Server Error" . ": {$error['message']} in line {$error['line']} of {$error['file']}"
			);

			http_response_code(200);
			header('Content-Type: application/json');
			echo json_encode($return);
		}
	});

	$path = (file_exists('ojspath')) ? file_get_contents('ojspath') : '../../../tools/bootstrap.inc.php';
	require_once realpath($path);

	// set up error reporting 2nd time becaise OJS may change it
	if ($errorReporting) {
		error_reporting(E_ALL);
		ini_set('display_errors', 'on');
	}  else {
		ini_set ("display_errors", "0");
		error_reporting(false);
	}


	// get data
	$dao = new DAO();
	$url = Config::getVar('dainst', 'ojsDomain') . '/' . Config::getVar('dainst', 'ojsFolder') . '/';
	$zid = isset($_GET['zenonid']) ? (int) $_GET['zenonid'] : false;

	$sql = "select 
			  setting_value, 
			  concat(\"$url\", j.path, '/', a.article_id) as url
			from 
				article_settings as a_s
				left join articles as a on a.article_id = a_s.article_id
				left join journals as j on j.journal_id = a.journal_id
			where 
				setting_name = \"pub-id::other::zenon\"" .
	$sql .= $zid ? " and a.article_id = $zid" : '';
	$res = $dao->retrieve($sql);
	$box = $res->getAssoc();
	$res->Close();

	// send data
	echo json_encode((object) $box);


} catch (\Exception $e) {
	$return = array(
		'success'	=> false,
		'message'	=> $e->getMessage()
	);

	http_response_code(200);
	header('Content-Type: application/json');
	echo json_encode($return);
}

?>
<?php // echo "<pre>";  var_dump($box); echo "</pre>"; ?>
