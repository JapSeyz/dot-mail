<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-mail
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
 */

namespace Dot\Mail\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class AttachmentsOptions
 * @package Dot\Mail\Options
 */
class AttachmentsOptions extends AbstractOptions
{
    const DEFAULT_ITERATE = false;
    const DEFAULT_PATH = 'data/mail/attachments';
    const DEFAULT_RECURSIVE = false;

    /** @var array */
    protected $files = [];

    /** @var array */
    protected $dir = [
        'iterate' => self::DEFAULT_ITERATE,
        'path' => self::DEFAULT_PATH,
        'recursive' => self::DEFAULT_RECURSIVE,
    ];

    /**
     * @return array
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param array $dir
     * @return $this
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this->normalizeDirArray();
    }

    /**
     * Makes sure dir array has default properties at least
     * @return $this
     */
    protected function normalizeDirArray()
    {
        if (!isset($this->dir['iterate'])) {
            $this->dir['iterate'] = self::DEFAULT_ITERATE;
        }
        if (!isset($this->dir['path'])) {
            $this->dir['path'] = self::DEFAULT_PATH;
        }
        if (!isset($this->dir['recursive'])) {
            $this->dir['recursive'] = self::DEFAULT_RECURSIVE;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param array $files
     * @return $this
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
        return $this;
    }

    /**
     * @param $filePath
     * @return $this
     */
    public function addFile($filePath)
    {
        $this->files[] = $filePath;
        return $this;
    }

    /**
     * @param array $files
     * @return $this
     */
    public function addFiles(array $files)
    {
        return $this->setFiles(array_merge($this->files, $files));
    }
}
