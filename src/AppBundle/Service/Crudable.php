<?php

namespace AppBundle\Service;


use AppBundle\AppBundle;
use AppBundle\Entity\Image;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class Crudable
{
    /** @var EntityManager $em */
    protected $em;

    /** @var  ImageUploader $uploader */
    protected $uploader;

    /** @var ContainerInterface $container */
    protected $container;

    /** @var TokenStorage $tokenStorage */
    protected $tokenStorage;

    /** @var Finder $finder */
    protected $finder;

    protected $data;

    protected $object;

    protected $photos;

    protected $uploadDir;


    /**
     * Crudable constructor.
     * @param EntityManager $entityManager
     * @param ImageUploader $uploader
     * @param TokenStorage $tokenStorage
     * @param Finder $finder
     */
    public function __construct(EntityManager $entityManager, ImageUploader $uploader, TokenStorage $tokenStorage, ContainerInterface $container, Finder $finder)
    {
        $this->em = $entityManager;
        $this->uploader = $uploader;
        $this->tokenStorage = $tokenStorage;
        $this->container = $container;
        $this->finder = $finder;
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
    public function save()
    {

        /** @var bool $tm */
        $tm = null;

        $data = $this->getData();


        $this->em->persist($data);

        if ($this->getPhotos()) {

            $tm = $this->transactionManager($this->getUploadDir(), $data);

            if (!$tm) {
                return false;
            }
        }

        $this->em->flush();

        return $data->getId();
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
     * @return bool
     */
    public function restore() {

        $this->getData()->setDateRemoved(null);

        $this->em->flush();

        return true;
    }

    /**
     * @return bool|string
     */
    public function deleteFile() {

        $data = $this->getData();

        $fileName = $data->getName();

        $dir = $this->container->getParameter('upload_directory');

        $this->finder->name($fileName);

        foreach ($this->finder->in($dir) as $item) {
            unlink($item);
        }

        $this->em->remove($data);

        try {
            $this->em->flush();
            return true;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param $uploadDir
     * @param $data
     * @return bool
     */
    private function transactionManager($uploadDir, $data) {

        $images = null;

        $this->em->persist($data);

        /*BEGIN TRANSACTION IF ENTITY HAS OBJECTS*/
        $this->em->getConnection()->beginTransaction();

        try {

            $this->em->flush();

            if (!isset($this->getPhotos()['name'])) {
                foreach ($this->getPhotos() as $photo) {
                    $images = $this->photoUploader($photo, $uploadDir, $data->getId());
                }
            } else {
                $images = $this->photoUploader($this->getPhotos(), $uploadDir, $data->getId());
            }

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