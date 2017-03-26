<?php

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{

    /** @var EntityManager $em */
    protected $em;

    /** @var string $uploadDirectory */
    protected $uploadDirectory;

    /** @var  UploadedFile $file */
    protected $file;

    /** @var  string $dir */
    protected $dir;

    /** @var  string $fileName */
    protected $fileName;

    /**
     * ImageUploader constructor.
     * @param EntityManager $entityManager
     * @param string $uploadDirectory
     */
    public function __construct(EntityManager $entityManager, string $uploadDirectory)
    {
        $this->em = $entityManager;

        $this->uploadDirectory = $uploadDirectory;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName(string $fileName) {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * @param UploadedFile $file
     * @return $this
     */
    public function setFile(UploadedFile $file) {
        $this->file = $file;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(){
        return $this->file;
    }

    /**
     * @param string $dir
     * @return $this
     */
    public function setDir(string $dir) {
        $this->dir = $dir;

        return $this;
    }

    /**
     * @return string
     */
    public function getDir() {
        return $this->dir;
    }

    /**
     * @return bool
     */
    public function upload() {

        $uploadDir = $this->checkUploadDir($this->getDir());

        if (!$uploadDir) {
            die($uploadDir);
        } else {
            $fileName = $this->getFileName().'.'.$this->getFile()->getClientOriginalExtension();

            $this->getFile()->move($uploadDir, $fileName);

            return true;
        }

    }

    /**
     * @param $uploadDir
     * @return bool|null|string
     */
    private function checkUploadDir($uploadDir) {

        $path = $this->uploadDirectory.'/'.$uploadDir;

        if (!is_dir($path)) {
            try {
                mkdir($path);
                return $path;
            } catch (\Exception $exception) {
                 return $exception->getMessage();
            }
        } else {
            return $path;
        }
    }

}