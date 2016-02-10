<?php

final class SessionModel implements \Iterator, \ArrayAccess, \Countable
{

    protected static $_instance = null;

    /**
     * @var array
     */
    protected $_session;

    /**
     * @var bool
     */
    protected $_started = true;

    /**
     * @link http://www.php.net/manual/en/yaf-session.construct.php
     */
    private function __construct()
    {
        $redis = new redisSessionHandlerModel();
        session_set_save_handler($redis, true);
        session_start();
        $this->_session = $_SESSION;
    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.clone.php
     */
    private function __clone()
    {

    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.sleep.php
     */
    private function __sleep()
    {

    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.wakeup.php
     */
    private function __wakeup()
    {

    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.getinstance.php
     *
     * @return \Yaf\Session
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.start.php
     *
     * @return \Yaf\Session
     */
    public function start()
    {

    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.get.php
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name)
    {
        return $this->_session[$name];
    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.has.php
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {

        return (isset($this->_session[$name]));
    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.set.php
     *
     * @param string $name
     * @param mixed $value
     *
     * @return bool|\Yaf\Session return FALSE on failure
     */
    public function set($name, $value)
    {
        $this->_session[$name] = $value;
        $_SESSION = $this->_session;
    }

    /**
     * @link http://www.php.net/manual/en/yaf-session.del.php
     *
     * @param string $name
     *
     * @return bool|\Yaf\Session return FALSE on failure
     */
    public function del($name)
    {
        unset($this->_session[$name]);
        $_SESSION = $this->_session;
    }

    /**
     * @see \Countable::count
     */
    public function count()
    {

    }

    /**
     * @see \Iterator::rewind
     */
    public function rewind()
    {

    }

    /**
     * @see \Iterator::current
     */
    public function current()
    {

    }

    /**
     * @see \Iterator::next
     */
    public function next()
    {

    }

    /**
     * @see \Iterator::valid
     */
    public function valid()
    {

    }

    /**
     * @see \Iterator::key
     */
    public function key()
    {

    }

    /**
     * @see \ArrayAccess::offsetUnset
     */
    public function offsetUnset($name)
    {

    }

    /**
     * @see \ArrayAccess::offsetGet
     */
    public function offsetGet($name)
    {

    }

    /**
     * @see \ArrayAccess::offsetExists
     */
    public function offsetExists($name)
    {

    }

    /**
     * @see \ArrayAccess::offsetSet
     */
    public function offsetSet($name, $value)
    {

    }

    /**
     * @see \Yaf\Session::get()
     */
    public function __get($name)
    {

        return $this->get($name);
    }

    /**
     * @see \Yaf\Session::has()
     */
    public function __isset($name)
    {
        return $this->has($name);
    }

    /**
     * @see \Yaf\Session::set()
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @see \Yaf\Session::del()
     */
    public function __unset($name)
    {
        $this->del($name);
    }

    public function destroy()
    {
        $redis = new redisSessionHandlerModel();
        $redis->destroy(session_id());
    }

    public function update()
    {
        $pdo = new PDOModel();

        $result = $pdo->query("SELECT * FROM `User` WHERE id = {$pdo->quote($this->me['id'])}")->fetch(PDO::FETCH_ASSOC);
        $result['extra'] = json_decode($result['extra']);

        $this->me = $result;
    }

}
