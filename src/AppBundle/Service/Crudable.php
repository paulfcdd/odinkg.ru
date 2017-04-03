<?php

namespace AppBundle\Service;


use AppBundle\AppBundle;
use AppBundle\Entity\Image;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

class Crudable
{
    /** @var EntityManager $em */
    protected $em;

    /** @var  ImageUploader $uploader */
    protected $uploader;

    protected $data;

    protected $object;

    protected $photos;

    protected $uploadDir;


    /**
     * Crudable constructor.
     * @param EntityManager $entityManager
     * @param ImageUploader $uploader
     */
    public function __construct(EntityManager $entityManager, ImageUploader $uploader)
    {
        $this->em = $entityManager;
        $this->uploader = $uploader;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {

        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return get_class($this->getData());
    }

    /**
     * @param null $photos
     * @return $this
     */
    public function setPhotos($photos = null) {

        $this->photos = $photos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotos() {
        return $this->photos;
    }

    /**
     * @param $uploadDir | null
     * @return $this
     */
    public function setUploadDir($uploadDir = null) {

        $this->uploadDir = $uploadDir;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadDir() {

        return $this->uploadDir;
    }

    /**
     * @return mixed
     */
    public function add()
    {

        $tm = null;

        $data = $this->getData();

        $this->em->persist($data);

        if ($this->getPhotos()) {
            $tm = $this->transactionManager($this->getUploadDir(), $data);
        }

        if (!$tm) {
            return false;
        } else {

            $this->em->flush();

            return $data->getId();
        }
    }


    /**
     * @return bool
     */
    public function delete() {

        $data = $this->getData();

        if ($data->getDateRemoved()) {
            $this->em->remove($data);
        } else {
            $data->setDateRemoved(new \DateTime());
        }

        $this->em->flush();

        return true;
    }

    /**
     * @param $uploadDir
     * @param $data
     * @return bool
     */
    private function transactionManager($uploadDir, $data) {

        $this->em->persist($data);

        /*BEGIN TRANSACTION IF ENTITY HAS OBJECTS*/
        $this->em->getConnection()->beginTransaction();

        try {

            $this->em->flush();

            $images = $this->photoUploader($this->getPhotos(), $uploadDir, $data->getId());

            if ($images) {
                $this->em->getConnection()->commit();
                return true;
            } else {
                $this->em->getConnection()->rollBack();
                return false;
            }


        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param $photo
     * @param $uploadDir
     * @param $foreignKey
     * @return bool|string
     */
    private function photoUploader($photo, $uploadDir, $foreignKey) {

        $fileName = trim(strtolower(str_replace(' ', '_', ($photo['name']))));

        $uploader = $this->uploader
            ->setFileName($fileName)
            ->setFile($photo['file'])
            ->setDir($uploadDir)
            ->upload();

        if ($uploader) {

            $image = new Image();

            $image
                ->setForeignKey($foreignKey)
                ->setEntity($this->getEntity())
                ->setName($fileName . '.' . $photo['file']->getClientOriginalExtension())
                ->setDescription($photo['description'])
                ->setAlt(trim($photo['alt']))
                ->setTitle(trim($photo['title']));

            $this->em->persist($image);
        }

        try {
            $this->em->flush();
            return true;
        } catch (DBALException $exception) {
            return $exception->getMessage();
        }
    }

}