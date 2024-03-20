<?php

namespace Dto;

/**
 * Dto object for work with parsed file path information
 */
class FilePathInfoDto
{
    /**
     * @var string
     */
    private string $dirname;

    /**
     * @var string
     */
    private string $basename;

    /**
     * @var string
     */
    private string $extension;

    /**
     * @var string
     */
    private string $filename;

    /**
     * @param string $dirname
     * @param string $basename
     * @param string $extension
     * @param string $filename
     */
    public function __construct(
        string $dirname = '',
        string $basename = '',
        string $extension = '',
        string $filename = ''
    )
    {
        $this->dirname = $dirname;
        $this->basename = $basename;
        $this->extension = $extension;
        $this->filename = $filename;
    }

    /**
     * @param array $pathInfo
     *
     * @return FilePathInfoDto
     */
    public static function createFromArray(array $pathInfo): self
    {
        return (new self)
            ->setBasename($pathInfo['basename'] ?? '')
            ->setDirname($pathInfo['dirname'] ?? '')
            ->setExtension($pathInfo['extension'] ?? '')
            ->setFilename($pathInfo['filename'] ?? '');
    }

    /**
     * @return string
     */
    public function getPathAsString(): string
    {
        return $this->getDirname().'/'.$this->getFilename().'.'.$this->getExtension();
    }

    /**
     * @return string
     */
    public function getDirname(): string
    {
        return $this->dirname;
    }

    /**
     * @param string $dirname
     *
     * @return FilePathInfoDto
     */
    public function setDirname(string $dirname): FilePathInfoDto
    {
        $this->dirname = $dirname;
        return $this;
    }

    /**
     * @return string
     * @psalm-suppress PossiblyUnusedMethod
     */
    public function getBasename(): string
    {
        return $this->basename;
    }

    /**
     * @param string $basename
     *
     * @return FilePathInfoDto
     */
    public function setBasename(string $basename): FilePathInfoDto
    {
        $this->basename = $basename;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     *
     * @return FilePathInfoDto
     */
    public function setExtension(string $extension): FilePathInfoDto
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     *
     * @return FilePathInfoDto
     */
    public function setFilename(string $filename): FilePathInfoDto
    {
        $this->filename = $filename;
        return $this;
    }
}