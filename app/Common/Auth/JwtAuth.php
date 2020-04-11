<?php
/**
 * Author jintao.yang
 * User: litblc
 * Date: 2020/4/1
 * Time: 16:33
 */
namespace App\Common\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

/**
 * 单例 一次请求中所有出现使用jwt的地方都是一个用户
 *
 * Class JwtAuth
 * @package App\Common\Auth
 */
class JwtAuth
{

    /**
     * jwt token
     * Author jintao.yang
     * @var
     */
    private $token;

    /**
     * token 颁发者
     * Author jintao.yang
     * @var string
     */
    private $iss = 'api.zscyang.com';

    /**
     * token接收者
     * Author jintao.yang
     * @var string
     */
    private $per = 'blog.zscyang.com';


    /**
     * 用户身份
     * Author jintao.yang
     * @var
     */
    private $uid;


    /**
     * 秘钥
     * Author jintao.yang
     * @var string
     */
    private $secrect = "ABC@@@123456!!!UUJJ$@#886";


    /**
     * 用户上传的token
     * Author jintao.yang
     * @var
     */
    private $decodeToken;




    /**
     * 单例模式 jwtAuth句柄
     * Author jintao.yang
     * @var
     */
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 获取token
     * Author jintao.yang
     * @return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置token
     * Author jintao.yang
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 编码jwt token
     * Author jintao.yang
     * @return $this
     */
    public function encode()
    {
        //token下发时间
        $time = time();
        //加密方式
        $signer = new Sha256();

        $this->token = (new Builder())->issuedBy($this->iss)
            -> permittedFor($this->per)
            -> issuedAt($time)
            -> expiresAt($time + 30)
            -> withClaim('uid', $this->uid)
            -> getToken($signer, new Key($this->secrect));

        return $this;
    }


    /**
     * 解析token
     * Author jintao.yang
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {
        if (!$this->decodeToken) {
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }
        return $this->decodeToken;
    }


    /**
     * 验证秘钥
     * Author jintao.yang
     * @return bool
     */
    public function verify()
    {
        $result = $this->decode()->verify(new Sha256(), $this->secrect);
        return $result;
    }

    /**
     * 验证信息是否被篡改
     * Author jintao.yang
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setIssuer($this->iss);
        $data->setAudience($this->per);
        return $this->decode()->validate($data);
    }
}