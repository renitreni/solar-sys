<?php

namespace Firebase\Storage;

use Illuminate\Support\Facades\Cache;
use Kreait\Firebase\Factory;

class ServiceStorage
{
    public $bucket;

    public $filename;

    public function __construct()
    {
        $storage = (new Factory)
            ->withServiceAccount(storage_path() . '/../.firebase-creds.json')
            ->createStorage();

        $this->bucket = $storage->getBucket();
    }

    public function upload($file)
    {
        $this->filename = now() . '-#-' . $file->getClientOriginalName();
        $this->bucket->upload(file_get_contents($file->getPathname()), ['name' => $this->filename]);

        return $this;
    }

    public function getInfo()
    {
        return $this->bucket->info();
    }

    public function getItem($filename = null)
    {
        return $this->bucket->object($filename ?? $this->filename);
    }

    public function getList()
    {
        $result = [];
        foreach ($this->bucket->objects() as $object) {
            $result[] = $object->name();
        }

        return $result;
    }

    public function delete(string $objectName)
    {
        $this->bucket->object($objectName)->delete();
    }

    public function getSignedUrl(string $objectName)
    {
        return Cache::remember('getSignedUrl' . $objectName, now()->addDay(), function () use ($objectName) {
            return $this->bucket->object($objectName)->signedUrl(now()->addDay(), ['version' => 'v4',]);
        });
    }
}
