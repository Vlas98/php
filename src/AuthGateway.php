<?php 

include_once APP_PATH . '/src/models/UserModel.php';

class AuthGateway{

    private array|null $user = null;
    private UserModel|null $_userModel = null;

    public function __construct(private array $cookie){
        if(isset($cookie['user'])){
            // [login=> string, password =>string...]
            $this->user = $this->getUsersModel()->find('login', $cookie['user']);
        }
    }
    // возращает массив {Login:string, password:string, role:string} текущего юзера
    public function getUser(): array {
        return $this->user;
    }

    /**
     возвращает true\false  статуса авторизованности пользователя
     */
    public function isAuth(): bool 
    {
        return (bool)$this->user;
    }

    /**
     авторизовывает пользователя, сохраняя логин и роль в куки.
     */
    public function auth(string $name, $role): void
    {
        setcookie("user", $name);
        setcookie("role", $role);
        header('location: /');
       die;
    }

    /**
     * возвращает true\false является ли пользователь админом.
     */
    public function isAdmin():bool
    {
        return $this->getUser()['role'] === 'admin';
    }
 
    private function getUsersModel(): UserModel
    {
        if($this->_userModel === null){
            $this->_userModel = new UserModel;
        }

        return $this->_userModel;
    }

}