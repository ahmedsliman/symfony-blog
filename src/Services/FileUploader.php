<?php

namespace App\Services;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function uploadFile(UploadedFile $file)
    {
        $filename = md5(uniqid()) . '.' . $file->getClientOriginalExtension();

        $file->move(
            $this->container->getParameter('uploads_dir'),
            $filename
        );

        return $filename;
    }
}