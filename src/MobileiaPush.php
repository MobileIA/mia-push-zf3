<?php

namespace MIAPush;

/**
 * Description of MobileiaPush
 *
 * @author matiascamiletti
 */
class MobileiaPush 
{
    const BASE_URL = 'http://push.mobileia.com:8080';
    
    /**
     *
     * @var string
     */
    public $appId = '';
    /**
     *
     * @var string
     */
    public $appSecret = '';
    /**
     *
     * @var \ElephantIO\Client
     */
    public $elephant = null;
    /**
     * 
     * @param string $appId
     * @param string $appSecret
     */
    public function __construct($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }
    /**
     * 
     * @param array $users listado de IDs de los usuarios a los que se desea enviar
     * @param string $event
     * @param array $params
     */
    public function send($users = array(), $event = '', $params = array())
    {
        $this->getElephant()->initialize();
        $this->getElephant()->emit('miapush_send', array(
            'sockets' => $users,
            'event' => $event,
            'message' => $params
        ));
        $this->getElephant()->close();
    }
    /**
     * 
     * @return \ElephantIO\Client
     */
    public function getElephant()
    {
        if($this->elephant === null){
            $this->elephant = new \ElephantIO\Client(new \ElephantIO\Engine\SocketIO\Version2X($this->getProcessUrl()));
        }
        return $this->elephant;
    }
    /**
     * 
     * @return string
     */
    protected function getProcessUrl()
    {
        return self::BASE_URL . '/socket.io/?appId=' . $this->appId . '&appSecret=' . $this->appSecret;
    }
}