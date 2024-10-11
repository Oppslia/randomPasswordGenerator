<?php
function randPassBetter($passLength){
    function randInt($length){
        global $allChars;
        $randomINT = mt_rand(0, $length);
        return $randomINT; 
    }
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $specialChars = '!@#$%^&*()-_+=<>?';

    $allChars = $uppercase . $lowercase . $numbers . $specialChars;
    
    $allCharsArray = str_split($allChars);
    $shuffledChars = $allCharsArray;
    shuffle($shuffledChars);
    $passwordStr = '';
    while (strlen($passwordStr) < $passLength){
        $passwordStr .= implode(array_slice($shuffledChars, mt_rand(0, count($shuffledChars)-1), 1));
    }
    $password = str_split($passwordStr);
    $specialCharCounter = 0;
    $passwordNormalCharIndexs = array();
    foreach ($password as $index => $value){
        if (in_array($value,str_split($specialChars))){
            $specialCharCounter ++; // counts how many special chars are in the password
            }
        else{
        $passwordNormalCharIndexs[] = $index;} //to prevent overwriting existing special chars
        }
        
    while ($specialCharCounter < 4){
        $randIndex = mt_rand(0,count($passwordNormalCharIndexs)-1); //Finds a random index in the NON special chars 
        $password[$passwordNormalCharIndexs[$randIndex]] = str_split($specialChars)[mt_rand(0,(strlen($specialChars)-1))];
        // looks in current password for the value specified by the random index of the nonSpecial characters
        // For example : a$%he9%8djsr  
        // $passwordNormalCharIndexes = a,h,e,9,8,d,j,s,r if the random index in that range is 2 then e.
        // password[e] = specialchars[random number within range of array]
        // unset the $passwordNormalCharIndexes e so that it can't be overwritten again
        // reindex the array

        unset($passwordNormalCharIndexs[$randIndex]); //Removes index from the 
        $passwordNormalCharIndexs = array_values($passwordNormalCharIndexs); //reindex the array after unsetting to avoid gaps
        $specialCharCounter ++;
    }   
         return implode($password);
            }

print("\n" . randPassBetter(12));
?>

