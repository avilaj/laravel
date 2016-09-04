<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Message;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Message::class, function (ModelConfiguration $model) {
    $model->setTitle("Mensajes");
    $model->setAlias('messages');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('name')->setLabel('Nombre'),
            AdminColumn::text('email')->setLabel('Email'),
            AdminColumn::text('phone')->setLabel('Tel'),
            AdminColumn::text('message')->setLabel('Mensaje'),
            AdminColumn::datetime('created_at')
                                    ->setLabel('Date')
                                    ->setFormat('d.m.Y')
                                    ->setWidth('150px'),
        ]);
        $display->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
          AdminFormElement::text('name', 'Nombre')->required(),
          AdminFormElement::text('phone', 'Telefono'),
          AdminFormElement::text('email', 'Email')->required(),
          AdminFormElement::text('message', 'Mensaje')->required(),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
