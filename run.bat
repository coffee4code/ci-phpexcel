@echo off
SET /P ST=    ���飺����enter��������
echo.
SET /P ST=   (1)ȷ����ת��excel�ļ����ڵ�ǰĿ¼��,
echo.
SET /P ST=   (2)��������Ϊ[ A.xlsx ],
echo.
SET /P ST=   (3)excel�ļ���ÿ��sheet�����а�����[ ��װ ] ���� [ ά�� ]��
echo.
SET /P ST=   ��Y/y��������N/n�˳���
echo.
if /I "%ST%"=="Y" goto tag1
if /I "%ST%"=="N" exit

:tag1
	%~dp0/bin/php.exe %~dp0/lib/exec.php
	pause
	
