<?php
/**
 * This view builds a Spreadsheet file containing the list of users.
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

require_once FCPATH . "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle(mb_strimwidth('Item list', 0, 28, "..."));  //Maximum 31 characters allowed in sheet title.
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Code');
$sheet->setCellValue('C1', 'Date');
$sheet->setCellValue('D1', 'Item');
$sheet->setCellValue('E1', 'User');
$sheet->setCellValue('F1', 'Item Cost');
$sheet->setCellValue('G1', 'Condition');
$sheet->setCellValue('H1', 'Model');
$sheet->setCellValue('I1', 'Owner');
$sheet->setCellValue('J1', 'Category');
$sheet->setCellValue('K1', 'Location');
$sheet->setCellValue('L1', 'Material');
$sheet->setCellValue('M1', 'Department');
$sheet->setCellValue('N1', 'Item Description');
// $sheet->setCellValue('N1', 'Status');


$sheet->getStyle('A1:N1')->getFont()->setBold(true);
$sheet->getStyle('A1:N1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$item = $this->items_model->getitems();
$line =2;

foreach ($item as $items) {
    $date='';
    if ( $items['date'] != '0000-00-00'){
      $date=$items['date'];
    }
    $sheet->setCellValue('A' . $line, $items['iditem']);
    $sheet->setCellValue('B' . $line, $items['code']);
    $sheet->setCellValue('C' . $line,$date);
    $sheet->setCellValue('D' . $line, $items['item']);
    $sheet->setCellValue('E' . $line, $items['nameuser']);
    $sheet->setCellValue('F' . $line, '$'.$items['cost']);
    $sheet->setCellValue('G' . $line, $items['condition']);
    $sheet->setCellValue('H' . $line, $items['model']);
    $sheet->setCellValue('I' . $line, $items['owner']);
    $sheet->setCellValue('J' . $line, $items['cat']);
    $sheet->setCellValue('K' . $line, $items['locat']);
    $sheet->setCellValue('L' . $line, $items['mat']);
    $sheet->setCellValue('M' . $line, $items['depart']);
    $sheet->setCellValue('N' . $line, $items['description']);
    // $sheet->setCellValue('N' . $line, $items['Status']);
    $line++;
}

//Autofit
foreach(range('A', 'N') as $colD) {
    $sheet->getColumnDimension($colD)->setAutoSize(TRUE);
}

$filename = 'Item list export.' . 'xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->setPreCalculateFormulas(false);
$writer->save('php://output');