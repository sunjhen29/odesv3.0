<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); 
defined('SITE_ROOT') ? null : define('SITE_ROOT','C:'.DS.'xampp'.DS.'htdocs'.DS."odesv3.0");
defined('INCLUDES_FOLDER') ? null : define('INCLUDES_FOLDER', SITE_ROOT.DS.'_includes'); 

//allow gzip compression
ob_start("ob_gzhandler"); 

// load config file first
require_once(INCLUDES_FOLDER.DS.'dbconfig.php');

// load basic functions next so that everything after can use them
require_once(INCLUDES_FOLDER.DS.'PHPExcel.php');
require_once(INCLUDES_FOLDER.DS.'lookup.class.php');
require_once(INCLUDES_FOLDER.DS.'helper.class.php');
require_once(INCLUDES_FOLDER.DS.'online.class.php');

// load core objects
require_once(INCLUDES_FOLDER.DS.'session.class.php');
require_once(INCLUDES_FOLDER.DS.'database.class.php');
require_once(INCLUDES_FOLDER.DS.'backup.php');
require_once(INCLUDES_FOLDER.DS.'phpgraphlib.class.php');

// load database-related classes
require_once(INCLUDES_FOLDER.DS.'user.class.php');
require_once(INCLUDES_FOLDER.DS.'jobnumber.class.php');
require_once(INCLUDES_FOLDER.DS.'download.class.php');
require_once(INCLUDES_FOLDER.DS.'publication.class.php');
require_once(INCLUDES_FOLDER.DS.'nz.class.php');
require_once(INCLUDES_FOLDER.DS.'au.class.php');
require_once(INCLUDES_FOLDER.DS.'agent.class.php');
require_once(INCLUDES_FOLDER.DS.'agent_au.class.php');
require_once(INCLUDES_FOLDER.DS.'invalid.class.php');
require_once(INCLUDES_FOLDER.DS.'suburb.class.php');
require_once(INCLUDES_FOLDER.DS.'aupostcode.class.php');
require_once(INCLUDES_FOLDER.DS.'kpi.class.php');
require_once(INCLUDES_FOLDER.DS.'records.class.php');
require_once(INCLUDES_FOLDER.DS.'cbhs.class.php');
require_once(INCLUDES_FOLDER.DS.'reports.class.php');


//standard time
date_default_timezone_set('Asia/Manila');

?>