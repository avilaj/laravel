<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Notification;
use SleepingOwl\Admin\Model\ModelConfiguration;
use \Illuminate\Database\Eloquent\Model;

AdminSection::registerModel(Notification::class, function (ModelConfiguration $model) {
    $model->setTitle("Notificaciones");
    $model->setAlias('notifications');
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('topic')->setLabel('Topic'),
            AdminColumn::text('identificator')->setLabel('Id'),
            AdminColumn::custom()->setCallback(function (Model $model) {
              $params = ['id'=> $model->identificator];
              if ($model->topic == "payment") {
                $link = route('gateway.showPayment', $params);
              } else {
                $link = route('gateway.showOrder', $params);
              }

              return '<a href="'.$link.'" target="_blank">Ver detalle</a>';
            }),
            AdminColumn::datetime('created_at')
              ->setLabel('Date')
              ->setWidth('150px')
        ]);
        $display->paginate(15);
        return $display;
    });
});
