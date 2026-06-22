<?php
define('BASE_URL', 'http://localhost/school-system/public/');
define('APP_ROOT', dirname(__DIR__));
define('SESSION_NAME', 'SCHOOL_SESSION');
define('SESSION_LIFETIME', 7200);      // 2 horas
define('CSRF_TOKEN_NAME', 'csrf_token');
define('BCRYPT_COST', 12);
define('ENCRYPTION_KEY', getenv('APP_ENCRYPTION_KEY') ?: 'Vitor_Nobrega_Ribeiro@160309'); // 32 bytes
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_TIMEOUT_MINUTES', 15);