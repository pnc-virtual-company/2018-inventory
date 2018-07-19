<?php
/**
 * This view builds a Spreadsheet file containing the list of users.
 *
 * @copyright  Copyright (c) 2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */

require_once FCPATH."vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet       = $spreadsheet->getActiveSheet();

$sheet->setTitle(mb_strimwidth('Item list', 0, 28, "..."));
//Maximum 31 characters allowed in sheet title.
$sheet->setCellValue('A1', 'Status');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'Code');
$sheet->setCellValue('D1', 'Date');
$sheet->setCellValue('E1', 'Item');
$sheet->setCellValue('F1', 'User');
$sheet->setCellValue('G1', 'Item Cost');
$sheet->setCellValue('H1', 'Condition');
$sheet->setCellValue('I1', 'Model');
$sheet->setCellValue('J1', 'Owner');
$sheet->setCellValue('K1', 'Category');
$sheet->setCellValue('L1', 'Location');
$sheet->setCellValue('M1', 'Material');
$sheet->setCellValue('N1', 'Department');
$sheet->setCellValue('O1', 'Item Description');
// $sheet->setCellValue('N1', 'Status');


$sheet->getStyle('A1:O1')->getFont()->setBold(true);
$sheet->getStyle('A1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$items = $this->items_model->getitems();
$line = 2;

foreach ($items as $item) {
    $date = '';
    if ($item['date'] != '0000-00-00') {
        $date = $item['date'];
    }

    $sheet->setCellValue('A'.$line, $item['status']);
    $sheet->setCellValue('B'.$line, $item['iditem']);
    $sheet->setCellValue('C'.$line, $item['code']);
    $sheet->setCellValue('D'.$line, $date);
    $sheet->setCellValue('E'.$line, $item['item']);
    $sheet->setCellValue('F'.$line, $item['nameuser']);
    $sheet->setCellValue('G'.$line, $item['cost'] ? '$'.$item['cost'] : '');
    $sheet->setCellValue('H'.$line, $item['condition']);
    $sheet->setCellValue('I'.$line, $item['model']);
    $sheet->setCellValue('J'.$line, $item['owner']);
    $sheet->setCellValue('K'.$line, $item['cat']);
    $sheet->setCellValue('L'.$line, $item['locat']);
    $sheet->setCellValue('M'.$line, $item['mat']);
    $sheet->setCellValue('N'.$line, $item['depart']);
    $sheet->setCellValue('O'.$line, $item['description']);
    // $sheet->setCellValue('N' . $line, $item['Status']);
    $line++;
}//end foreach

//Autofit
foreach (range('A', 'N') as $colD) {
    $sheet->getColumnDimension($colD)->setAutoSize(true);
}

$filename = 'Item list export.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->setPreCalculateFormulas(false);
$writer->save('php://output');
