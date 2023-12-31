<?php

/**
 * Session class
 *
 * handles the session stuff. creates session when no one exists, sets and gets values, and closes the session
 * properly (=logout). Not to forget the check if the user is logged in or not.
 */
class Session
{
    /**
     * starts the session
     */
    public static function init()
    {
        // if no session exist, start the session
        if (session_id() == '') {
            session_start();
        }
    }

    /**
     * sets a specific value to a specific key of the session
     *
     * @param mixed $key key
     * @param mixed $value value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * gets/returns the value of a specific key of the session
     *
     * @param mixed $key Usually a string, right ?
     * @return mixed the key's value or nothing
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];

            // filter the value for XSS vulnerabilities
            return Filter::XSSFilter($value);
        }
    }

    /**
     * adds a value as a new array element to the key.
     * useful for collecting error messages etc
     *
     * @param mixed $key
     * @param mixed $value
     */
    public static function add($key, $value)
    {
        $_SESSION[$key][] = $value;
    }

    /**
     * deletes the session (= logs the user out)
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * update session id in database
     *
     * @access public
     * @static static method
     * @param  string $userId
     * @param  string $sessionId
     */
    public static function actualizarSessionId($idUsuario, $sessionId = null)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "UPDATE usuarios 
					SET sessionId = :sessionId 
					WHERE idUsuario = :idUsuario
				LIMIT 1";

        $query = $database->prepare($sql);
        $query->execute(array(':sessionId' => $sessionId, ":idUsuario" => $idUsuario));

    }

    /**
     * checks for session concurrency
     *
     * This is done as the following:
     * UserA logs in with his session id('123') and it will be stored in the database.
     * Then, UserB logs in also using the same email and password of UserA from another PC,
     * and also store the session id('456') in the database
     *
     * Now, Whenever UserA performs any action,
     * You then check the session_id() against the last one stored in the database('456'),
     * If they don't match then log both of them out.
     *
     * @access public
     * @static static method
     * @return bool
     * @see Session::updateSessionId()
     * @see http://stackoverflow.com/questions/6126285/php-stop-concurrent-user-logins
     */
    public static function existeSesionConcurrida()
    {
        $sessionId = session_id();
        $idUsuario = Session::get('idUsuario');

        if (isset($idUsuario) && isset($sessionId)) {

            $database = DatabaseFactory::getFactory()->getConnection();
            $sql = "SELECT sessionId 
						FROM usuarios 
						WHERE idUsuario = :idUsuario 
					LIMIT 1";

            $query = $database->prepare($sql);
            $query->execute(array(":idUsuario" => $idUsuario));

            $result = $query->fetch();
            $usuarioSessionId = !empty($result)? $result->sessionId: null;

            return $sessionId !== $usuarioSessionId;
        }

        return false;
    }

    /**
     * Checks if the user is logged in or not
     *
     * @return bool user's login status
     */
    public static function usuarioInicioSesion()
    {
        return (self::get('usuarioInicioSesionAdmin') ? true : false);
    }
}
