<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Subscription;
use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Subscription::class, function (ModelConfiguration $model) {
    $model->setTitle("Suscripciones");
    $model->setAlias("subscriptions");
    $model->onDisplay(function () {
        return AdminDisplay::table()->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setActions([
          AdminColumn::action('export', 'Exportar')
            ->setIcon('fa fa-share')
            ->setAction(route('subscriptions.export')),
        ])
        ->setColumns([
          AdminColumn::checkbox(),
          AdminColumn::text('email')->setLabel('Email'),
          AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
        ])->paginate(5);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre'),
            AdminFormElement::text('email', 'Email')->required()->unique(),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar usuario')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
