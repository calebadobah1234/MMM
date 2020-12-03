@echo off
goto main

:main
setlocal

	for /r %%i in ( * ) do (
		echo ^<h5 class="miel"^>^<a href="http://mediahome.infinityfreeapp.com/search.php?search=%%~nxi&submit=search"^> %%~nxi ^</a^>^</h5^>
	)
	
	endlocal

goto :eof
batma.bat > xxxx.html	

pause	
	
