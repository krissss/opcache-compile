<?php
include ('config.php');

// ��ȡָ��Ŀ¼������Ŀ¼�µ�����PHP�ļ�
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
    if(opcache_compile_file($file)){ //����PHP�ļ�����opcode
		file_put_contents($file, ''); //���ԭ����PHP�ű�
		echo $file.$br;
	}
}
echo 'Total PHP Files: '.count($files).$br;