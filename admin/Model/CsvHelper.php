<?php
namespace utilities;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Goodby\CSV\Export\Standard\CsvFileObject;
use Goodby\CSV\Export\Standard\Exporter;

/**
 * Class CsvHelper
 * @author thond
 */
class CsvHelper
{
    /**
     * parseCsvFile
     *
     * @param $file
     * @param $use_header
     * @return array $cv
     */
    public static function parseCsvFile($file, $use_header = false)
    {
        ini_set('memory_limit', '-1');
        // the result comes into this variable
        $cv = array();
        // set up lexer
        $config = new LexerConfig();
        $config
            ->setFromCharset('UTF-8')
            ->setToCharset('UTF-8');
        if ($use_header) {
            $config->setIgnoreHeaderLine(false);
        } else {
            $config->setIgnoreHeaderLine(true);
        }
        $lexer = new Lexer($config);
        // set up interpreter
        $interpreter = new Interpreter();
        $interpreter->unstrict(); // Ignore row column count consistency
        $interpreter->addObserver(
            function (array $row) use (&$cv) {
                $cv[] = array($row);
            }
        );
        // parse
        $lexer->parse($file, $interpreter);
        $final_array = array();
        foreach ($cv as $k => $v) {
            if (count($v[0]) != 1) {
                array_push($final_array, $v[0]);
            }
        }

        // Create an array of associative arrays with the first row column headers as the keys
        if ($use_header) {
            array_walk(
                $final_array,
                function (&$a) use ($final_array) {
                    $a = array_combine($final_array[0], $a);
                }
            );
        }

        return $final_array;
    }

    /**
     * parseTsvFile
     *
     * @param $file
     * @param $use_header
     * @param $encoding_from
     * @param $encoding_to
     * @return array $cv
     */
    public static function parseTsvFile($file, $use_header = false, $encoding_from = 'UTF-8', $encoding_to = 'UTF-8')
    {
        ini_set('memory_limit', '-1');

        $csv = new \parseCSV();
        $csv->encoding($encoding_from, $encoding_to);
        $csv->delimiter = "\t";
        $csv->heading = false;
        $csv->parse($file);

        $final_array = $csv->data;

        // Create an array of associative arrays with the first row column headers as the keys
        if ($use_header) {
            $header = array();
            $index = 1;
            foreach ($final_array[0] as $key => $value) {
                if (isset($header[$value])) {
                    $final_array[0][$key] = $value . $index;
                    $index++;
                } else {
                    $header[$value] = $value;
                }
            }
            array_walk(
                $final_array,
                function (&$a) use ($final_array) {
                    $a = array_combine($final_array[0], $a);
                }
            );
        }

        return $final_array;
    }

    /**
     * parseCsvFileWithTabContent
     *
     * @param $file
     * @param $use_header
     * @return array $cv
     */
    public static function parseCsvFileWithTabContent($file, $use_header = false)
    {
        ini_set('memory_limit', '-1');

        $csv = new \parseCSV();
        $csv->encoding('UTF-16', 'UTF-8');
        $csv->delimiter = "\t";
        $csv->heading = false;
        $csv->parse($file);

        $final_array = $csv->data;

        // Create an array of associative arrays with the first row column headers as the keys
        if ($use_header) {
            $header = array();
            $index = 1;
            foreach ($final_array[0] as $key => $value) {
                if (isset($header[$value])) {
                    $final_array[0][$key] = $value . $index;
                    $index++;
                } else {
                    $header[$value] = $value;
                }
            }
            array_walk(
                $final_array,
                function (&$a) use ($final_array) {
                    $a = array_combine($final_array[0], $a);
                }
            );
        }

        return $final_array;
    }

