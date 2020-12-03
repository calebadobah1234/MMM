@echo off
goto main

:main
setlocal

	for /r %%g in ( * ) do (
		echo (Null ,'%%g' ,'Server-5', '%%g', '%%g'^),
	)
	
	endlocal
	
goto :eof
bat.bat > xxx.sql
pause	
	
