<?php

namespace App\Core\Utils;

class FileUpload
{
    protected $key;

    protected $attribute = 'error';

    public function __construct($key)
    {
        $this->key = $key;
    }

    protected function getOriginalFiles()
    {
        if( isset( $_FILES[$this->key] ) ) {
            return $_FILES[$this->key];
        }
    }

    protected function prepareArrayFiles()
    {
        $min = 0;
        $files = [];
        $max = $this->getCountTotalOfFiles()-1;

        foreach( range($min, $max) as $range ) {
            $files[] = [];
        }

        return $files;
    }

    public function getFilesUploads()
    {
        $arrayOfFiles = [];
        if( $this->isMultipleFileUploaded() ) {
            $arrayOfFiles = $this->getFiles();
        } elseif ( $this->isSingleFileUploaded() ) {
            $arrayOfFiles = $this->getOriginalFiles();
        } 

        return $arrayOfFiles;
    }

    public function getCountTotalOfFiles()
    {
        $key = 'error';
        $totalOfFile = 0;
        $files = $this->getOriginalFiles();

        if( $this->isMultipleFileUploaded() ) {
            foreach($files[$key] as $error) {
                if( $error != UPLOAD_ERR_NO_FILE ) {
                    $totalOfFile++;
                }
            }
        } elseif( $this->isSingleFileUploaded() ) {
            if( $files[$key] != UPLOAD_ERR_NO_FILE ) {
                $totalOfFile = 1;
            }
        }

        return $totalOfFile;
    }

    protected function getFiles()
    {
        $arrayOfFiles = $this->prepareArrayFiles();
        $arrayOfFilesOriginal = $this->getOriginalFiles();

        foreach($arrayOfFilesOriginal as $key => $error) {
            $index = 0;
            foreach($arrayOfFilesOriginal[$key] as $value) {
                $arrayOfFiles[$index++][$key] = $value;
            }
        }

        return $arrayOfFiles;
    }

    public function isMultipleFileUploaded()
    {
        $key = $this->attribute;
        $files = $this->getOriginalFiles();

        return isset($files[$key]) && is_array($files[$key]);
    }

    public function isSingleFileUploaded()
    {
        $key = $this->attribute;
        $files = $this->getOriginalFiles();

        return isset($files[$key]) && !$this->isMultipleFileUploaded();
    }
    
    public function moveToDirectory($directory)
    {
        $moved = [];
        $files = $this->getFilesUploads();
        if( $this->isSingleFileUploaded() ) {
            $moved = move_uploaded_file ( 
                $files['tmp_name'], "{$directory}/{$files['name']}"
            );
        } elseif ( $this->isMultipleFileUploaded() ) {
            foreach($files as $file) {
                $moved[] = move_uploaded_file (
                    $file['tmp_name'], "{$directory}/{$file['name']}"
                );
            }
        }
        return $moved;
    }
}
