<?php

namespace WebsiteBundle\DependencyInjection;


class Converter
{

    private $path;
    private $separator;
    private $header;
    private $data;

    public function __construct(string $path, $separator = "\s")
    {
        $this->path = $path;
        $this->separator = $separator;
    }

    public function convert()
    {
        $sizes = file($this->path);
        $arr = [];
        $data = [];
        for ($i = 0; $i < count($sizes); $i++) {
            $arr[$i] = preg_split('/' . $this->separator . '+/', $sizes[$i]);
        }

        for ($j = 0; $j < count($arr); $j++) {
            $data[] = $arr[$j];
        }

        $firstRow = array_shift($data);
        $this->header = $firstRow;

        $newData = [];
        foreach ($data as $item) {
            $obj = [];
            foreach ($item as $k => $v) {
                if (trim($firstRow[$k])) {
                    $obj[$firstRow[$k]] = $v;
                }
            }
            $newData[] = $obj;
        }
        $this->data = $newData;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHeader()
    {
        return $this->header;
    }


}