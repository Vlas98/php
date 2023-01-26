<?php 

class AuthGateway{

    public string|null $user = null;

    public function __construct(private array $cookie){
        if(isset($cookie['user'])){
            $this->user = $cookie['user'];
        }
    }

    public function getUser(): string {
        return $this->user;
    }

    public function isAuth(): bool
    {
        return (bool)$this->user;
    }

}