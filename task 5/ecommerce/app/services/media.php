<?php

namespace app\services;

class media
{
    private  $image = [];
    private $errors = [];
    private const MAX_UPLOAD_SIZE = 10 ** 6;
    private const ALLOWED_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    private string $extension;

    public function __construct(array $image)
    {
        $this->image = $image;
    }

    public function validateOnSize(int $size = null)
    {
        $size = $size ?? self::MAX_UPLOAD_SIZE;
        if ($this->image['size'] > $size) {
            $this->errors['size'] = "max upload size " . ($size / 10 ** 6) . " MB";
        }
        return $this;
    }

    public function validateOnExtension(?array $allowedExtensions = null)
    {
        $allowedExtensions = $allowedExtensions ?? self::ALLOWED_EXTENSIONS;
        $this->extension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        if (!in_array($this->extension, $allowedExtensions)) {
            $this->errors['extension'] = "Allowed extension are " . implode(',', $allowedExtensions);
        }
        return $this;
    }

    public function upload(string $directory)
    {
        $photoName = uniqid() . '.' . $this->extension;
        $photoPath = "assets/img/$directory/";
        $fullPath = $photoPath . $photoName;

        if (move_uploaded_file($this->image['tmp_name'], $fullPath)) {
            return $photoName;
        } else {
            return false;
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

            return "<p class='text-danger mt-0'>* {$this->getError($key)}</p>";
        }
    }
}
