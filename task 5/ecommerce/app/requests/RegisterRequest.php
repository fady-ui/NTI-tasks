<?php

namespace app\requests;

use app\models\User;

class RegisterRequest
{
    private $password, $password_confirm, $email, $phone, $errors = [];

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password_confirm
     */
    public function getPassword_confirm()
    {
        return $this->password_confirm;
    }

    /**
     * Set the value of password_confirm
     *
     * @return  self
     */
    public function setPassword_confirm($password_confirm)
    {
        $this->password_confirm = $password_confirm;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    //password
    public function passwordValidation($regularExpressionMessage = "Minimum 8 and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character")
    {
        if (empty($this->password)) {
            $this->errors['password']['required'] = "password is required";
        } else {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', $this->password)) {
                $this->errors['password']['regx'] = $regularExpressionMessage;
            }
        }
    }

    //password confirmation
    public function passwordConfirmValidation()
    {
        if (empty($this->password_confirm)) {
            $this->errors['password_confirm']['required'] = "password confirmation is required";
        } else {
            if ($this->password !== $this->password_confirm) {
                $this->errors['password_confirm']['confirmed'] = "password confirmation must equal password";
            }
        }
    }

    //email
    public function emailValidation($uniqueRule = true)
    {
        if (empty($this->email)) {
            $this->errors['email']['required'] = "email is required";
        } else {
            if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $this->email)) {
                $this->errors['email']['regx'] = "email invalid";
            } else {
                if ($uniqueRule) {
                    $user = new User;
                    $user->setEmail($this->email);
                    $result =  $user->getUserByEmail();
                    if ($result->num_rows >= 1) {
                        $this->errors['email']['unique'] = "email exists";
                    }
                }
            }
        }
    }


    //email
    public function phoneValidation($uniqueRule = true)
    {
        if (empty($this->phone)) {
            $this->errors['phone']['required'] = "phone confirmation is required";
        } else {
            if (!preg_match('//', $this->phone)) {
                $this->errors['phone']['regx'] = "email invalid";
            } else {
                if ($uniqueRule) {
                    $user = new User;
                    $user->setPhone($this->phone);
                    $result =  $user->getUserByPhone();
                    if ($result->num_rows >= 1) {
                        $this->errors['phone']['unique'] = "phone exists";
                    }
                }
            }
        }
    }

    //errors
    public function errors()
    {
        return $this->errors;
    }

    public function getError($key = null)
    {
        return $this->errors[$key] ?? null;
    }

    public function getErrorMessage($key = '')
    {
        if (!empty($this->getError($key))) {
            foreach ($this->getError($key) as $error) {
                return "<p class='text-danger mt-0'>* {$error}</p>";
            }
        }
    }
}
