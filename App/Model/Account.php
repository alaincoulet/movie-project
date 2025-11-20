<?php 

namespace App\Model;

use App\Model\Grant;
use App\Model\Movie;

class Account
{
    //Attributs
    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $password;
    private ?Grant $grant;
    private array $movies;
    
    //Constructeur
    public function __construct()
    {
        $this->movies = [];
    }

    //Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getGrant(): ?Grant
    {
        return $this->grant;
    }

    public function setGrant(?Grant $grant): void
    {
        $this->grant = $grant;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }

    public function addCategory(Movie $movie): void
    {
        $this->movies[] = $movie;
    }

    public function removeCategory(Movie $movie): void
    {
        unset($this->movies[array_search($movie, $this->movies)]);
        sort($this->movies);
    }
}