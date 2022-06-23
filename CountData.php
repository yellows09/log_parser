<?php
include 'constants.php';

class CountData
{
    protected $file;

    /**
     * Log file initialization. Can be change in constants.php file
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Counting views
     * @return int
     */
    public function countViews(): int
    {
        return substr_count($this->file, NEW_LINE);
    }

    /**
     * Counting unique urls
     * @return int
     */
    public function countUniqueURL(): int
    {
        preg_match_all(FIND_URL, $this->file, $matches);
        $uniqueUrl = count(array_unique($matches[0]));
        return $uniqueUrl;
    }

    /**
     * Count crawlers. Crawlers can be passed when calling a function
     * @param array $crawlers
     * @return array
     */
    public function countCrawlers(array $crawlers): array
    {
        $results = [];
        $count = 0;
        foreach ($crawlers as $crawler) {
            $results[$crawler] = substr_count($this->file, $crawler);
            $count++;
        }
        return $results;
    }

    /**
     * @return int|mixed
     */
    public function countTraffic()
    {
        $traffic = 0;
        preg_match_all(FIND_TRAFFIC, $this->file, $matches);
        foreach ($matches[0] as $match) {
            $withoutQuotesAtTheBeginning = mb_substr($match, 6);
            preg_match_all(FIND_TRAFFIC_WITHOUT_QUOTES,$withoutQuotesAtTheBeginning,$withoutQuotesAtTheEnd);
            foreach($withoutQuotesAtTheEnd as $item=>$value){
                foreach ($value as $key){
                    $traffic += $key;
                }
            }
        }
        return $traffic;
    }

    /**
     * Status codes counting. Codes can be passed when calling a function
     * @param array $statusCode
     * @return array
     */
    public function countStatusCodes(array $statusCode): array
    {
        $codesResult = [];
        $codes = [];
        $count = 0;
        foreach ($statusCode as $status) {
            $codes[] = " $status ";
        }
        foreach ($codes as $code) {
            $codesResult[$code] = substr_count($this->file, $code);
            $count++;
        }
        return $codesResult;
    }


    /**
     * @param int $views
     * @param int $urls
     * @param int $countTraffic
     * @param array $crawlers
     * @param array $statusCodes
     * @return false|string
     */
    public function toJson(int $views, int $urls, int $countTraffic, array $crawlers, array $statusCodes)
    {
        $array = ["Views" => $views, "urls" => $urls, "traffic" => $countTraffic,"Crawlers" => $crawlers, "statusCodes" => $statusCodes];
        return json_encode($array, JSON_PRETTY_PRINT);
    }
}