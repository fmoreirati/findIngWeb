<?php
class ApiCore
{
    public $nameFind = "";
    public $listResults = array();

    function findGoogle($quest, $quantResult = 10)
    {
        $url = 'https://www.google.com/search?q=' . $quest . '&safe=active&psw=0&num=' . $quantResult . '&sourceid=chrome&ie=UTF-8&filter=0&as_lq';

        $this->nameFind = $quest;
        $results = array();

        try {
            if (!$html = $this->get_cURL($url))
                $html = $this->get_FileURL($url);
    
            if (!empty($html)) {
                $html_doc = new DOMDocument('', 'UTF-8');
                libxml_use_internal_errors(TRUE);
                $html_doc->loadHTML($html);
                libxml_clear_errors();
                $html_xpath = new DOMXPath($html_doc);

                $html_row = $html_xpath->query("//div[@id='main']/div/div/div/a");

                if ($html_row->length > 0) {
                    foreach ($html_row as $row) {
                        $name = $row->firstChild->nodeValue;
                        $link = "";
                        $textLinkGoogle = urldecode($row->getAttribute("href"));

                        if (!strpos($textLinkGoogle, 'google.com')) {
                            $link = strstr(strstr($textLinkGoogle, '&', true), 'http');
                            if ($link && $name) {
                                array_push($results, array(
                                    "name" => $name,
                                    "link" => $link,
                                    //"linkGoogleFull" => $textLinkGoogle,
                                    //"linkFull" => $row->lastChild->nodeValue,
                                    //"TextFull" => $row->nodeValue,
                                ));
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception("ERROR - Montar dados de retorno:" . $e->getMessage(), 2);
        }

        return $this->listResults = json_encode(array_values($results));
    }

    //Pega site de url especifica em formato: HTML
    function get_cURL($url)
    {
        $html = "";
        $ch = curl_init();
        try {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, false);
            $html = curl_exec($ch);
        } catch (Exception $e) {
            throw new Exception("ERROR - Captura de dados (cURL):" . $e->getMessage() . " *** cURL *** " .  curl_error($ch), 1);
        } finally {
            curl_close($ch);
        }
        return $html;
    }


    function get_FileURL($url)
    {
        $html = "";
        try {
            $config = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $context = stream_context_create($config);
            $html = file_get_contents($url, false, $context);
        } catch (Exception $e) {
            throw new Exception("ERROR - Captura de dados (FileGet):" . $e->getMessage(), 1);
        }
        return $html;
    }
}