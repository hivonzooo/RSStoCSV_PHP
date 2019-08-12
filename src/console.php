<?PHP
    //Testowe RSS: 
    //https://makitweb.com/feed/ 
    //http://feeds.nationalgeographic.com/ng/News/News_Main
    //https://feeds.feedburner.com/dobreprogramy/Aktualnosci

    foreach($argv as $input)
    {
        //echo "$input\n";
    }

    if ($argv[1] == "csv:simple") {
        $content = file_get_contents($argv[2]);
        $file = fopen($argv[3], "w") or die("Unable to open file!");

    }

    elseif ($argv[1] == "csv:extended") {
        $content = file_get_contents($argv[2]);
        $file = fopen($argv[3], "a+") or die("Unable to open file!");
    }

    else {
        echo "Error: wrong arguments";
    }

    $xml = simplexml_load_string($content) or die("Error: Cannot create object");
    foreach ($xml->channel->item as $item) {

        $title = $item->title;
        $desc = $item->description;
        $link = $item->link;
        $pub = $item->pubDate;
        $author = $item->author;

        $fields = array($title, $desc, $link, $pub, $author);

        fputcsv($file, $fields);
    }
    fclose($file);

?>