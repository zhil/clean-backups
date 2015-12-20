<?php
if ($argv) {
    foreach ($argv as $k=>$v)
    {
        if ($k==0) continue;
        $it = explode("=",$v);
        if (isset($it[1])) {
            $vars[$it[0]] = $it[1];
        }
    }
}
if(!array_key_exists("prefix",$vars)) {
    die("You should set prefix name, like php cleanup_backups.php dir=/root/Dropbox/mysql_backups/YourProjectName prefix=YourProjectName");
}

if(array_key_exists("dir",$vars)) {
    if(substr($vars["dir"],-1) == "/") {
        $vars["dir"] = substr($vars["dir"],0,-1);
    }
    print "scan backup's dir - ".$vars["dir"]." ...";
} else {
    die("You should set backup dir, like php cleanup_backups.php dir=/root/Dropbox/mysql_backups/YourProjectName prefix=YourProjectName");
}

$f = scandir($vars["dir"]);
$files = array();
foreach($f as $key=>$file){
    if(!in_array($file,array('.','..'))){
        $path = $vars["dir"].'/'.$file;
        if(is_file($path)){
//          vidopro_14_02_07_13.sql.gz
            if(preg_match_all("'^".$vars["prefix"]."(.{2})_(.{2})_(.{2})'sui",$file,$fileName)){
                $index = $fileName[1][0].'_'.$fileName[2][0];
                if(!array_key_exists($index,$files)){
                    $files[$index] = array();
                }
                $files[$index][$fileName[3][0]] = $path;
            }else{
                print "\n ERROR file's name has not correct format - ".$path;
            }
        }
    }
}
$monthNumbers = array();
$monthNumbers[] = date("y_m");
$monthNumbers[] = date("y_m",strtotime('-1 month'));
$monthNumbers[] = date("y_m",strtotime('-2 month'));
foreach ($files as $monthNumber => $month) {
    if (!in_array($monthNumber, $monthNumbers)) {
        array_shift($month);
        foreach ($month as $dayFile) {
            unlink($dayFile);
            print "\n unlinked " . $dayFile;
        }
    }
}
print "\ndone.\n";
?>
