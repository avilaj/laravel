<?php

use App\Model\Type;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Type::class, function (ModelConfiguration $model) {
  $model->setTitle("Configuraciones de talles");
  $model->setAlias('sizes');
  $model->onDisplay(function () {
    return AdminDisplay::datatables()->setApply(function($query) {
      $query->orderBy('created_at', 'desc');
    })->setColumns([
      AdminColumn::text('id')->setLabel('#'),
      AdminColumn::text('label')->setLabel('Tipo'),
      AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')
    ])->paginate(5);
  });
    $model->onCreateAndEdit(function() {
      $form = AdminForm::form()->setItems([
        AdminFormElement::text('label', 'Título')->required(),
        AdminFormElement::multiselect('sizes', 'Talles')
                          ->taggable()
                          ->setModelForOptions('App\Model\Size')
                          ->setDisplay('label')
                          ->required()
      ]);
      $form->getButtons()
        ->setSaveButtonText('Guardar')
        ->hideSaveAndCloseButton();
      return $form;
    });
});