    /**
     * @param $output
     * @param $file_name
     */
    public static function exportCsv($output, $file_name)
    {
        $config = new ExporterConfig();
        $config
            //->setDelimiter("\t")
            //->setEnclosure("")
            ->setEscape("\\")
            ->setToCharset('SJIS-win')
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);
        $exporter = new Exporter($config);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        $exporter->unstrict(); // Disable strict mode
        $exporter->export('php://output', $output);
    }

    /**
     * @param $file
     * @param bool $use_header
     * @return array
     */
    public static function parseCsvFileStrictMode($file, $use_header = true)
    {
        // the result comes into this variable
        $cv = array();
        // set up lexer
        $config = new LexerConfig();
        $config
            ->setFromCharset('UTF-8')
            ->setToCharset('UTF-8');
        if ($use_header) {
            $config->setIgnoreHeaderLine(true);
        } else {
            $config->setIgnoreHeaderLine(false);
        }
        $lexer = new Lexer($config);
        // set up interpreter
        $interpreter = new Interpreter();
        $interpreter->addObserver(
            function (array $row) use (&$cv) {
                $cv[] = array($row);
            }
        );
        // parse
        $lexer->parse($file, $interpreter);
        $final_array = array();
        foreach ($cv as $k => $v) {
            if (count($v[0]) != 1) {
                array_push($final_array, $v[0]);
            }
        }
        return $final_array;
    }

    /**
     * @param $file
     * @param bool $use_header
     * @param string $from_charset
     * @param bool $un_strict
     * @return array
     */
    public static function parseCsvFileStrictModeForAdCsv(
        $file,
        $use_header = false,
        $from_charset = "UTF-8",
        $un_strict = false
    ) {
        // set un-limit memory due to big file CSV if have
        ini_set('memory_limit', '-1');
        // the result comes into this variable
        $cv = array();
        // set up lexer
        $config = new LexerConfig();
        $config
            ->setFromCharset($from_charset)
            ->setToCharset('UTF-8');
        if ($use_header) {
            $config->setIgnoreHeaderLine(false);
        } else {
            $config->setIgnoreHeaderLine(true);
        }
        $lexer = new Lexer($config);
        // set up interpreter
        $interpreter = new Interpreter();
        if ($un_strict) {
            // Ignore row column count consistency
            $interpreter->unstrict();
        }
        $interpreter->addObserver(
            function (array $row) use (&$cv) {
                $cv[] = array($row);
            }
        );
        // parse
        $lexer->parse($file, $interpreter);
        $final_array = array();
        foreach ($cv as $k => $v) {
            if (count($v[0]) != 1) {
                array_push($final_array, $v[0]);
            }
        }

        // create an array of associative arrays with the first row column headers as the keys
        // using array_intersect_key to avoid different lengths error
        if ($use_header) {
            array_walk(
                $final_array,
                function (&$a) use ($final_array) {
                    $a = array_combine(
                        array_intersect_key($final_array[0], $a),
                        array_intersect_key($a, $final_array[0])
                    );
                }
            );
        }

        return $final_array;
    }

    /**
     * use to parse csv file with tab delimiter
     *
     * @author: thond
     * @param $file
     * @param bool $use_header
     * @param string $from_charset
     * @param bool $tab_mode
     * @return array
     */
    public static function parseCsvFileUnStrictForAdCsv(
        $file,
        $use_header = false,
        $from_charset = "UTF-8",
        $tab_mode = false
    ) {
        // set un-limit memory due to big file CSV if have
        ini_set('memory_limit', '-1');
        // the result comes into this variable
        $cv = array();
        // set up lexer
        $config = new LexerConfig();
        $config
            ->setFromCharset($from_charset)
            ->setToCharset('UTF-8');

        if ($tab_mode) {
            $config->setDelimiter("\t");
        }

        if ($use_header) {
            $config->setIgnoreHeaderLine(false);
        } else {
            $config->setIgnoreHeaderLine(true);
        }

        $lexer = new Lexer($config);
        // set up interpreter
        $interpreter = new Interpreter();
        // Ignore row column count consistency
        $interpreter->unstrict();
        $interpreter->addObserver(
            function (array $row) use (&$cv) {
                $cv[] = array($row);
            }
        );
        // parse
        $lexer->parse($file, $interpreter);
        $final_array = array();
        foreach ($cv as $k => $v) {
            if (count($v[0]) != 1) {
                array_push($final_array, $v[0]);
            }
        }

        // create an array of associative arrays with the first row column headers as the keys
        // using array_intersect_key to avoid different lengths error
        if ($use_header) {
            array_walk(
                $final_array,
                function (&$a) use ($final_array) {
                    $a = array_combine(
                        array_intersect_key($final_array[0], $a),
                        array_intersect_key($a, $final_array[0])
                    );
                }
            );
        }

        return $final_array;
    }

    /**
     * use to export CSV file to corresponding folder
     *
     * @author tho.nguyen <thond@evolableasia.vn>
     *
     * @param array $output
     * @param $csv_folder
     * @param $file_name
     * @param string $to_charset
     * @param bool $tab_mode
     * @return string
     */
    public static function exportCsvForAdCsv(
        array $output,
        $csv_folder,
        $file_name,
        $to_charset = 'SJISwin',
        $tab_mode = false
    ) {
        $config = new ExporterConfig();

        if ($tab_mode) {
            $config->setDelimiter("\t");
        }

        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);

        if (!file_exists($csv_folder)) {
            mkdir($csv_folder, 0777, true);
        }

        $exporter = new Exporter($config);
        $exporter->unstrict(); // Disable strict mode
        $exporter->export($csv_folder . $file_name, $output);
        return $csv_folder . $file_name;
    }

    /**
     * @param array $output
     * @param $csv_folder
     * @param $file_name
     * @param string $to_charset
     * @return string
     */
    public static function exportCsvForReallocate(
        array $output,
        $csv_folder,
        $file_name,
        $to_charset = 'SJIS'
    ) {
        $config = new ExporterConfig();

        //$config->setDelimiter("\t");

        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);

        if (!file_exists($csv_folder)) {
            mkdir($csv_folder, 0777, true);
        }

        $exporter = new Exporter($config);
        $exporter->unstrict(); // Disable strict mode
        $exporter->export($csv_folder . $file_name, $output);
        return $csv_folder . $file_name;
    }

    /**
     * @param array $output
     * @param $file_name
     * @param string $to_charset
     * @return string
     */
    public static function exportCsvForAbcdAnalysis(array $output, $file_name, $to_charset = 'SJIS')
    {
        $config = new ExporterConfig();
        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);
        $exporter = new Exporter($config);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        $exporter->unstrict(); // Disable strict mode
        $exporter->export('php://output', $output);
    }

    /**
     * @param array $output
     * @param $file_name
     * @param string $to_charset
     * @return string
     */
    public static function exportCsvForAggregateResults(array $output, $file_name, $to_charset = 'SJIS')
    {
        $config = new ExporterConfig();
        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);
        $exporter = new Exporter($config);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        $exporter->unstrict(); // Disable strict mode
        $exporter->export('php://output', $output);
    }

    /**
     * @author Nguyen Tan Phuong <phuongnt@evolableasia.vn>
     * @param array $output
     * @param $file_name
     * @param string $to_charset
     */
    public static function exportCsvForProjectSummary(array $output, $file_name, $to_charset = 'SJIS')
    {
        $config = new ExporterConfig();
        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);
        $exporter = new Exporter($config);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        $exporter->unstrict(); // Disable strict mode
        $exporter->export('php://output', $output);
    }

    /**
     * @author Nguyen Tan Phuong <phuongnt@evolableasia.vn>
     * @param array $output
     * @param $file_name
     * @param string $to_charset
     */
    public static function exportCsvListAllCompany(array $output, $file_name, $to_charset = 'SJIS')
    {
        $config = new ExporterConfig();
        $config
            ->setEscape("\\")
            ->setToCharset($to_charset)
            ->setFromCharset('UTF-8')
            ->setFileMode(CsvFileObject::FILE_MODE_WRITE);
        $exporter = new Exporter($config);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        $exporter->unstrict(); // Disable strict mode
        $exporter->export('php://output', $output);
    }
}
