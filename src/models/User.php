<?php


namespace src\models;


use src\framework\Validation;

/**
 * Class User
 * @package src\models
 */
class User
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $first_name;
    /**
     * @var string
     */
    private string $last_name;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $gender;
    /**
     * @var bool
     */
    private bool $is_active;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var string
     */
    private ?string $created_at = null;
    /**
     * @var string
     */
    private ?string $updated_at = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return int
     */
    public function isIsActive(): int
    {
        return $this->is_active;
    }

    /**
     * @param int ( 1 | 0 ) $is_active
     */
    public function setIsActive(int $is_active): void
    {
        $this->is_active = $is_active;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Fastens post query and user model
     * @return User
     */
    public static function mapPostToModel(): User
    {

        // Creation/Update date
        $date = date('Y-m-d H:i:s');
        $user = new self();
        $user->setFirstName(Validation::cleanInput($_POST['inputFirstName']));
        $user->setLastName(Validation::cleanInput($_POST['inputLastName']));
        $user->setEmail(Validation::cleanInput($_POST['inputEmailAddress']));
        $user->setPassword(Validation::cleanInput($_POST['inputPassword']));
        $user->setGender(Validation::cleanInput($_POST['inputGender']));
        $user->setIsActive(1);
        $user->setCreatedAt($date);
        $user->setUpdatedAt($date);

        return $user;
    }

}
