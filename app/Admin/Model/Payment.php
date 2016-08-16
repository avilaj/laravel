<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Order;
use App\Model\Payment;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Payment::class, function (ModelConfiguration $model) {
    $model->setTitle("Pagos");
    $model->setAlias('payments');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setFilters([
          AdminDisplayFilter::field('id')->setTitle('Busqueda por id'),
          AdminDisplayFilter::related('order_id')
          ->setModel(Order::class)->setDisplay('id'),
        ]);
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('amount_requested')->setLabel('Solicitado'),
            AdminColumn::text('amount_paid')->setLabel('Abonado'),
            AdminColumn::custom()
                ->setLabel("Orden de compra")
                ->setCallback(function ($instance) {
                    $link  = url("admin/orders?id=".$instance->order_id);
                    return '<a href="'.$link.'">Ver registro</a>';
                }),
            AdminColumn::custom()
                ->setLabel("IPN")
                ->setCallback(function ($instance) {
                    $link  = url("admin/notifications?id=".$instance->notification_id);
                    return '<a href="'.$link.'">Ver registro</a>';
                }),
            AdminColumn::datetime('created_at')
                                    ->setLabel('Date')
                                    ->setFormat('d.m.Y')
                                    ->setWidth('150px'),
        ]);
        $display->paginate(5);
        return $display;
    });
});
