<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\EmpSlots\generateEmployeeTimeSlotsToDo;

class ScheduleController  extends Controller
{
    public function actionIndex()
    {
        $list = [];
        if (\Yii::$app->request->isPost) {
            $actions = Yii::$app->request->post('actions', []);
            $items = Yii::$app->request->post('items', []);
            $personalList = include Yii::getAlias('@app/data/personalList.php');
            $serviceList = include Yii::getAlias('@app/data/serviceList.php');
         
            switch ($actions) {
                case 'service':
                    $list = $serviceList;
                    break;
                case 'personal':
                    $list = $personalList;
                    break;
                case 'date':
                    $list = $serviceList;
                    break;
                default:
                    $list = $serviceList;
                    break;
            }

        }
        return $this->render('index',['list'=> $list]);
    }
    public function actionSchedule()
    {
        // Подключаем массивы (или из БД)
        $serviceList = require __DIR__ . '/../data/serviceList.php';
        $personalList = require __DIR__ . '/../data/personalList.php';
        $employeeSchedules = require __DIR__ . '/../data/employeeSchedules.php';
        $serviceSchedules = require __DIR__ . '/../data/serviceSchedules.php';
        $plannedSchedule = require __DIR__ . '/../data/plannedSchedule.php';
    
        $stage = Yii::$app->request->post('stage', 'service');
        $selectedService = Yii::$app->request->post('service');
        $selectedPersonal = Yii::$app->request->post('personal');
        $selectedTime = Yii::$app->request->post('time');
    
        if ($stage === 'service' && $selectedService) {
            // Переходим к выбору специалиста
            $stage = 'personal';
        } elseif ($stage === 'personal' && $selectedPersonal) {
            // Переходим к выбору времени
            $stage = 'time';
        } elseif ($stage === 'time' && $selectedTime) {
            // Тут можно добавить запись на услугу
            // ...
            return $this->render('success', [
                'service' => $selectedService,
                'personal' => $selectedPersonal,
                'time' => $selectedTime,
            ]);
        }
    
        // Формируем список специалистов, которые оказывают выбранную услугу
        $filteredPersonal = $personalList;
        if ($stage === 'personal' && $selectedService) {
            $serviceId = null;
            foreach ($serviceList as $service) {
                if ($service['name'] === $selectedService) {
                    $serviceId = $service['id'];
                    break;
                }
            }
            $filteredPersonal = array_filter($personalList, function($person) use ($serviceId) {
                return in_array($serviceId, $person['serviciesList']);
            });
        }
        $slotsByDay = [];
        $selectedDate = [];
        $slotsForSelectedDate = [];
        // Формируем список слотов для выбранного специалиста и услуги
        $slots = [];
        if ($stage === 'time' && $selectedService && $selectedPersonal) {
            $generator = new generateEmployeeTimeSlotsToDo(
                $employeeSchedules, $personalList, $serviceList, $serviceSchedules, $plannedSchedule
            );
            $slots = $generator->getSlotsArray($selectedPersonal, $selectedService, 1800);
            $slotsByDay = $generator->getFreeSlotsByDay($selectedPersonal, $selectedService, 1800);

            $selectedDate = Yii::$app->request->post('date') ?? date('Y-m-d');
            $slotsForSelectedDate = $slotsByDay[$selectedDate] ?? [];
        }
    
        return $this->render('schedule', [
            'serviceList' => $serviceList,
            'personalList' => $filteredPersonal,
            'slotsByDay' => $slotsByDay,
            'selectedDate' => $selectedDate,
            'slotsForSelectedDate' => $slotsForSelectedDate,
            'slots' => $slots,
            'stage' => $stage,
            'selectedService' => $selectedService,
            'selectedPersonal' => $selectedPersonal,
        ]);
    }
    
}
