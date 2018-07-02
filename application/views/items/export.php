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

$items = $this->items_model->getitems();
$line = 2;

foreach ($items as $item) {
    $date = '';
    if ($item['date'] != '0000-00-00') {
        $date = $item['date'];
    }

    $sheet->setCellValue('A'.$line, $item['iditem']);
    $sheet->setCellValue('B'.$line, $item['code']);
    $sheet->setCellValue('C'.$line, $date);
    $sheet->setCellValue('D'.$line, $item['item']);
    $sheet->setCellValue('E'.$line, $item['nameuser']);
    $sheet->setCellValue('F'.$line, '$'.$item['cost']);
    $sheet->setCellValue('G'.$line, $item['condition']);
    $sheet->setCellValue('H'.$line, $item['model']);
    $sheet->setCellValue('I'.$line, $item['owner']);
    $sheet->setCellValue('J'.$line, $item['cat']);
    $sheet->setCellValue('K'.$line, $item['locat']);
    $sheet->setCellValue('L'.$line, $item['mat']);
    $sheet->setCellValue('M'.$line, $item['depart']);
    $sheet->setCellValue('N'.$line, $item['description']);
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
