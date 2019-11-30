<?php

use App\Models\Student;
use App\Services\SchoolBoardService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$student = new Student();

$studentData = $student->get($_GET['student']);
$grades = $student->getStudentGrades();

$schoolBoardService = new SchoolBoardService();

echo $schoolBoardService->getResponse($studentData, $grades);
