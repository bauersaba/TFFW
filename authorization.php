<?php

include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
include_once dirname(__FILE__) . '/' . 'components/application.php';
include_once dirname(__FILE__) . '/' . 'components/security/permission_set.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_authentication/table_based_user_authentication.php';
include_once dirname(__FILE__) . '/' . 'components/security/grant_manager/hard_coded_user_grant_manager.php';
include_once dirname(__FILE__) . '/' . 'components/security/table_based_user_manager.php';
include_once dirname(__FILE__) . '/' . 'components/security/user_identity_storage/user_identity_session_storage.php';
include_once dirname(__FILE__) . '/' . 'components/security/recaptcha.php';
include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

$grants = array('guest' => 
        array()
    ,
    'defaultUser' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    ,
    'mbauer' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    ,
    'elima' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    ,
    'super' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    ,
    'aholanda' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    ,
    'ralves' => 
        array('dados' => new PermissionSet(false, false, false, false),
        'endereco' => new PermissionSet(false, false, false, false),
        'pedido' => new PermissionSet(false, false, false, false),
        'produto' => new PermissionSet(false, false, false, false),
        'produto.pedido' => new PermissionSet(false, false, false, false),
        'usuario' => new PermissionSet(false, false, false, false),
        'usuario.dados' => new PermissionSet(false, false, false, false),
        'usuario.pedido' => new PermissionSet(false, false, false, false))
    );

$appGrants = array('guest' => new PermissionSet(false, false, false, false),
    'defaultUser' => new PermissionSet(true, false, false, false),
    'mbauer' => new AdminPermissionSet(),
    'elima' => new AdminPermissionSet(),
    'super' => new PermissionSet(false, true, false, false),
    'aholanda' => new PermissionSet(false, true, false, false),
    'ralves' => new PermissionSet(false, true, false, false));

$dataSourceRecordPermissions = array();

$tableCaptions = array('dados' => 'Dados',
'endereco' => 'Endereco',
'pedido' => 'Pedido',
'produto' => 'Produto',
'produto.pedido' => 'Produto->Pedido',
'usuario' => 'Usuario',
'usuario.dados' => 'Usuario->Dados',
'usuario.pedido' => 'Usuario->Pedido');

$usersTableInfo = array(
    'TableName' => 'usuario',
    'UserId' => 'id',
    'UserName' => 'usuario',
    'Password' => 'senha',
    'Email' => '',
    'UserToken' => '',
    'UserStatus' => ''
);

function EncryptPassword($password, &$result)
{

}

function VerifyPassword($enteredPassword, $encryptedPassword, &$result)
{

}

function BeforeUserRegistration($userName, $email, $password, &$allowRegistration, &$errorMessage)
{

}    

function AfterUserRegistration($userName, $email)
{

}    

function PasswordResetRequest($userName, $email)
{

}

function PasswordResetComplete($userName, $email)
{

}

function VerifyPasswordStrength($password, &$result, &$passwordRuleMessage) 
{

}

function CreatePasswordHasher()
{
    $hasher = CreateHasher('');
    if ($hasher instanceof CustomStringHasher) {
        $hasher->OnEncryptPassword->AddListener('EncryptPassword');
        $hasher->OnVerifyPassword->AddListener('VerifyPassword');
    }
    return $hasher;
}

function CreateGrantManager() 
{
    global $grants;
    global $appGrants;
    
    return new HardCodedUserGrantManager($grants, $appGrants);
}

function CreateTableBasedUserManager() 
{
    global $usersTableInfo;

    $userManager = new TableBasedUserManager(MyPDOConnectionFactory::getInstance(), GetGlobalConnectionOptions(), 
        $usersTableInfo, CreatePasswordHasher(), false);
    $userManager->OnVerifyPasswordStrength->AddListener('VerifyPasswordStrength');

    return $userManager;
}

function GetReCaptcha($formId) 
{
    return null;
}

function SetUpUserAuthorization() 
{
    global $dataSourceRecordPermissions;

    $hasher = CreatePasswordHasher();

    $grantManager = CreateGrantManager();

    $userAuthentication = new TableBasedUserAuthentication(new UserIdentitySessionStorage(), false, $hasher, CreateTableBasedUserManager(), false, false, false);

    GetApplication()->SetUserAuthentication($userAuthentication);
    GetApplication()->SetUserGrantManager($grantManager);
    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}
