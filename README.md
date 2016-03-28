# 说明
1.此方法在 php7 版本上试验成功，其他版本未测试<br /> 
2.此方法存在被反编译的可能，因此只做代码保护功能，对于需求加密的，请绕道zend guard<br /> 

# 使用
1.下载包文件，解压文件至一个目录，（以下说明假设解压后文件路径为 C:\soft\WWW\opcache-compile\blacklist ...）<br /> 
2.修改 blacklist，添加或删除不需要被编译的文件或目录（绝对路径），一条一行<br /> 
3.修改 config.php，修改其中的原项目路径和编译后项目路径（默认在原路径名后追加-compile）<br /> 
4.安装或打开 php 扩展 opcache，参考 http://php.net/manual/zh/opcache.installation.php<br /> 
5.配置 php.ini 中白名单 opcache.blacklist_filename = C:/soft/WWW/opcache-compile/blacklist （视自己的解压路劲而定）<br /> 
6.配置 php.ini 中opcahe导出的bin文件路径，opcache.file_cache = C:/soft/WWW/opcache （确保目录存在，否则不能导出）<br /> 
7.在 C:\soft\WWW\opcache-compile 目录下的打开命令行，依次执行<br /> 
  php copy.php # 该操作会复制一份原项目（默认命名为原路径名后追加-compile，下面称呼该目录为 A）<br /> 
  php compile.php # 该操作会执行编译（请勿将两步操作并成一步执行，否则会造成无法写入导出目录）<br /> 
8.查看 C:/soft/WWW/opcache 目录下是否存在一份 opcache 编译后的bin文件（下面称呼该目录为 B）<br /> 
9.如果存在，恭喜您，您已经编译成功<br /> 
10.现在您可以使用 A+B 来访问您的项目了，但是前提条件是请在使用这份代码的服务器上，设置 php.ini 中 opcache.validate_timestamps=0，来确保您的bin文件不需要校验（如果校验必定会被替换），另外您可以放心大胆的将
opcache.revalidate_freq=99999设置的足够大，因为您的代码的中间件是永远不变的<br /> 
11.如果以后需要重新编译，请重复第7步，然后将以前的代码全部覆盖<br /> 
