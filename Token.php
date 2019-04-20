<?php

require_once ('DAO\UsersDAO.php');

class Token
{
    private static $secret_key = 'aqpXC8uehLkZ1FZAi3oVPqXmuDWMif0l1ViyZtLtQzoqgFujzYaNT8PGz-zvqrnAelde50MAVDK5hNepKSwRyTAu26U7yaL-RpTE5RCGQ5d5wASVqG9MsG6lwM2dcGLrU4JGPjxoqjaB0spOgdY0ul21B_JBzZlpb9ETTw6R7HUJ_46nXDYUZ3PNom_I8Tihurq5nlkyZgB-GLgB2wfdeXe0-2wTmSn4Q8TRpboMJ0ztZEQqJIIkeb0n3tXZypITH7IrQtZE4ZMyl39fTEAojJr-Ijq1-_xr0mvomPwegyWlbLFAiZ8FUxrRg8CjR8QypgSv-dJGN2ITTswdl7FKMQ';

    // Generates a token from a User object.
    public static function generateToken(User $user)
    {
        $header = Token::base64url_encode(json_encode(array('alg' => 'HS256', 'typ' => 'JWT')));
        $payload = Token::base64url_encode($user->getCode());
        $signature = Token::base64url_encode(hash_hmac('sha256', $header . '.' . $payload, Token::$secret_key, true));
        return $header . '.' . $payload . '.' . $signature;
    }

    // Returns false if token is incorrect, a User object otherwise.
    public static function getUserFromToken($header)
    {
        $token = $header['Authentication'];
        if (!isset($token) || $token == "") {
            return false;
        }

        $jwt_values = explode('.', $token);
        $signature = Token::base64url_encode(hash_hmac('sha256', $jwt_values[0] . '.' . $jwt_values[1], Token::$secret_key, true));
        if ($jwt_values[2] != $signature) {
            return false;
        }
//        $user = \Model\UserQuery::create()->findPK(Token::base64url_decode($jwt_values[1]));
        $dao = new UsersDAO();
        $user = $dao->getUserByCode(Token::base64url_decode($jwt_values[1]));
        if ($user != null && $user->getDeletedAt() != null) {
            return false;
        }
        return $user;
    }

    // Encode to base64 in a uri friendly way.
    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    // Decode from uri friendly base64.
    public static function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
    }
}