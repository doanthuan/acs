<?php
/**
 * Created by PhpStorm.
 * User: doanthuan
 * Date: 3/18/2015
 * Time: 7:14 PM
 */

$ldap_password = 'caogia162';
$ldap_username = 'doanthuan@thuan-PC';
$ldaprdn = 'uid=doanthuan,ou=users,DC=Acs,DC=COM';
$ldaphost = 'localhost';
$ldapport = 50000;                 // your ldap server's port number

// Connecting to LDAP
$ldap_connection = ldap_connect($ldaphost, $ldapport);
if (FALSE === $ldap_connection){
    // Uh-oh, something is wrong...
    echo 'wrong';exit;
}

// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.


if (TRUE === ldap_bind($ldap_connection, $ldaprdn, $ldap_password)){

    $ldap_base_dn = 'CN=Partition1,DC=Acs,DC=COM';
    $search_filter = '(samAccountName=?)';
    $attributes = array();
    $attributes[] = 'givenname';
    $attributes[] = 'mail';
    $attributes[] = 'samaccountname';
    $attributes[] = 'sn';


    try{
        $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter, $attributes);
    }
    catch(Exception $exception){
        print_r($exception);exit;
    }

    if (FALSE !== $result){
        $entries = ldap_get_entries($ldap_connection, $result);
        for ($x=0; $x<$entries['count']; $x++){
            if (!empty($entries[$x]['givenname'][0]) &&
                !empty($entries[$x]['mail'][0]) &&
                !empty($entries[$x]['samaccountname'][0]) &&
                !empty($entries[$x]['sn'][0]) &&
                'Shop' !== $entries[$x]['sn'][0] &&
                'Account' !== $entries[$x]['sn'][0]){
                $ad_users[strtoupper(trim($entries[$x]['samaccountname'][0]))] = array('email' => strtolower(trim($entries[$x]['mail'][0])),'first_name' => trim($entries[$x]['givenname'][0]),'last_name' => trim($entries[$x]['sn'][0]));
            }
        }
    }
    else{
        die("Could not search to LDAP server.");
    }
    ldap_unbind($ldap_connection); // Clean up after ourselves.
}
else{
    die("Could not connect to LDAP server.");
}

$message .= "Retrieved ". count($ad_users) ." Active Directory users\n";