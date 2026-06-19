@echo off
setlocal

set "PGDATA=%USERPROFILE%\scoop\persist\postgresql\data"

pg_isready -h 127.0.0.1 -p 5432 -d kakeibo >nul 2>&1
if errorlevel 1 (
    echo Starting PostgreSQL...
    pg_ctl -D "%PGDATA%" start
    if errorlevel 1 (
        echo PostgreSQL did not start. Check the database cluster at %PGDATA%.
        exit /b 1
    )
)

pushd "%~dp0.."
php artisan serve --host=127.0.0.1 --port=8000
popd
