<?php namespace ArunSahadeo;

class ProfanityFilter
{

    protected $sourceExists;
    protected $blackListFile;
    protected $blackListedWords = array();

    protected function getBlackList()
    {
        $projectRoot = dirname(__DIR__) . "/";
        $blackListExtensions = array(".csv", ".yaml", ".json", ".yml");

        foreach ($blackListExtensions as $blackListExtension)
        {
            if (file_exists($projectRoot . "blacklisted-words" . $blackListExtension))
            {
                $this->sourceExists = true;
                $this->blackListFile = $projectRoot . "blacklisted-words" . $blackListExtension;
                return;
            }
        }
    }

    protected function parseYAML()
    {
        $yamlFile = yaml_parse($this->blackListFile);
    }

    protected function parseCSV()
    {
        $row = 1;
        $readCSV = fopen($this->blackListFile, "r");
        while (($csvFile = fgetcsv($readCSV, 0, ",")) !== false)
        {
            $num = count(array_filter($csvFile));

            for ( $col = 0; $col < $num; $col++ )
            {
                if (strlen($csvFile[$col]) < 1) continue;

                array_push($this->blackListedWords, $csvFile[$col]);
            }
        }


    }

    public function getParent()
    {
        return dirname(__DIR__);
    }

    public function censorProfanities($string)
    {
        $this->getBlackList();
        if (!$this->sourceExists) return;

        $fileExtension = explode(".", $this->blackListFile);
        
        switch (end($fileExtension))
        {
            case "yaml":
            case "yml":
                $this->parseYAML();    
                break;
            case "csv":
                $this->parseCSV();
                break;
            case "json":
                $this->parseJSON();
                break;
        }

        foreach($this->blackListedWords as $blackListedWord)
        {
            if (stristr($string, $blackListedWord) !== false)
            {
                return str_replace($blackListedWord, "***", $string);
            }
        }

    }
}