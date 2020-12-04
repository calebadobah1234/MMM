@echo off
goto main

:main
setlocal

	for /r %%i in ( * ) do (
		echo ^<h5 class="miel"^>^<a href="http://mediahome.ga/%%i"^> %%~nxi ^</a^>^</h5^>
	)
	
	endlocal

goto :eof
fras2.bat > xxxx.html	

pause	
	
