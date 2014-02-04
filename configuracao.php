<?php

if (!file_exists(__root . 'sql/schema.done')) {

    $db = new MySQLi_db(localhost, user, pass, db_name);

    $file = __root . 'sql/schema.sql';
    $output = run_sql_file($file);

    $validar = false;
    foreach ($output['query'] as $dados) {
 
        if ($db->ExecuteUpdate($dados)) {
            $validar = true;
        }
    }

    if ($validar) {
        $file = __root . 'sql/schema.done';
        $handle = fopen($file, 'w+');
        fwrite($handle, 'done');
        fclose($handle);
    }
}

function run_sql_file($location) {
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode("\n", $commands);
    $commands = '';
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line && !startsWith($line, '--')) {
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    $sql = array();

    foreach ($commands as $command) {
        if (trim($command)) {
            $success += (@mysql_query($command) == false ? 0 : 1);
            $sql[] = $command . ";";
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total,
        "query" => $sql
    );
}

// Here's a startsWith function
function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

?>