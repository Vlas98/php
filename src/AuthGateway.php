<?php 

include_once APP_PATH . '/src/models/UserModel.php'; // подключаем файл класса авторизации (файл для работы с юзерами)

class AuthGateway{

    // описываем класс
    private array|null $user = null;
    private UserModel|null $_userModel = null;

    public function __construct(array $cookie){ //конструкор класса (??) узнать про приватность массива
        if(isset($cookie['user'])){ //если в куках хранится имя пользователя
            // [login=> string, password =>string...]
            $this->user = $this->getUsersModel()->find('login', $cookie['user']); //запрашиваем информацию(массив) информацтт о пользователе, отправляя имя пользователя
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
     авторизовывает пользователя, сохраняя логин в куки.
     */
    public function auth(string $name): void
    {
        setcookie("user", $name);
        header('location: /');
       die;
    }

    /**
      возвращает true\false является ли пользователь админом.
     */
    public function isAdmin():bool
    {
        return $this->getUser()['role'] === 'admin';
    }
 
    private function getUsersModel(): UserModel //приватная функция, которая возвращает класс, который содержит информацию о пользователе (пользователях)
    {
        if($this->_userModel === null){ // если есть информация о пользователе
            $this->_userModel = new UserModel; // создаем новый экземпляр класса
        }

        return $this->_userModel;// возвращаем экземпляр класса пользователя
    }



}

