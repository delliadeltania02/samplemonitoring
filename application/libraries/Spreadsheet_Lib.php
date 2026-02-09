<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory; // 🔥 WAJIB
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class Spreadsheet_Lib {

    public function load($filePath)
    {
        $reader = new Xlsx();
        return $reader->load($filePath);
    }

    public function create()
    {
        return new Spreadsheet();
    }

    // 🔥 READ ONLY (HEMAT RAM)
    public function loadReadOnly($path)
    {
        $reader = IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        return $reader->load($path);
    }

    function excelDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // kalau numeric → tanggal Excel
        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // kalau string
        return date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

}
