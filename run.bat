@echo off
SET /P ST=    请检查：（按enter建继续）
echo.
SET /P ST=   (1)确定待转换excel文件已在当前目录下,
echo.
SET /P ST=   (2)并重命名为[ A.xlsx ],
echo.
SET /P ST=   (3)excel文件的每个sheet名称中包含有[ 安装 ] 或者 [ 维修 ]。
echo.
SET /P ST=   按Y/y继续，按N/n退出：
echo.
if /I "%ST%"=="Y" goto tag1
if /I "%ST%"=="N" exit

:tag1
	%~dp0/bin/php.exe %~dp0/lib/exec.php
	pause
	
