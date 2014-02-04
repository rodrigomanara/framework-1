<?php

/**
 * Description of validation
 *
 * @author rodrigo
 */
final class validation {

    //put your code here

    public function val($data = array()) {
        $i = 0;
        $error = array();
        foreach ($data as $key => $check) {
            if (is_null($check) or empty($check)) {
                $error[$key] = "Verifique o campo acima &uuarr;";
            } else {

                if (strstr($key, "email")) {
                    if ((strstr($key, "email") && !strstr($check, "@"))) {
                        $error[$key] = "email invalido &uuarr;";
                    } else {

                        $error[$key] = true;
                    }
                } elseif (strstr($key, "span")) {
                    if ((int) $_SESSION['randon'] === (int) $data[$key]) {
                        $error[$key] = true;
                    } else {
                        $error[$key] = "invalido codigo!&uuarr;";
                    }
                } else {
                    $error[$key] = true;
                }
            }

            if ($error[$key] === true) {
                $i++;
            }
        }

        if ((int) count($data) === (int) $i) {
            return array("error" => true, "validation" => $error);
        } else {
            return array("error" => false, "validation" => $error);
        }
    }

    public function valpass($data = array()) {
        $one = $data['__rm-password'];
        $two = $data['__rm-password2'];
        
        
        $array['checkpass'] = ($one === $two) ? true : false;
        $array['info'] = "Passwords not matching!";
        return $array;
    }
    
    
    function validaemail($sToEmail, $sFromDomain = "yourdomain.com", $sFromEmail = "sample@yourdomain.com", $bIsDebug = false) {

        $bIsValid = true; // assume the address is valid by default..
        $aEmailParts = explode("@", $sToEmail); // extract the user/domain..
        getmxrr($aEmailParts[1], $aMatches); // get the mx records..

        if (sizeof($aMatches) == 0) {
            return false; // no mx records..
        }

        foreach ($aMatches as $oValue) {

            if ($bIsValid && !isset($sResponseCode)) {

                // open the connection..
                $oConnection = @fsockopen($oValue, 25, $errno, $errstr, 30);
                $oResponse = @fgets($oConnection);

                if (!$oConnection) {

                    $aConnectionLog['Connection'] = "ERROR";
                    $aConnectionLog['ConnectionResponse'] = $errstr;
                    $bIsValid = false; // unable to connect..
                } else {

                    $aConnectionLog['Connection'] = "SUCCESS";
                    $aConnectionLog['ConnectionResponse'] = $errstr;
                    $bIsValid = true; // so far so good..
                }

                if (!$bIsValid) {

                    if ($bIsDebug)
                        print_r($aConnectionLog);
                    return false;
                }

                // say hello to the server..
                fputs($oConnection, "HELO $sFromDomain\r\n");
                $oResponse = fgets($oConnection);
                $aConnectionLog['HELO'] = $oResponse;

                // send the email from..
                fputs($oConnection, "MAIL FROM: <$sFromEmail>\r\n");
                $oResponse = fgets($oConnection);
                $aConnectionLog['MailFromResponse'] = $oResponse;

                // send the email to..
                fputs($oConnection, "RCPT TO: <$sToEmail>\r\n");
                $oResponse = fgets($oConnection);
                $aConnectionLog['MailToResponse'] = $oResponse;

                // get the response code..
                $sResponseCode = substr($aConnectionLog['MailToResponse'], 0, 3);
                $sBaseResponseCode = substr($sResponseCode, 0, 1);

                // say goodbye..
                fputs($oConnection, "QUIT\r\n");
                $oResponse = fgets($oConnection);

                // get the quit code and response..
                $aConnectionLog['QuitResponse'] = $oResponse;
                $aConnectionLog['QuitCode'] = substr($oResponse, 0, 3);

                if ($sBaseResponseCode == "5") {
                    $bIsValid = false; // the address is not valid..
                }

                // close the connection..
                @fclose($oConnection);
            }
        }

        if ($bIsDebug == $debug) {
            print_r($aConnectionLog); // output debug info..
        }

        return $bIsValid;
    }

}

?>
