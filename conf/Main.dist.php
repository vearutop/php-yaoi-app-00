<?php

date_default_timezone_set('Asia/Novosibirsk');

Database_Conf::$dsn['default'] = 'mysqli://user:password@localhost/table?charset=utf8&timezone=Asia/Novosibirsk';
