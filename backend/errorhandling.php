<?php
class error{
	private $dir = "log/";
	
	public function __construct($message, $type = ""){

		switch ($type){
		case "mysql":
			$log = "[".time()."]$message";
			$file = $this->dir."mysql/log.txt";
			break;
		case "fatal_error":
			$log = "[".time()."]$message";
			$file = $this->dir."error/log.txt";
			break;
		case "warning":
			$log = "[".time()."]$message";
			$file = $this->dir."warning/log.txt";
			break;
		case "notice":
			$log = "[".time()."]$message";
			$file = $this->dir."notices/log.txt";
			break;
		default:
			$log = "[".time()."]$message";
			$file = $this->dir."unknown/log.txt";
			break;
		}
		$this->savelog($log, $file);
	}
	private function savelog($log, $file){
		$old_chdir = getcwd();
		chdir(SERVER_DIR);
		$backup = fopen($file, "r");
		$log_content = fread($backup, filesize($file));
		fclose($backup);
		
		$handle = fopen($file, "a");
		fwrite( $handle , "$log \n");
		fclose($handle);
		chdir($old_chdir);
	}
}
function log_error($errorlevel, $errorstring, $errorfile, $errorline){

    if (!(error_reporting() & $errorlevel)) {
        // This error code is not included in error_reporting
        return;
    }
	
    switch ($errorlevel) {
    case 256: // E_USER_ERROR
		$error = new error("[$errorlevel] $errorstring //line $errorline in file $errorfile // PHP " . PHP_VERSION . " (" . PHP_OS . ") //", "fatal_error");
        echo "Ohh, an error! it says: <p> $errorstring </p> <strong>Aborting... </strong> </br> <small>Seems like you have to check the log for the error</small>";
        exit(1);
        break;

    case 2: // E_Warning
        $error = new error("[$errorlevel] $errorstring //line $errorline in file $errorfile // PHP " . PHP_VERSION . " (" . PHP_OS . ") //", "warning");
        break;

    case 8: // E_USER_NOTICE
        $error = new error("[$errorlevel] $errorstring //line $errorline in file $errorfile" , "notice");
        break;

    default:
        $error = new error("[$errorlevel] $errorstring //line $errorline in file $errorfile" );
        break;
    }


}

function die_friendly($msg = '', $title = ''){
echo $msg;
}
?>