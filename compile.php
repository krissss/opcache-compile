<?php
include ('config.php');

// 获取指定目录及其子目录下的所有PHP文件
function getfiles( $path , &$files = array() ) {
    if ( !is_dir( $path ) ) return null;
    $handle = opendir( $path );
    while ( false !== ( $file = readdir( $handle ) ) ) {
        if ( $file != '.' && $file != '..' ) {
            $path2 = $path . '/' . $file;
            if ( is_dir( $path2 ) ) {
                getfiles( $path2 , $files );
            } else {
                if ( preg_match( "/\.(php)$/i" , $file ) ) {
                    $files[] = $path2;
                }
            }
        }
    }
    return $files;
}

$files = getfiles($projectPathToCompile);
$br = (php_sapi_name() == "cli") ? "\n" : "<br />";
foreach($files as $file){
    if(opcache_compile_file($file)){ //编译PHP文件生成opcode
		file_put_contents($file, ''); //清空原来的PHP脚本
		echo $file.$br;
	}
}
echo 'Total PHP Files: '.count($files).$br;