<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Order;
use App\Model\Product;
use App\Model\Reference;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Order::class, function (ModelConfiguration $model) {
    $model->setTitle("Ordenes de compra");
    $model->setAlias('orders');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->with('user');
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#'),
            AdminColumn::text('price')->setLabel('Total'),
            AdminColumn::text('status')->setLabel('Estado'),
            AdminColumn::custom()
                ->setLabel("Comprador")
                ->setCallback(function ($instance) {
                    $link  = url("admin/order_items?order_id=".$instance->id);
                    return '<a href="'.$link.'">Ver detalle</a>';
                }),
            AdminColumn::custom()
                ->setLabel("Usuario")
                ->setCallback(function ($instance) {
                    $link  = url("admin/users?id=".$instance->user->id);
                    return '<a href="'.$link.'">'.$instance->user->email.'</a>';
                }),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
        ]);
        $display->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([

            AdminFormElement::select('status', 'Estado')
                                    ->setOptions([
                                      'PROCESANDO'=>'1 - Procesando',
                                      'EMPACANDO'=>'2 - Empacando',
                                      'ENVIADO'=>'3 - Enviado',
                                      'RECIBIDO'=>'4 - Recibido'])
                                    ->setDefaultValue('PROCESANDO'),
            AdminFormElement::wysiwyg('description', 'Descripción', 'tinymce')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
